<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="author")
 */
class Author extends \Kdyby\Doctrine\Entities\IdentifiedEntity
{

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $surname;

    public function setFirstname($value)
    {
        $this->firstname = $value;
        return $this;
    }

    public function setSurname($value)
    {
        $this->surname = $value;
        return $this;
    }

}
