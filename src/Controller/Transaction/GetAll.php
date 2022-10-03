<?php

declare(strict_types=1);

namespace App\Controller\Transaction;

use Slim\Http\Request;
use Slim\Http\Response;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
        $filter = $_GET['filter'];
        $userId = $this->getAndValidateUserId($input);
        $locationId = $this->getAndValidateLocationId($input);
        $page = $request->getQueryParam('page', null);
        $perPage = $request->getQueryParam('perPage', null);
        $amount = $request->getQueryParam('amount', null);
        $description = $request->getQueryParam('description', null);
        $status = $request->getQueryParam('status', null);

        $transactions = $this->getTransactionService()->getTransactionsByPage(
            $userId,
            (int) $page,
            (int) $perPage,
            $amount,
            $description,
            $status,
            $filter
        );

        return $this->jsonResponse($response, 'success', $transactions, 200);
    }
}
