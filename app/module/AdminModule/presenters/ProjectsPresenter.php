<?php

namespace App\AdminModule\Presenters;

use Nette;
use Tracy\Debugger as Debug;

/**
 * Projects presenter.
 */
class ProjectsPresenter extends BasePresenter
{

    /** @var \App\Model\Facade\ProjectFacade @inject */
    public $projectFacade;

    /** @var array */
    public $projects;

    /** @var \App\Forms\ProjectFormFactory @inject */
    public $projectFormFactory;

    /** @var \App\Model\Entity\Project */
    private $project;

    protected function startup()
    {
        parent::startup();
        $this->isAllowed("projects", "view");
    }

    public function actionDefault()
    {
        $this->projects = $this->projectFacade->findAll();
    }

    public function renderDefault()
    {
        $this->template->projects = $this->projects;
    }

    public function actionAdd()
    {
        $this->project = new \App\Model\Entity\Project;
        $this->projectFormFactory->setAdding();
        $this->setView("edit");
    }

    public function actionEdit($id)
    {
        $this->project = $this->projectFacade->find($id);
    }

    public function renderEdit()
    {
        $this->template->isAdd = $this->projectFormFactory->isAdding();
    }

    public function actionView($id)
    {
        $this->flashMessage("Not implemented yet.", 'warning');
        $this->redirect("default");
    }

    public function actionDelete($id)
    {
        $this->flashMessage("Not implemented yet.", 'warning');
        $this->redirect("default");
    }

// <editor-fold defaultstate="collapsed" desc="Forms">

    public function createComponentProjectForm()
    {
        $form = $this->formFactoryFactory
                ->create($this->projectFormFactory)
                ->setEntity($this->project)
                ->create();
        $form->onSuccess[] = $this->projectFormSuccess;
        return $form;
    }

    public function projectFormSuccess($form)
    {
        $this->formFactoryFactory
                ->getEntityMapper()
                ->save($this->project, $form);
        $this->projectFacade->save($this->project);

        if ($form['_submitContinue']->submittedBy) {
            $this->redirect("edit", $this->project->getId());
        }
        $this->redirect("Projects:");
    }

// </editor-fold>
}
