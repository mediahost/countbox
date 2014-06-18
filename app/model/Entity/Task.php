<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 */
class Task extends \Kdyby\Doctrine\Entities\IdentifiedEntity
{

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $name;

    // <editor-fold defaultstate="collapsed" desc="setters">
    /**
     * 
     * @param type $value
     * @return Task
     */
    public function setName($value)
    {
        $this->name = $value;
        return $this;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">
    /**
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    // </editor-fold>
}
