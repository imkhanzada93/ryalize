<?php

declare(strict_types=1);

namespace App\Controller\Location;

use Slim\Http\Request;
use Slim\Http\Response;

final class GetAll extends Base
{
    public function __invoke(
        Request $request,
        Response $response
    ): Response {
        $page = $request->getQueryParam('page', null);
        $perPage = $request->getQueryParam('perPage', null);
        $name = $request->getQueryParam('name', null);

        $locations = $this->getServiceFindLocation()
            ->getLocationsByPage((int) $page, (int) $perPage, $name);

        return $this->jsonResponse($response, 'success', $locations, 200);
    }
}
