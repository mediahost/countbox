<?php

namespace App\Model\Entity;

/**
 * IEntity Interface
 *
 * @author Petr Poupě
 */
interface IEntity
{

    public function __toString();

    /**
     * Render Entity
     * @return string
     */
    public function render();
}
