<?php

namespace App\AdminModule\Presenters;

use Nette;

/**
 * BasePresenter
 *
 * @author Petr Poupě
 */
abstract class BasePresenter extends \App\BaseModule\Presenters\BasePresenter
{

    protected function isAllowed($resource = Nette\Security\IAuthorizator::ALL, $privilege = Nette\Security\IAuthorizator::ALL, $redirect = TRUE)
    {
        $isAllowed = parent::isAllowed($resource, $privilege);
        if (!$isAllowed && $redirect) {
            $this->flashMessage("You can't access to this section");
            $this->redirect(":Front:Sign:in");
        }
        return $isAllowed;
    }

}
