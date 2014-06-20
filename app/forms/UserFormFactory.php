<?php

namespace App\Forms;

/**
 * UserFormFactory
 *
 * @author Petr Poupě
 */
class UserFormFactory extends FormFactory
{

    public function create()
    {
        $form = $this->formFactory->create();
        $form->addText('username', 'Username')
                ->setOption("description", "username must be e-mail")
                ->addRule(Form::EMAIL, "Username must be e-mail")
                ->addRule(Form::FILLED, "Username must be filled");
        $password = $form->addText('new_password', 'Password');
        if ($this->isAdding()) {
            $password->addRule(Form::FILLED, "Password must be filled");
        }
//        $form->addMultiSelect('role', 'Role');

        $form->addSubmit('_submit', 'Save');
        $form->addSubmit('_submitContinue', 'Save and continue edit');
        return $form;
    }

}
