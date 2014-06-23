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
    
    protected function startup()
    {
        parent::startup();
        $this->isAllowed("admin", "view");
    }
    
    protected function beforeRender()
    {
        parent::beforeRender();
        $this->template->isAllowedDashboard = BaseBasePresenter::isAllowed("dashboard", "view");
        $this->template->isAllowedCompanies = BaseBasePresenter::isAllowed("companies", "view");
        $this->template->isAllowedCompaniesAdd = BaseBasePresenter::isAllowed("companies", "add");
        $this->template->isAllowedProjects = BaseBasePresenter::isAllowed("projects", "view");
        $this->template->isAllowedProjectsAdd = BaseBasePresenter::isAllowed("projects", "add");
        $this->template->isAllowedTasks = BaseBasePresenter::isAllowed("tasks", "view");
        $this->template->isAllowedTasksAdd = BaseBasePresenter::isAllowed("tasks", "add");
        $this->template->isAllowedComments = BaseBasePresenter::isAllowed("comments", "view");
        $this->template->isAllowedUsers = BaseBasePresenter::isAllowed("users", "view");
        $this->template->isAllowedUsersAdd = BaseBasePresenter::isAllowed("users", "add");
    }

    protected function isAllowed($resource = Nette\Security\IAuthorizator::ALL, $privilege = Nette\Security\IAuthorizator::ALL, $redirect = TRUE)
    {
        $isAllowed = parent::isAllowed($resource, $privilege);
        if (!$isAllowed && $redirect) {
            $this->flashMessage("You can't access to this section", "warning");
            $this->redirect(":Front:Deny:");
        }
        return $isAllowed;
    }

}
