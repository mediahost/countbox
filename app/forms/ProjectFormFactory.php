<?php

namespace App\Forms;

/**
 * ProjectFormFactory
 *
 * @author Petr Poupě
 */
class ProjectFormFactory extends FormFactory
{

    public function create()
    {
        $form = $this->formFactory->create();
        $form->addText('name', 'Name');
        
        $form->addSubmit('_submit', 'Save');
        $form->addSubmit('_submitContinue', 'Save and continue edit');
        return $form;
    }

}
