<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Named entity - $name is string(128)
 * @property string $name string(128)
 * @method string getName()
 */
abstract class NamedEntity extends Entity
{

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $name;

    /**
     * Render entity
     * @return string
     */
    public function render()
    {
        return $this->getName();
    }

}
