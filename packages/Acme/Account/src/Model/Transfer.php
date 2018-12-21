<?php

namespace Acme\Account\Model;

/**
 * Service
 */
class Transfer
{
    /**
     * @var Account
     */
    private $sourceAccount;

    /**
     * @var Account
     */
    private $destinationAccount;

    /**
     * Transaction constructor.
     * @param Account $sourceAccount
     * @param Account $destinationAccount
     */
    public function __construct(Account $sourceAccount, Account $destinationAccount)
    {
        $this->sourceAccount = $sourceAccount;
        $this->destinationAccount = $destinationAccount;
    }

    /**
     * @param Money $money
     * @return History
     * @throws \Exception
     */
    public function run(Money $money) : History
    {
        $this->sourceAccount->withdraw($money);
        $this->destinationAccount->deposit($money);

        return new History($this->sourceAccount, $this->destinationAccount, $money, new \DateTimeImmutable('now'));
    }
}