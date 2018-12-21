<?php

namespace Acme\Account\UseCase;

use Acme\Account\Model\AccountRepository;
use Acme\Account\Model\HistoryRepository;
use Acme\Account\Model\Money;
use Acme\Account\Model\Transfer;

class TransferMoney
{
    /**
     * @var AccountRepository
     */
    private $accountRepository;

    /**
     * @var HistoryRepository
     */
    private $historyRepository;

    /**
     * TransferMoney constructor.
     * @param AccountRepository $accountRepository
     * @param HistoryRepository $historyRepository
     */
    public function __construct(AccountRepository $accountRepository, HistoryRepository $historyRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->historyRepository = $historyRepository;
    }

    /**
     * @param int $sourceId
     * @param int $destinationId
     * @param int $moneyValue
     * @throws \Exception
     */
    public function execute(int $sourceId, int $destinationId, int $moneyValue)
    {
        $source = $this->accountRepository->findAccount($sourceId);
        $destination = $this->accountRepository->findAccount($destinationId);
        $money = new Money($moneyValue);

        $history = (new Transfer($source, $destination))->run($money);

        $this->accountRepository->update($source);
        $this->accountRepository->update($destination);
        $this->historyRepository->add($history);
    }
}