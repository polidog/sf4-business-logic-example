<?php declare(strict_types=1);

namespace Acme\Account\Model;

use Acme\Account\Model\Exception\AccountNotFoundException;

interface AccountRepository
{
    /**
     * @param int $number
     * @return Account
     *
     * @throws AccountNotFoundException
     */
    public function findAccount(int $number): Account;

    /**
     * @param Account $account
     */
    public function create(Account $account): void;

    /**
     * @param Account $account
     */
    public function update(Account $account): void;
}