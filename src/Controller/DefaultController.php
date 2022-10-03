<?php

declare(strict_types=1);

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

final class DefaultController extends BaseController
{
    private const API_VERSION = '2.14.0';

    public function getHelp(Request $request, Response $response): Response
    {
        $app = $this->container->get('settings')['app'];
        $url = $app['domain'];
        $endpoints = [
            'transactions' => $url . '/api/v1/transactions',
            'users' => $url . '/api/v1/users',
            'locations' => $url . '/api/v1/locations',
            'docs' => $url . '/docs/index.html',
            'status' => $url . '/status',
            'this help' => $url . '',
        ];
        $message = [
            'endpoints' => $endpoints,
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $this->jsonResponse($response, 'success', $message, 200);
    }

    public function getStatus(Request $request, Response $response): Response
    {
        $status = [
            'stats' => $this->getDbStats(),
            'MySQL' => 'OK',
            'version' => self::API_VERSION,
            'timestamp' => time(),
        ];

        return $this->jsonResponse($response, 'success', $status, 200);
    }

    private function getDbStats(): array
    {
        $transactionService = $this->container->get('transaction_service');
        $userService = $this->container->get('find_user_service');
        $locationService = $this->container->get('find_location_service');

        return [
            'transactions' => count($transactionService->getAllTransactions()),
            'users' => count($userService->getAll()),
            'locations' => count($locationService->getAll()),
        ];
    }

}
