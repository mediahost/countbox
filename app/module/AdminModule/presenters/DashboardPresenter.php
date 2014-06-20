<?php

namespace App\AdminModule\Presenters;

use Nette;
use Tracy\Debugger as Debug;

/**
 * Dashboard presenter.
 */
class DashboardPresenter extends BasePresenter
{

    protected function startup()
    {
        parent::startup();
        $this->isAllowed("dashboard", "view");
    }

    public function actionDefault()
    {
        
    }

}
