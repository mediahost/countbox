<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Tracy\Debugger as Debug;

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

    /**
     * @ORM\OneToOne(targetEntity="Time", fetch="EAGER", 
     * cascade={"persist", "remove"})
     * @var Time
     */
    protected $time;

    /**
     * Generator for $time
     * @var int
     */
    private $minutes;

    // <editor-fold defaultstate="collapsed" desc="setters">

    /**
     * Set task & reset time
     * @param Task $entity
     * @return self
     */
    public function setTask(Task $entity)
    {
        $this->task = $entity;
        $this->resetTime();
        return $this;
    }

    /**
     * Set sender & reset time
     * @param User $entity
     * @return self
     */
    public function setSender(User $entity)
    {
        $this->sender = $entity;
        $this->resetTime();
        return $this;
    }

    /**
     * Set minutes
     * @param int $minutes
     * @return self
     */
    public function setMinutes($minutes)
    {
        $this->minutes = $minutes;
        $this->resetTime();
        return $this;
    }

    /**
     * 
     * @return Time|NULL
     */
    private function resetTime()
    {
        if ($this->minutes > 0) {
            $sender = $this->getSender();
            $task = $this->getTask();
            if ($sender && $task) {
                $this->initTime()
                        ->setUser($sender)
                        ->setTask($task)
                        ->setInterval($this->minutes);
            }
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">

    /**
     * @return Time|NULL
     */
    private function initTime()
    {
        if ($this->time === NULL) {
            $this->time = new Time;
        }
        return $this->time;
    }

    /**
     * Return minutes
     * @return int
     */
    public function getTimeInMinutes()
    {
        if ($this->time) {
            return $this->time->getMinutes();
        } else {
            return 0;
        }
    }

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
