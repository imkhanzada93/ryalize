<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Transaction;

final class TransactionRepository extends BaseRepository
{
    public function getQueryTransactionsByPage(): string
    {
        return "
            SELECT `transactions`.*, `users`.`name` AS user, `locations`.`name` AS location
            FROM `transactions`
            JOIN `users` ON `users`.`id` =  `transactions`.`userId`
            JOIN `locations` ON `locations`.`id` =  `transactions`.`locationId`
            WHERE `amount` LIKE CONCAT('%', :amount, '%')
            AND `description` LIKE CONCAT('%', :description, '%')
            AND `status` LIKE CONCAT('%', :status, '%')
            AND `users`.`name` LIKE CONCAT('%', :filter, '%')
            ORDER BY `id`
        ";
    }

    public function getTransactionsByPage(
        int $userId,
        int $page,
        int $perPage,
        ?string $amount,
        ?string $description,
        ?string $status,
        ?string $filter
    ): array {
        $params = [
            // 'userId' => $userId,
            'amount' => is_null($amount) ? '' : $amount,
            'filter' => is_null($filter) ? '' : $filter,
            'description' => is_null($description) ? '' : $description,
            'status' => is_null($status) ? '' : $status,
        ];
        $query = $this->getQueryTransactionsByPage();
        $statement = $this->database->prepare($query);
        // $statement->bindParam('userId', $params['userId']);
        $statement->bindParam('filter', $params['filter']);
        $statement->bindParam('amount', $params['amount']);
        $statement->bindParam('description', $params['description']);
        $statement->bindParam('status', $params['status']);
        $statement->execute();
        $total = $statement->rowCount();

        return $this->getResultsWithPagination(
            $query,
            $page,
            $perPage,
            $params,
            $total
        );
    }

    public function checkAndGetTransaction(int $transactionId, int $userId): Transaction
    {
        $query = '
            SELECT * FROM `transactions` WHERE `id` = :id AND `userId` = :userId
        ';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $transactionId);
        $statement->bindParam('userId', $userId);
        $statement->execute();
        $transaction = $statement->fetchObject(Transaction::class);
        if (! $transaction) {
            throw new \App\Exception\Transaction('Transaction not found.', 404);
        }

        return $transaction;
    }

    public function getAllTransactions(): array
    {
        $query = 'SELECT * FROM `transactions` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(Transaction $transaction): Transaction
    {
        $query = '
            INSERT INTO `transactions`
                (`amount`, `description`, `status`, `userId`, `locationId`)
            VALUES
                (:amount, :description, :status, :userId, :locationId)
        ';
        $statement = $this->getDb()->prepare($query);
        $amount = $transaction->getAmount();
        $desc = $transaction->getDescription();
        $status = $transaction->getStatus();
        $userId = $transaction->getUserId();
        $locationId = $transaction->getLocationId();
        $statement->bindParam('amount', $amount);
        $statement->bindParam('description', $desc);
        $statement->bindParam('status', $status);
        $statement->bindParam('userId', $userId);
        $statement->bindParam('locationId', $locationId);
        $statement->execute();

        $transactionId = (int) $this->database->lastInsertId();

        return $this->checkAndGetTransaction($transactionId, (int) $userId);
    }

    public function update(Transaction $transaction): Transaction
    {
        $query = '
            UPDATE `transactions`
            SET `amount` = :amount, `description` = :description, `status` = :status
            WHERE `id` = :id AND `userId` = :userId
        ';
        $statement = $this->getDb()->prepare($query);
        $id = $transaction->getId();
        $amount = $transaction->getAmount();
        $desc = $transaction->getDescription();
        $status = $transaction->getStatus();
        $userId = $transaction->getUserId();
        $locationId = $transaction->getLocationId();
        $statement->bindParam('id', $id);
        $statement->bindParam('amount', $amount);
        $statement->bindParam('description', $desc);
        $statement->bindParam('status', $status);
        $statement->bindParam('userId', $userId);
        $statement->execute();

        return $this->checkAndGetTransaction((int) $id, (int) $userId);
    }

    public function delete(int $transactionId, int $userId): void
    {
        $query = 'DELETE FROM `transactions` WHERE `id` = :id AND `userId` = :userId';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $transactionId);
        $statement->bindParam('userId', $userId);
        $statement->execute();
    }
}
