<?php

namespace App\Model\Permission;

/**
 * Permission model of access control list
 *
 * @author Petr Poupě
 */
class Permission extends \Nette\Security\Permission
{

    public function __construct()
    {
        // definujeme role
        $this->setRoles();
        // seznam zdrojů, ke kterým mohou uživatelé přistupovat
        $this->setResources();
        // pravidla, určující, kdo co může s čím dělat - defaultně vše zakázáno
        $this->setPrivileges();
    }

    private function setRoles()
    {
        $this->addRole('guest');
        $this->addRole('client', 'guest');
        $this->addRole('programmer', 'client');
        $this->addRole('manager', 'programmer');

        $this->addRole('admin', 'manager');
        $this->addRole('superadmin', 'admin');
    }

    private function setResources()
    {
        $this->addResource('front');
        
        $this->addResource('tasks'); 
        $this->addResource('comments'); 
        $this->addResource('projects'); 

        $this->addResource('admin');
        $this->addResource('service');
    }

    private function setPrivileges()
    {
        /**
         * VIEW-OWN - view own data
         * VIEW - view all data
         * EDIT-OWN - can edit own
         * EDIT - can edit
         * DELETE-OWN - can delete own
         * DELETE - can delete
         */

        $this->deny('guest');

        $this->allow('guest', 'front');
        
        $this->allow('client', 'tasks', 'view-own');
        $this->allow('client', 'comments', 'view');
        $this->allow('client', 'projects', 'view-own');        

        $this->allow('manager', 'tasks');
        $this->allow('manager', 'comments');
        $this->allow('manager', 'projects');

        $this->allow('admin', 'admin');

        $this->allow('superadmin'); // všechna práva a zdroje pro administrátora
    }

}
