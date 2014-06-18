<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment extends \Kdyby\Doctrine\Entities\IdentifiedEntity
{

    /**
     * @ORM\Column(name="message_html", type="text")
     */
    protected $message;

    // <editor-fold defaultstate="collapsed" desc="setters">
    /**
     * 
     * @param type $value
     * @return Comment
     */
    public function setMessage($value)
    {
        $this->message = $value;
        return $this;
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">
    /**
     * 
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    // </editor-fold>
}
