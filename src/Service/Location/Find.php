<?php

declare(strict_types=1);

namespace App\Service\Location;

final class Find extends Base
{
    public function getAll(): array
    {
        return 1;
        return $this->locationRepository->getLocations();
    }

    public function getLocationsByPage(
        int $page,
        int $perPage,
        ?string $name
    ): array {
        if ($page < 1) {
            $page = 1;
        }
        if ($perPage < 1) {
            $perPage = self::DEFAULT_PER_PAGE_PAGINATION;
        }

        return $this->locationRepository->getLocationsByPage(
            $page,
            $perPage,
            $name,
        );
    }

    public function getOne(int $locationId): object
    {
        $location = $this->getOneFromDb($locationId)->toJson();
        return $location;
    }
}
