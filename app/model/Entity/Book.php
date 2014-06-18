<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="book")
 */
class Book extends \Kdyby\Doctrine\Entities\IdentifiedEntity
{

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $title;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $published;

    /**
     * @ORM\ManyToOne(targetEntity="Author", fetch="EAGER")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    protected $author;

    public function setTitle($value)
    {
        $this->title = $value;
        return $this;
    }

    public function setPublished($value)
    {
        $this->published = $value;
        return $this;
    }

    public function setAuthor(Author $value)
    {
        $this->author = $value;
        return $this;
    }

}
