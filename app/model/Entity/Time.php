<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;
use Nette\Utils\DateTime;
use DateTimeInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="time")
 */
class Time extends Entity
{

    /**
     * @ORM\Column(name="start_time", type="datetime")
     */
    protected $start;

    /**
     * @ORM\Column(name="end_time", type="datetime")
     */
    protected $end;

    // <editor-fold defaultstate="collapsed" desc="setters">
    /**
     * 
     * @param type $value
     * @return Time
     */
    public function setStart($value)
    {
        if (!$value instanceof DateTimeInterface) {
            $value = new DateTime($value);
        }
        $this->start = $value;
        return $this;
    }

    /**
     * 
     * @param type $value
     * @return Time
     */
    public function setEnd($value)
    {
        if (!$value instanceof DateTimeInterface) {
            $value = new DateTime($value);
        }
        $this->end = $value;
        return $this;
    }

    /**
     * Set interval from end time(default) or start time
     * @param int $minutes
     * @param bool $fromEnd set start counting from end time 
     */
    public function setInterval($minutes, $fromEnd = TRUE)
    {
        $minutesInt = (int) $minutes;
        if ($fromEnd) {
            $zeroTime = $this->end;
            $modifiedTime = new DateTime($zeroTime);
            $modifiedTime->modify("- {$minutesInt} minute");
            $this->start = $modifiedTime;
            $this->end = new DateTime($zeroTime);
        } else {
            $zeroTime = $this->start;
            $modifiedTime = new DateTime($zeroTime);
            $modifiedTime->modify("+ {$minutesInt} minute");
            $this->start = new DateTime($zeroTime);
            $this->end = $modifiedTime;
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
        return new DateTime($this->start);
    }

    /**
     * 
     * @return DateTime
     */
    public function getEnd()
    {
        return new DateTime($this->end);
    }
    
    public function getMinutes()
    {
        return $this->getEnd() - $this->getStart();
    }

    // </editor-fold>
}
