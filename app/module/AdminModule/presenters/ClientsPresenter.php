<?php

namespace App\AdminModule\Presenters;

use Nette;
use Tracy\Debugger as Debug;

/**
 * Clients presenter.
 */
class ClientsPresenter extends BasePresenter
{

    /** @var \App\Model\Facade\UserFacade @inject */
    public $userFacade;

    /** @var array */
    public $users;

    /** @var \App\Forms\UserFormFactory @inject */
    public $userFormFactory;

    /** @var \App\Model\Entity\User\User */
    private $user;

    protected function startup()
    {
        parent::startup();
        $this->isAllowed("clients", "view");
    }

    public function actionDefault()
    {
        $this->users = $this->userFacade->findAll();
    }

    public function renderDefault()
    {
        $this->template->users = $this->users;
    }

    public function actionAdd()
    {
        $this->user = new \App\Model\Entity\User\User;
        $this->userFormFactory->setAdding();
        $this->setView("edit");
    }

    public function actionEdit($id)
    {
        $this->user = $this->userFacade->find($id);
    }

    public function renderEdit()
    {
        $this->template->isAdd = $this->userFormFactory->isAdding();
    }

    public function actionDelete($id)
    {
        $this->flashMessage("Not implemented yet.", 'warning');
        $this->redirect("default");
    }

// <editor-fold defaultstate="collapsed" desc="Forms">

    public function createComponentUserForm()
    {
        $form = $this->formFactoryFactory
                ->create($this->userFormFactory)
                ->setEntity($this->user)
                ->create();
        $form->onSuccess[] = $this->userFormSuccess;
        return $form;
    }

    public function userFormSuccess($form, $values)
    {
        $this->user->setUsername($values->username);
        if ($values->new_password !== "") {
            $this->user->setPassword($values->new_password);
        }
        $this->userFacade->save($this->user);

        if ($form['_submitContinue']->submittedBy) {
            if ($this->userFormFactory->isAdding()) {
                $this->redirect("edit", $this->user->getId());
            }
            $this->redirect("this");
        }
        $this->redirect("Clients:");
    }

// </editor-fold>
}
