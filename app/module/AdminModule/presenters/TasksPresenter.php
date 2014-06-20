<?php

namespace App\AdminModule\Presenters;

use Nette;
use Tracy\Debugger as Debug;

/**
 * Tasks presenter.
 */
class TasksPresenter extends BasePresenter
{

    /** @var \App\Model\Facade\TaskFacade @inject */
    public $taskFacade;

    /** @var array */
    public $tasks;

    /** @var \App\Forms\TaskFormFactory @inject */
    public $taskFormFactory;
    
    /** @var \App\Model\Entity\Task */
    private $task;
    
    protected function startup()
    {
        parent::startup();
        $this->isAllowed("tasks", "view");
    }

    public function actionDefault()
    {
        $this->tasks = $this->taskFacade->findAll();
    }

    public function renderDefault()
    {
        $this->template->tasks = $this->tasks;
    }

    public function actionAdd()
    {
        $this->task = new \App\Model\Entity\Task;
        $this->taskFormFactory->setAdding();
        $this->setView("edit");
    }

    public function actionEdit($id)
    {
        $this->task = $this->taskFacade->find($id);
    }
    
    public function renderEdit()
    {
        $this->template->isAdd = $this->taskFormFactory->isAdding();
    }

    public function actionDelete($id)
    {
        $this->flashMessage("Not implemented yet.", 'warning');
        $this->redirect("default");
    }

// <editor-fold defaultstate="collapsed" desc="Forms">

    public function createComponentTaskForm()
    {
        $form = $this->formFactoryFactory
                ->create($this->taskFormFactory)
                ->setEntity($this->task)
                ->create();
        $form->onSuccess[] = $this->taskFormSuccess;
        return $form;
    }

    public function taskFormSuccess($form)
    {
        $em = $this->formFactoryFactory->getEntityMapper();
        $em->save($this->task, $form);

        if ($form['_submitContinue']->submittedBy) {
            if ($this->taskFormFactory->isAdding()) {
                $this->redirect("edit", $this->task->getId());
            }
            $this->redirect("this");
        }
        $this->redirect("Tasks:");
    }

// </editor-fold>
}
