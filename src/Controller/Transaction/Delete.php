<?php

declare(strict_types=1);

namespace App\Controller\Transaction;

use Slim\Http\Request;
use Slim\Http\Response;

final class Delete extends Base
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $input = (array) $request->getParsedBody();
        $transactionId = (int) $args['id'];
        $userId = $this->getAndValidateUserId($input);
        $locationId = $this->getAndValidateLocationId($input);
        $this->getTransactionService()->delete($transactionId, $userId, $locationId);

        return $this->jsonResponse($response, 'success', null, 204);
    }
}
