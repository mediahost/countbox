<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comment")
 * @property string $message
 * @property \Nette\Utils\DateTime $sendTime
 * @property bool $public
 * @property Task $task
 * @property User $sender
 * @method bool getPublic()
 * @method Task getTask()
 * @method User getSender()
 * @method self setSendTime(DateTime $value)
 * @method self setPublic(bool $value)
 * @method self setTask(Task $value)
 * @method self setSender(User $value)
 */
class Comment extends Entity
{

    /**
     * @ORM\Column(name="message_html", type="text")
     */
    protected $message;

    /**
     * @ORM\Column(name="send_time", type="datetime")
     */
    protected $sendTime;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $public = FALSE;

    /**
     * @ORM\ManyToOne(targetEntity="Task", fetch="LAZY")
     * @var Task
     */
    protected $task;

    /**
     * @ORM\ManyToOne(targetEntity="User", fetch="EAGER")
     * @var User
     */
    protected $sender;

    // <editor-fold defaultstate="collapsed" desc="setters">
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">

    /**
     * 
     * @return \Nette\Utils\DateTime
     */
    public function getSendTime()
    {
        return $this->sendTime ? $this->sendTime : new \Nette\Utils\DateTime;
    }

    // </editor-fold>

    /**
     * Render Entity
     * @return string
     */
    public function render()
    {
        return $this->getMessage();
    }

}
