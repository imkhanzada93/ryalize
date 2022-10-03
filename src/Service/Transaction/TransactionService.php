<?php

declare(strict_types=1);

namespace App\Service\Transaction;

use App\Entity\Transaction;

final class TransactionService extends Base
{
    public function getTransactionsByPage(
        int $userId,
        int $page,
        int $perPage,
        ?string $amount,
        ?string $description,
        ?string $status,
        ?string $filter
    ): array {
        if ($page < 1) {
            $page = 1;
        }
        if ($perPage < 1) {
            $perPage = self::DEFAULT_PER_PAGE_PAGINATION;
        }

        return $this->getTransactionRepository()->getTransactionsByPage(
            $userId,
            $page,
            $perPage,
            $amount,
            $description,
            $status,
            $filter
        );
    }

    public function getAllTransactions(): array
    {
        return $this->getTransactionRepository()->getAllTransactions();
    }

    public function getOne(int $transactionId, int $userId, int $locationId): object
    {
        $transaction = $this->getTransactionFromDb($transactionId, $userId, $locationId)->toJson();
        return $transaction;
    }

    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->amount)) {
            throw new \App\Exception\Transaction('The field "amount" is required.', 400);
        }
        $mytransaction = new Transaction();
        $mytransaction->updateAmount(self::validateTransactionAmount($data->amount));
        $desc = $data->description ?? null;
        $mytransaction->updateDescription($desc);
        $locationId = 0;
        if (isset($data->locationId)) {
            $locationId = self::validateTransactionlocationId($data->locationId);
        }
        $mytransaction->updatelocationId($locationId);
        $status = 0;
        if (isset($data->status)) {
            $status = self::validateTransactionStatus($data->status);
        }
        $mytransaction->updateStatus($status);
        $mytransaction->updateUserId((int) $data->decoded->sub);
        /** @var Transaction $transaction */
        $transaction = $this->getTransactionRepository()->create($mytransaction);
        return $transaction->toJson();
    }

    public function update(array $input, int $transactionId): object
    {
        $data = $this->validateTransaction($input, $transactionId);
        /** @var Transaction $transaction */
        $transaction = $this->getTransactionRepository()->update($data);
        return $transaction->toJson();
    }

    public function delete(int $transactionId, int $userId): void
    {
        $this->getTransactionFromDb($transactionId, $userId);
        $this->getTransactionRepository()->delete($transactionId, $userId);
    }

    private function validateTransaction(array $input, int $transactionId): Transaction
    {
        $transaction = $this->getTransactionFromDb($transactionId, (int) $input['decoded']->sub);
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->amount) && ! isset($data->status)) {
            throw new \App\Exception\Transaction('Enter the data to update the transaction.', 400);
        }
        if (isset($data->amount)) {
            $transaction->updateAmount(self::validateTransactionAmount($data->amount));
        }
        if (isset($data->description)) {
            $transaction->updateDescription($data->description);
        }
        if (isset($data->status)) {
            $transaction->updateStatus(self::validateTransactionStatus($data->status));
        }
        $transaction->updateUserId((int) $data->decoded->sub);

        return $transaction;
    }
}
