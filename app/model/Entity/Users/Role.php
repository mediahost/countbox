<?php

namespace App\Model\Entity\User;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="role")
 * @property string $name
 * @method string getName()
 * @method Role setName(string $value)
 */
class Role extends \Kdyby\Doctrine\Entities\IdentifiedEntity
{

    /**
     * @ORM\Column(type="string", length=128, unique=true)
     */
    protected $name;

    // <editor-fold defaultstate="collapsed" desc="setters">
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">
    // </editor-fold>
    
    public function __toString()
    {
        return $this->render();
    }
    
    /**
     * Render entity
     * @return string
     */
    public function render()
    {
        return $this->name;
    }
}
