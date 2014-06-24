<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="company")
 * @property Address $address
 * @method Company setName(string $name)
 */
class Company extends NamedEntity
{

    /**
     * @ORM\OneToOne(targetEntity="Address", fetch="EAGER")
     * @var Address
     */
    protected $address;

    /**
     * @ORM\ManyToMany(targetEntity="User", fetch="LAZY")
     * @var array<User>
     */
    protected $users;

    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="company", fetch="LAZY")
     * @ORM\OrderBy({"name" = "ASC"})
     * @var array<Project>
     */
    protected $projects;

    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection;
        $this->projects = new \Doctrine\Common\Collections\ArrayCollection;
    }

    // <editor-fold defaultstate="collapsed" desc="setters">
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="users getters & setters">


    public function addUser(User $element, $clear = FALSE)
    {
        if ($clear) {
            $this->clearUsers();
        }
        if (!$this->users->contains($element)) {
            $this->users->add($element);
        }
        return $this;
    }

    public function removeUser(User $element)
    {
        if ($this->users->contains($element)) {
            $this->users->removeElement($element);
        }
        return $this;
    }

    public function clearUsers()
    {
        $this->users->clear();
        return $this;
    }

    public function hasUser(User $element)
    {
        return $this->users->contains($element);
    }

    /**
     * 
     * @param bool $keysOnly if TRUE than return only keys
     * @return array
     */
    public function getUsersArray($keysOnly = FALSE)
    {
        return $this->getEntityArray($this->users, $keysOnly);
    }

    // </editor-fold>

    /**
     * Render entity
     * @return string
     */
    public function render()
    {
        return $this->getName();
    }

}
