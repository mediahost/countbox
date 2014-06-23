<?php

namespace App\Forms\EntityMapper;

use Tracy\Debugger as Debug;

/**
 * EntityFormMapper
 *
 * @author Petr Poupě
 */
class EntityFormMapper extends \Kdyby\DoctrineForms\EntityFormMapper
{
    
    /** @var \App\Model\Facade\RoleFacade */
    private $roleFacade;
    
    public function __construct(\Doctrine\ORM\EntityManager $entityManager, \App\Model\Facade\RoleFacade $roleFacade)
    {
        parent::__construct($entityManager);
        $this->roleFacade = $roleFacade;
    }

    public function load($entity, $form)
    {
        if ($entity instanceof \App\Model\Entity\User) {
            $form->setValues(array(
                "username" => $entity->getUsername(),
                "role" => $entity->getRolesArray(TRUE),
            ));
        } else {
            parent::load($entity, $form);
        }
    }

    public function save($entity, $form)
    {
        if ($entity instanceof \App\Model\Entity\User) {
            $entity->setUsername($form->values->username);
            if ($form->values->password !== NULL && $form->values->password !== "") {
                $entity->setPassword($form->values->password);
            }
            $entity->clearRole();
            foreach ($form->values->role as $roleId) {
                $role = $this->roleFacade->find($roleId);
                if ($role) {
                    $entity->addRole($role);
                }
            }
        } else {
            parent::save($entity, $form);
        }
    }

}
