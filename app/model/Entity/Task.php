<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 * @property string $text
 * @property bool $done
 * @property bool $inProcess
 * @property int $priority
 * @property \Nette\Utils\DateTime $dueDate
 * @method string getText()
 * @method bool getDone()
 * @method bool getInProcess()
 * @method int getPriority()
 * @method \Nette\Utils\DateTime getCreateDate()
 * @method \Nette\Utils\DateTime getDueDate()
 * @method self setName(string $value)
 * @method self setText(string $value)
 * @method self setDone(bool $value)
 * @method self setInProcess(bool $value)
 * @method self setPriority(int $value)
 * @method self setDueDate(\Nette\Utils\DateTime $value)
 */
class Task extends NamedEntity
{

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

    /**
     * @ORM\ManyToOne(targetEntity="User", fetch="LAZY")
     * @var User
     */
    protected $solver;

    /**
     * @ORM\ManyToOne(targetEntity="Project", fetch="EAGER")
     * @var Project
     */
    protected $project;

    /**
     * @ORM\ManyToOne(targetEntity="Status", fetch="EAGER")
     * @var Status
     */
    protected $status;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", fetch="LAZY")
     * @var array<Project>
     */
    protected $tags;

    /**
     * @ORM\OneToMany(targetEntity="Comment", fetch="LAZY",
     * mappedBy="task", cascade={"remove"})
     * @ORM\OrderBy({"sendTime" = "ASC"})
     * @var array<Comment>
     */
    protected $comments;

    public function __construct()
    {
        $this->createDate = new \Nette\Utils\DateTime;
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection;
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection;
    }

    // <editor-fold defaultstate="collapsed" desc="setters">

    public function getName()
    {
        return $this->name ? $this->name : ($this->getId() ? "Task #" . $this->getId() : NULL);
    }

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
