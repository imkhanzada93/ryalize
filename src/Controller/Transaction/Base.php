<?php

declare(strict_types=1);

namespace App\Controller\Transaction;

use App\Controller\BaseController;
use App\Exception\Transaction;
use App\Service\Transaction\TransactionService;

abstract class Base extends BaseController
{
    protected function getTransactionService(): TransactionService
    {
        return $this->container->get('transaction_service');
    }

    protected function getAndValidateUserId(array $input): int
    {
        if (isset($input['decoded']) && isset($input['decoded']->sub)) {
            return (int) $input['decoded']->sub;
        }

        throw new Transaction('Invalid user. Permission failed.', 400);
    }

    protected function getAndValidateLocationId(array $input): int
    {
        if (isset($input['decoded']) && isset($input['decoded']->sub)) {
            return (int) $input['decoded']->sub;
        }

        throw new Transaction('Invalid location. Permission failed.', 400);
    }
}
