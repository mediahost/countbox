<?php

namespace App\Forms;

/**
 * SignIn FormFactory
 *
 * @author Petr Poupě
 */
class SignInFormFactory implements IFormFactory
{

    private $formFactory;

    public function __construct(IFormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function create()
    {
        $form = $this->formFactory->create();

        $form->addText('username', 'Username')
//                ->setRequired('Please enter your username')
                ->setAttribute('placeholder', 'Username');
        $form->addPassword('password', 'Password')
//                ->setRequired('Please enter your password')
                ->setAttribute('placeholder', 'Password');
        
        $form->addCheckbox('remember', 'Remember me')
                ->getLabelPrototype()->class="checkbox";

        $form->addSubmit('_submit', 'Login');
        return $form;
    }

}
