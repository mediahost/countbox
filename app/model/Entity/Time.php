<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nette\Utils\DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="time")
 * @property DateTime $start
 * @property DateTime $end
 * @method self setStart($value)
 * @method self setEnd($value)
 * @method self setUser(User $entity)
 * @method self setTask(Task $entity)
 */
class Time extends Entity
{

    private $format = "d.m.Y H:i";

    /**
     * @ORM\Column(name="start_time", type="datetime")
     * @var DateTime
     */
    protected $start;

    /**
     * @ORM\Column(name="end_time", type="datetime")
     * @var DateTime
     */
    protected $end;

    /**
     * @ORM\ManyToOne(targetEntity="User", fetch="LAZY")
     * @var User
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Task", fetch="LAZY")
     * @var Task
     */
    protected $task;

    // <editor-fold defaultstate="collapsed" desc="setters">

    /**
     * Set interval from end time(default) or start time
     * @param int $minutes
     * @param bool $fromEnd set start counting from end time 
     */
    public function setInterval($minutes, $fromEnd = TRUE)
    {
        $minutesInt = (int) $minutes;
        if ($fromEnd) {
            $zeroTime = $this->getEnd();
            $modifiedTime = new DateTime($zeroTime);
            $modifiedTime->modify("- {$minutesInt} minute");
            $this->setStart($modifiedTime);
            $this->setEnd(new DateTime($zeroTime));
        } else {
            $zeroTime = $this->getStart();
            $modifiedTime = new DateTime($zeroTime);
            $modifiedTime->modify("+ {$minutesInt} minute");
            $this->setStart(new DateTime($zeroTime));
            $this->setEnd($modifiedTime);
        }
    }

    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">

    /**
     * 
     * @return DateTime
     */
    public function getStart()
    {
        return DateTime::from($this->start);
    }

    /**
     * 
     * @return DateTime
     */
    public function getEnd()
    {
        return DateTime::from($this->end);
    }

    /**
     * Return absolute diff in minutes
     * @return string
     */
    public function getMinutes()
    {
        return $this->getStart()->diff($this->getEnd(), TRUE)->format("%i");
    }

    // </editor-fold>

    /**
     * Render entity
     * @return string
     */
    public function render()
    {
        return $this->getStart()->format($this->format) . " - " . $this->getEnd()->format($this->format);
    }

}
