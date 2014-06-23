<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="company")
 * @property string $name
 * @property Address $address
 */
class Company extends Entity
{

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $name;

    /**
     * @ORM\OneToOne(targetEntity="Address", fetch="EAGER")
     */
    protected $address;

    /**
     * @ORM\ManyToMany(targetEntity="User", fetch="LAZY")
     */
    protected $user;

    public function __construct()
    {
        $this->user = new \Doctrine\Common\Collections\ArrayCollection;
    }

    // <editor-fold defaultstate="collapsed" desc="setters">
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">
    // </editor-fold>
}
