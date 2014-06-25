<?php

namespace App\Model\Facade;

use App\Model\Entity\Task;
use App\Model\Entity\User;
use App\Model\Entity\Time;

class TimeFacade extends BaseFacade
{

    public function findAllByTask(Task $task, User $user = NULL)
    {
        $query = $this->dao->createQueryBuilder()
                ->select('tm')
                ->from('App\Model\Entity\Time', 'tm')
                ->innerJoin('App\Model\Entity\Task', 'tk', 'AND', 'tm.task = tk.id')
                ->where('tm.task = ?1')
                ->setParameter(1, $task->getId());
        if ($user) {
            $query->andWhere('tm.user = ?2')
                    ->setParameter(2, $user->getId());
        }
        return $query->getQuery()->execute();
    }

    /**
     * Return time of task
     * @param Task $task
     * @param User $user
     * @return \App\DateInterval
     */
    public function getTotalTime(Task $task, User $user = NULL, $format = NULL)
    {
        $minutes = 0;
        $records = $this->findAllByTask($task, $user);
        /* @var $record Time */
        foreach ($records as $record) {
            $minutes += $record->getMinutes();
        }
        $interval = \App\DateInterval::create(0, 0, 0, $minutes, 0);
        return $format ? $interval->format($format) : $interval;
    }

}
