<?php

namespace App\Forms;

/**
 * UserFormFactory
 *
 * @author Petr Poupě
 */
class UserFormFactory implements IFormFactory
{

    private $formFactory;
    private $add = FALSE;

    public function __construct(IFormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }
    
    public function setAdding($add = TRUE)
    {
        $this->add = $add;
        return $this;
    }
    
    public function isAdding()
    {
        return $this->add;
    }

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
