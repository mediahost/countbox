<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 * @property string $name
 * @property string $text
 * @property bool $done
 * @property bool $inProcess
 * @property int $priority
 * @property \Nette\Utils\DateTime $dueDate
 * @method string getName()
 * @method string getText()
 * @method bool getDone()
 * @method bool getInProcess()
 * @method int getPriority()
 * @method \Nette\Utils\DateTime getDueDate()
 * @method Task setName(string $value)
 * @method Task setText(string $value)
 * @method Task setDone(bool $value)
 * @method Task setInProcess(bool $value)
 * @method Task setPriority(int $value)
 * @method Task setDueDate(\Nette\Utils\DateTime $value)
 */
class Task extends Entity
{

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $name;

    /**
     * @ORM\Column(name="text_html", type="text")
     */
    protected $text;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $done = FALSE;

    /**
     * @ORM\Column(name="in_process", type="boolean")
     */
    protected $inProcess = FALSE;

    /**
     * @ORM\Column(type="smallint")
     */
    protected $priority = 5;

    /**
     * @ORM\Column(name="create_date", type="datetime")
     */
    protected $createDate;

    /**
     * @ORM\Column(name="due_date", type="datetime")
     */
    protected $dueDate;

    // <editor-fold defaultstate="collapsed" desc="setters">
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">
    // </editor-fold>

    /**
     * Render entity
     * @return string
     */
    public function render()
    {
        return $this->getName();
    }

}
