<?php

declare(strict_types=1);

namespace App\Service\Location;

use App\Entity\Location;
use App\Repository\LocationRepository;
use App\Service\BaseService;
use Respect\Validation\Validator as v;

abstract class Base extends BaseService
{

    protected LocationRepository $locationRepository;


    public function __construct(
        LocationRepository $locationRepository
    ) {
        $this->locationRepository = $locationRepository;
    }

    protected static function validateLocationName(string $name): string
    {
        if (! v::length(1, 50)->validate($name)) {
            throw new \App\Exception\Location('The name of the location is invalid.', 400);
        }

        return $name;
    }

    protected function getOneFromCache(int $locationId): object
    {
        $location = $this->getOneFromDb($locationId)->toJson();
        return $location;
    }

    protected function getOneFromDb(int $locationId): Location
    {
        return $this->locationRepository->checkAndGetLocation($locationId);
    }
}
