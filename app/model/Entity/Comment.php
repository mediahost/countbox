<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment extends Entity
{

    /**
     * @ORM\Column(name="message_html", type="text")
     */
    protected $message;

    // <editor-fold defaultstate="collapsed" desc="setters">
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">
    // </editor-fold>
}
