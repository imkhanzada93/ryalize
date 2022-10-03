<?php

declare(strict_types=1);

namespace App\Service\Location;

use App\Entity\Location;

final class Create extends Base
{
    public function create(array $input): object
    {
        $data = json_decode((string) json_encode($input), false);
        if (! isset($data->name)) {
            throw new \App\Exception\Location('Invalid data: name is required.', 400);
        }
        $mylocation = new Location();
        $mylocation->updateName(self::validateLocationName($data->name));
        /** @var Location $location */
        $location = $this->locationRepository->createLocation($mylocation);
        return $location->toJson();
    }
}
