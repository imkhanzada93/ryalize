<?php

declare(strict_types=1);

namespace App\Service\Location;

use App\Entity\Location;

final class Update extends Base
{
    public function update(array $input, int $locationId): object
    {
        $location = $this->getOneFromDb($locationId);
        $data = json_decode((string) json_encode($input), false);
        if (isset($data->name)) {
            $location->updateName(self::validateLocationName($data->name));
        }
        /** @var Location $locations */
        $locations = $this->locationRepository->updateLocation($location);
        return $locations->toJson();
    }
}
