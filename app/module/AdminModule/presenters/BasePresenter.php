<?php

namespace App\AdminModule\Presenters;

use Nette,
    App\BaseModule\Presenters\BasePresenter as BaseBasePresenter;

/**
 * BasePresenter
 *
 * @author Petr Poupě
 */
abstract class BasePresenter extends BaseBasePresenter
{

    protected function isAllowed($resource = Nette\Security\IAuthorizator::ALL, $privilege = Nette\Security\IAuthorizator::ALL, $redirect = TRUE)
    {
        $isAllowed = parent::isAllowed($resource, $privilege);
        if (!$isAllowed && $redirect) {
            $this->flashMessage("You can't access to this section", "warning");
            $this->redirect(":Front:Sign:in");
        }
        return $isAllowed;
    }
    
    protected function beforeRender()
    {
        parent::beforeRender();
        $this->template->isAllowedDashboard = BaseBasePresenter::isAllowed("dashboard", "view");
        $this->template->isAllowedClients = BaseBasePresenter::isAllowed("clients", "view");
        $this->template->isAllowedClientsAdd = BaseBasePresenter::isAllowed("clients", "add");
        $this->template->isAllowedProjects = BaseBasePresenter::isAllowed("projects", "view");
        $this->template->isAllowedProjectsAdd = BaseBasePresenter::isAllowed("projects", "add");
        $this->template->isAllowedTasks = BaseBasePresenter::isAllowed("tasks", "view");
        $this->template->isAllowedTasksAdd = BaseBasePresenter::isAllowed("tasks", "add");
        $this->template->isAllowedComments = BaseBasePresenter::isAllowed("comments", "view");
    }

}
