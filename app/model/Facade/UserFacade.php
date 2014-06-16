<?php

namespace App\Model\Facade;

class UserFacade extends BaseFacade
{

    /**
     * 
     * @param type $username
     * @return \App\Model\Entity\User\User
     */
    public function findByUsername($username)
    {
        return $this->dao->findOneBy(array('username' => $username));
    }
    
    /**
     * Check if username is unique
     * @param type $username
     * @return bool
     */
    public function isUnique($username)
    {
        return $this->findByUsername($username) === NULL;
    }
    
    /**
     * Create user if isnt exists
     * @param type $username
     * @param type $password
     * @return \App\Model\Entity\User\User|null
     */
    public function create($username, $password)
    {
        if ($this->findByUsername($username) === NULL) { // check unique
            $entity = new \App\Model\Entity\User\User;
            $entity->setUsername($username);
            $entity->setPassword($password);
            return $this->save($entity);
        }
        return NULL;
    }

}
