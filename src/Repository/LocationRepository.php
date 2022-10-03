<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Location;

final class LocationRepository extends BaseRepository
{
    public function checkAndGetLocation(int $locationId): Location
    {
        $query = 'SELECT * FROM `locations` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $locationId);
        $statement->execute();
        $location = $statement->fetchObject(Location::class);
        if (! $location) {
            throw new \App\Exception\Location('Location not found.', 404);
        }

        return $location;
    }

    public function getLocations(): array
    {
        $query = 'SELECT * FROM `locations` ORDER BY `id`';
        $statement = $this->database->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function getQueryLocationsByPage(): string
    {
        return "
            SELECT *
            FROM `locations`
            WHERE `name` LIKE CONCAT('%', :name, '%')
            ORDER BY `id`
        ";
    }

    public function getLocationsByPage(
        int $page,
        int $perPage,
        ?string $name
    ): array {
        $params = [
            'name' => is_null($name) ? '' : $name,
        ];
        $query = $this->getQueryLocationsByPage();
        $statement = $this->database->prepare($query);
        $statement->bindParam('name', $params['name']);
        $statement->execute();
        $total = $statement->rowCount();

        return $this->getResultsWithPagination(
            $query,
            $page,
            $perPage,
            $params,
            $total
        );
    }

    public function createLocation(Location $location): Location
    {
        $query = '
            INSERT INTO `locations`
                (`name`)
            VALUES
                (:name)
        ';
        $statement = $this->database->prepare($query);
        $name = $location->getName();
        $statement->bindParam(':name', $name);
        $statement->execute();

        return $this->checkAndGetLocation((int) $this->database->lastInsertId());
    }

    public function updateLocation(Location $location): Location
    {
        $query = '
            UPDATE `locations`
            SET `name` = :name
            WHERE `id` = :id
        ';
        $statement = $this->database->prepare($query);
        $id = $location->getId();
        $name = $location->getName();
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->execute();

        return $this->checkAndGetLocation((int) $id);
    }

    public function deleteLocation(int $locationId): void
    {
        $query = 'DELETE FROM `locations` WHERE `id` = :id';
        $statement = $this->database->prepare($query);
        $statement->bindParam(':id', $locationId);
        $statement->execute();
    }
}
