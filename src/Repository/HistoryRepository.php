<?php

namespace App\Repository;


use Acme\Account\Model\History;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class HistoryRepository extends ServiceEntityRepository implements \Acme\Account\Model\HistoryRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, History::class);
    }

    /**
     * @param History $history
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add(History $history): void
    {
        $this->_em->persist($history);
        $this->_em->flush($history);
    }

}