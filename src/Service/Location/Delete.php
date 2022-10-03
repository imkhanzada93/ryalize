<?php

declare(strict_types=1);

namespace App\Service\Location;

final class Delete extends Base
{
    public function delete(int $locationId): void
    {
        $this->getOneFromDb($locationId);
        $this->locationRepository->deleteLocation($locationId);
    }
}
