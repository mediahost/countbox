<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="project")
 */
class Project extends Entity
{

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $name;

    // <editor-fold defaultstate="collapsed" desc="setters">
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">
    // </editor-fold>
}
