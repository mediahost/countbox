<?php

namespace App\FrontModule\Presenters;

use Nette,
    Tracy\Debugger as Debug;

/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{

    /** @var \App\Forms\SignInFormFactory @inject */
    public $sinInFormFactory;

    public function actionIn()
    {
        if ($this->getUser()->isLoggedIn()) {
            $this->flashMessage('You have been already signed in.', 'warning');
            $this->redirect('Homepage:');
        }
    }

    public function actionOut()
    {
        $this->getUser()->logout();
        $this->flashMessage('You have been signed out.', 'success');
        $this->redirect('in');
    }

// <editor-fold defaultstate="collapsed" desc="Forms">

    public function createComponentSignInForm()
    {
        $form = $this->sinInFormFactory->create();
        $form->onSuccess[] = $this->signInFormSucceeded;
        return $form;
    }

    public function signInFormSucceeded($form, $values)
    {
        if ($values->remember) {
            $this->getUser()->setExpiration('14 days', FALSE);
        } else {
            $this->getUser()->setExpiration('20 minutes', TRUE);
        }

        try {
            $this->getUser()->login($values->username, $values->password);
            $this->redirect(':Admin:Dashboard:');
        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError($e->getMessage());
        }
    }

// </editor-fold>
}
