<?php

namespace App\Repository;


use Acme\Account\Model\Account;
use Acme\Account\Model\Exception\AccountNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class AccountRepository extends ServiceEntityRepository implements \Acme\Account\Model\AccountRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Account::class);
    }

    /**
     * @param int $number
     * @return Account
     *
     * @throws AccountNotFoundException
     */
    public function findAccount(int $number): Account
    {
        $account = $this->findOneBy([
            'id' => $number
        ]);

        if (false === $account instanceof Account) {
            throw new AccountNotFoundException(sprintf('account %d not found.', $number));
        }

        return $account;
    }

    /**
     * @param Account $account
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function create(Account $account): void
    {
        $this->_em->persist($account);
        $this->_em->flush($account);
    }

    /**
     * @param Account $account
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Account $account): void
    {
        $this->_em->flush($account);
    }


}