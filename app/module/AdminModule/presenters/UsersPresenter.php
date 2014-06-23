<?php

namespace App\AdminModule\Presenters;

use Nette;
use Tracy\Debugger as Debug;

/**
 * Users presenter.
 */
class UsersPresenter extends BasePresenter
{

    /** @var \App\Model\Facade\UserFacade @inject */
    public $userFacade;

    /** @var array */
    public $users;

    /** @var \App\Forms\UserFormFactory @inject */
    public $userFormFactory;

    /** @var \App\Model\Entity\User */
    private $user;

    protected function startup()
    {
        parent::startup();
        $this->isAllowed("users", "view");
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
        $this->user = new \App\Model\Entity\User;
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

    public function userFormSuccess($form)
    {
        $this->formFactoryFactory
                ->getEntityMapper()
                ->save($this->user, $form);
        $this->userFacade->save($this->user);

        if ($form['_submitContinue']->submittedBy) {
            $this->redirect("edit", $this->user->getId());
        }
        $this->redirect("Users:");
    }

// </editor-fold>
}
