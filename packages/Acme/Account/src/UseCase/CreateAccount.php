<?php

namespace Acme\Account\UseCase;


use Acme\Account\Model\Account;
use Acme\Account\Model\AccountRepository;
use Acme\Account\Model\Balance;

class CreateAccount
{
    /**
     * @var AccountRepository
     */
    private $accountRepository;

    /**
     * CreateAccount constructor.
     * @param AccountRepository $accountRepository
     */
    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * @param string $name
     * @param int $money
     * @return int
     */
    public function execute(string $name, int $money) :int
    {
        $account = new Account(new Balance($money), $name);
        $this->accountRepository->create($account);

        return $account->getId();
    }
}