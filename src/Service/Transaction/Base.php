<?php

declare(strict_types=1);

namespace App\Service\Transaction;

use App\Entity\Transaction;
use App\Repository\TransactionRepository;
use App\Service\BaseService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{

    protected TransactionRepository $transactionRepository;


    public function __construct(
        TransactionRepository $transactionRepository
    ) {
        $this->transactionRepository = $transactionRepository;
    }

    protected function getTransactionRepository(): TransactionRepository
    {
        return $this->transactionRepository;
    }

    protected static function validateTransactionAmount(int $amount): int
    {
        if (! v::numeric()->validate($amount)) {
            throw new \App\Exception\Transaction('Invalid amount.', 400);
        }

        return $amount;
    }

    protected static function validateTransactionlocationId(int $locationId): int
    {
        if (! v::numeric()->validate($locationId)) {
            throw new \App\Exception\Transaction('Invalid locationId.', 400);
        }

        return $locationId;
    }
    protected static function validateTransactionStatus(int $status): int
    {
        if (! v::numeric()->between(0, 1)->validate($status)) {
            throw new \App\Exception\Transaction('Invalid status', 400);
        }

        return $status;
    }

    protected function getTransactionFromCache(int $transactionId, int $userId): object
    {
        $transaction = $this->getTransactionFromDb($transactionId, $userId)->toJson();
        return $transaction;
    }

    protected function getTransactionFromDb(int $transactionId, int $userId): Transaction
    {
        return $this->getTransactionRepository()->checkAndGetTransaction($transactionId, $userId);
    }
}
