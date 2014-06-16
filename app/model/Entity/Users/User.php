<?php

namespace App\Model\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
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
    protected $role;

    public function __construct()
    {
        $this->role = new \Doctrine\Common\Collections\ArrayCollection;
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
    public function setMail($value)
    {
        if (!\Nette\Utils\Validators::isEmail($value)) {
            throw new \Nette\Utils\AssertionException("Wrong e-mail format");
        }
        return $this->setUsername($value, FASE);
    }

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

    /**
     * 
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="password setters & getters">
    public function setPassword($value)
    {
        $this->password = \Nette\Security\Passwords::hash($value);
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


    public function addRole(Role $element)
    {
        if (!$this->role->contains($element)) {
            $this->role->add($element);
        }
        return $this;
    }

    public function removeRole(Role $element)
    {
        if ($this->role->contains($element)) {
            $this->role->removeElement($element);
        }
        return $this;
    }

    /**
     * 
     * @return \Doctrine\ORM\PersistentCollection
     */
    public function getRoles()
    {
        return $this->role;
    }

    /**
     * 
     * @return array
     */
    public function getRolesArray()
    {
        $array = array();
        foreach ($this->role as $role) {
            $array[$role->getId()] = $role->getName();
        }
        return $array;
    }

    // </editor-fold>
}
