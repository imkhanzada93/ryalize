<?php

declare(strict_types=1);

namespace App\Controller\Location;

use Slim\Http\Request;
use Slim\Http\Response;

final class Update extends Base
{
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $input = (array) $request->getParsedBody();
        $location = $this->getServiceUpdateLocation()->update($input, (int) $args['id']);

        return $this->jsonResponse($response, 'success', $location, 200);
    }
}
