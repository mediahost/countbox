<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @property string $username
 * @property \Doctrine\ORM\PersistentCollection $roles
 * @method string getUsername()
 * @method \Doctrine\ORM\PersistentCollection getRoles()
 */
class User extends \Kdyby\Doctrine\Entities\IdentifiedEntity
{

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $username;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\ManyToMany(targetEntity="Role", fetch="EAGER")
     */
    protected $roles;

    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection;
    }

    public function toArray()
    {
        $array = array(
            'username' => $this->getUsername(),
            'role' => $this->getRolesArray(),
        );
        return $array;
    }

    // <editor-fold defaultstate="collapsed" desc="setters">
    /**
     * 
     * @param type $value
     * @return \App\Model\Entity\User
     * @throws \Nette\Utils\AssertionException
     */
    public function setMail($value)
    {
        if (!\Nette\Utils\Validators::isEmail($value)) {
            throw new \Nette\Utils\AssertionException("Wrong e-mail format");
        }
        return $this->setUsername($value, FASE);
    }

    /**
     * 
     * @param type $value
     * @param type $validate
     * @return \App\Model\Entity\User
     * @throws \Nette\Utils\AssertionException
     */
    public function setUsername($value, $validate = TRUE)
    {
        if ($validate && !\Nette\Utils\Validators::isEmail($value)) {
            throw new \Nette\Utils\AssertionException("Username must be e-mail");
        }
        $this->username = $value;
        return $this;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">
    /**
     * 
     * @return string
     */
    public function getMail()
    {
        return $this->username;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="password setters & getters">
    public function setPassword($value)
    {
        if ($value !== "" && $value !== NULL) {
            $this->password = \Nette\Security\Passwords::hash($value);
        }
        return $this;
    }

    /**
     * Verify open password
     * @param type $password open password
     * @return bool
     */
    public function verifyPassword($password)
    {
        return \Nette\Security\Passwords::verify($password, $this->password);
    }

    /**
     * Check hashed passwords
     * @param type $hash hashed password
     * @return bool
     */
    public function checkHash($hash)
    {
        return $this->password === $hash;
    }

    /**
     * Checks if the given hash matches the options.
     * @param  array with cost (4-31)
     * @return bool
     */
    public function needsRehash(array $options = NULL)
    {
        return \Nette\Security\Passwords::needsRehash($this->password, $options);
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="role getters & setters">


    public function addRole(Role $element, $clear = FALSE)
    {
        if ($clear) {
            $this->clearRoles();
        }
        if (!$this->roles->contains($element)) {
            $this->roles->add($element);
        }
        return $this;
    }

    public function removeRole(Role $element)
    {
        if ($this->roles->contains($element)) {
            $this->roles->removeElement($element);
        }
        return $this;
    }
    
    public function clearRoles()
    {
        $this->roles->clear();
        return $this;
    }

    /**
     * 
     * @return array
     */
    public function getRolesArray($keysOnly = FALSE)
    {
        $array = array();
        foreach ($this->roles as $role) {
            $array[$role->getId()] = $keysOnly ? $role->getId() : (string) $role;
        }
        return $array;
    }

    // </editor-fold>
}
