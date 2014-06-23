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
    
    public function setEntityId($id)
    {
        $this->entityId = $id;
    }

    public function create()
    {
        $form = $this->formFactory->create();
        $namePlaceholder = $this->isAdding() ? "New Task" : "Task #{$this->entityId}";
        $form->addText('name', 'Name')
                ->setAttribute("placeholder", $namePlaceholder);
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
        $form->addDatePicker("dueDate", "Due date")
                ->setStartDate(new \Nette\Utils\DateTime)
                ->setTodayHighlight()
                ->setDefaultValue(new \Nette\Utils\DateTime);
        
        $form->addSubmit('_submit', 'Save');
        $form->addSubmit('_submitContinue', 'Save and continue edit');
        return $form;
    }

}
