<?php

namespace Acme\Account\UseCase;


use Acme\Account\Model\AccountRepository;

class ShowAccount
{
    /**
     * @var AccountRepository
     */
    private $accountRepository;

    /**
     * ShowAccount constructor.
     * @param AccountRepository $accountRepository
     */
    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function execute(int $accountId)
    {
        $account = $this->accountRepository->findAccount($accountId);
        return [
            'id' => $account->getId(),
            'name' => $account->getName(),
            'balance' => $account->getBalance()->getValue(),
        ];
    }
}