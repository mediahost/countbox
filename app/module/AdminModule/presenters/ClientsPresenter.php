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

    public function actionDefault()
    {
        $this->isAllowed("clients", "view");
        
        $this->users = $this->userFacade->findAll();
    }

    public function renderDefault()
    {
        $this->template->users = $this->users;
    }
    
    public function actionAdd()
    {
        
    }
    
    public function actionEdit($id)
    {
        
    }
    
    public function actionDelete($id)
    {
        
    }

// <editor-fold defaultstate="collapsed" desc="Forms">
// </editor-fold>
}
