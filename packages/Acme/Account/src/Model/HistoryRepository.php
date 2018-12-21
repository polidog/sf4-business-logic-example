<?php declare(strict_types=1);

namespace Acme\Account\Model;


interface HistoryRepository
{
    public function add(History $history): void;
}