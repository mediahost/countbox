<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM,
    Kdyby\Doctrine\Entities\IdentifiedEntity;

/**
 * Entity
 *
 * @author Petr Poupě
 */
abstract class Entity extends IdentifiedEntity implements IEntity
{

    protected function getEntityArray($arrayOfEntities, $keysOnly = FALSE)
    {
        $array = array();
        foreach ($arrayOfEntities as $entity) {
            $array[$entity->getId()] = $keysOnly ? $entity->getId() : (string) $entity;
        }
        return $array;
    }
    
    public function __toString()
    {
        return $this->render();
    }

}
