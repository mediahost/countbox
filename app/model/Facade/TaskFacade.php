<?php

namespace App\Model\Facade;

use App\Model\Entity\Task;

class TaskFacade extends BaseFacade
{

    /**
     * Find task solvers with any time record
     * @param Task $task
     * @return array
     */
    public function findSolvers(Task $task)
    {
        $query = $this->dao->createQueryBuilder()
                ->select('u')
                ->from('App\Model\Entity\User', 'u')
                ->innerJoin('App\Model\Entity\Time', 't', 'AND', 't.user = u.id')
                ->where('t.task = ?1')
                ->setParameter(1, $task->getId());
        return $query->getQuery()->execute();
    }

}
