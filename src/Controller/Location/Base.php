<?php

declare(strict_types=1);

namespace App\Controller\Location;

use App\Controller\BaseController;
use App\Service\Location\Create;
use App\Service\Location\Delete;
use App\Service\Location\Find;
use App\Service\Location\Update;

abstract class Base extends BaseController
{
    protected function getServiceFindLocation(): Find
    {
        return $this->container->get('find_location_service');
    }

    protected function getServiceCreateLocation(): Create
    {
        return $this->container->get('create_location_service');
    }

    protected function getServiceUpdateLocation(): Update
    {
        return $this->container->get('update_location_service');
    }

    protected function getServiceDeleteLocation(): Delete
    {
        return $this->container->get('delete_location_service');
    }
}
