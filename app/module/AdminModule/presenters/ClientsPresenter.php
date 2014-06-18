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

    public function actionDefault()
    {
        $this->isAllowed("clients", "view");
    }

// <editor-fold defaultstate="collapsed" desc="Forms">
// </editor-fold>
}
