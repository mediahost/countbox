<?php

namespace App\Model\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="role")
 */
class Role extends \Kdyby\Doctrine\Entities\IdentifiedEntity
{

    /**
     * @ORM\Column(type="string", length=128, unique=true)
     */
    protected $name;

    // <editor-fold defaultstate="collapsed" desc="setters">
    public function setName($value)
    {
        $this->name = $value;
        return $this;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">
    public function getName()
    {
        return $this->name;
    }

    // </editor-fold>
}
