<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="role")
 * @method self setName(string $value)
 */
class Role extends NamedEntity
{
    // <editor-fold defaultstate="collapsed" desc="setters">
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">
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
