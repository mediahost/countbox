<?php

namespace App\AdminModule\Presenters;

use Nette;
use Tracy\Debugger as Debug;

/**
 * Projects presenter.
 */
class ProjectsPresenter extends BasePresenter
{

    protected function startup()
    {
        parent::startup();
        $this->isAllowed("projects", "view");
    }

    public function actionDefault()
    {
        
    }

// <editor-fold defaultstate="collapsed" desc="Forms">
// </editor-fold>
}
