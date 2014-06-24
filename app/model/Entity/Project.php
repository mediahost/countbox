<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="project")
 * @property string $name
 */
class Project extends Entity
{

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Company", fetch="EAGER")
     * @var Company
     */
    protected $company;

    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="project", fetch="LAZY")
     * @ORM\OrderBy({"dueDate" = "ASC"})
     * @var array<Task>
     */
    protected $tasks;

    public function __construct()
    {
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection;
    }

    // <editor-fold defaultstate="collapsed" desc="setters">
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="tasks getters & setters">

    /**
     * 
     * @return int
     */
    public function getTasksCount()
    {
        return $this->tasks->count();
    }

    /**
     * 
     * @param Task $element
     * @param type $clear
     * @return self
     */
    public function addTask(Task $element, $clear = FALSE)
    {
        if ($clear) {
            $this->clearTasks();
        }
        if (!$this->tasks->contains($element)) {
            $this->tasks->add($element);
        }
        return $this;
    }

    /**
     * 
     * @param Task $element
     * @return self
     */
    public function removeTask(Task $element)
    {
        if ($this->tasks->contains($element)) {
            $this->tasks->removeElement($element);
        }
        return $this;
    }

    /**
     * 
     * @return self
     */
    public function clearTasks()
    {
        $this->tasks->clear();
        return $this;
    }

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
