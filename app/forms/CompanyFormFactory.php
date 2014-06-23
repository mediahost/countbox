<?php

namespace App\Forms;

/**
 * CompanyFormFactory
 *
 * @author Petr Poupě
 */
class CompanyFormFactory extends FormFactory
{

    public function create()
    {
        $form = $this->formFactory->create();
        $form->addText('name', 'Name')
                ->setRequired("Name must be filled")
                ->setAttribute("placeholder", "Company name");
        
        $form->addSubmit('_submit', 'Save');
        $form->addSubmit('_submitContinue', 'Save and continue edit');
        return $form;
    }

}
