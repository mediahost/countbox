<?php

namespace App\Forms;

/**
 * TaskFormFactory
 *
 * @author Petr Poupě
 */
class TaskFormFactory extends FormFactory
{
    
    private $entityId;

    /** @var \App\Model\Facade\ProjectFacade */
    private $projectFacade;

    /** @var array */
    private $projects;

    public function __construct(IFormFactory $formFactory, \App\Model\Facade\ProjectFacade $projectFacade)
    {
        parent::__construct($formFactory);
        $this->projectFacade = $projectFacade;
    }
    
    /**
     * 
     * @param type $id
     * @return TaskFormFactory
     */
    public function setEntityId($id)
    {
        $this->entityId = $id;
        return $this;
    }

    private function getProjects()
    {
        if ($this->projects === NULL) {
            $this->projects = $this->projectFacade->findPairs("name");
        }
        return $this->projects;
    }

    public function create()
    {
        $form = $this->formFactory->create();
        $namePlaceholder = $this->isAdding() ? "New Task" : "Task #{$this->entityId}";
        $form->addText('name', 'Name')
                ->setAttribute("placeholder", $namePlaceholder);
        $form->addSelect2('project', 'Project', $this->getProjects())
                ->setRequired("Select some project");
        $form->addWysiHtml("text", "Text", "7")
                ->setRequired("Please describe your problem to solve")
                ->setAttribute("placeholder", "Describe your problem");
        $form->addSpinner("priority", "Priority")
                ->setMin("1")
                ->setMax("10")
                ->setInverse()
                ->setLeftButton("blue")
                ->setRightButton("red")
                ->setOption("description", "max. priority is 1");
        $today = new \Nette\Utils\DateTime;
        $form->addDatePicker("dueDate", "Due date")
                ->setStartDate($today)
                ->setTodayHighlight()
                ->setDefaultValue($today)
                ->setPlaceholder($today->format("d.m.Y"));
        
        $form->addSubmit('_submit', 'Save');
        $form->addSubmit('submitContinue', 'Save and continue edit');
        return $form;
    }

}
