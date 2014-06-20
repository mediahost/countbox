<?php

namespace App\Forms;

/**
 * TaskFormFactory
 *
 * @author Petr Poupě
 */
class TaskFormFactory extends FormFactory
{

    public function create()
    {
        $form = $this->formFactory->create();
        $form->addText('name', 'Name');
        $form->addWysiHtml("text_html", "Text", "5");
        
        $form->addSubmit('_submit', 'Save');
        $form->addSubmit('_submitContinue', 'Save and continue edit');
        return $form;
    }

}
