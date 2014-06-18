<?php

namespace App\AdminModule\Presenters;

use Nette;
use Tracy\Debugger as Debug;

/**
 * Projects presenter.
 */
class ProjectsPresenter extends BasePresenter
{

    public function actionDefault()
    {
        $this->isAllowed("projects", "view");
    }

// <editor-fold defaultstate="collapsed" desc="Forms">
// </editor-fold>
}
