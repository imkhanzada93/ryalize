<?php

declare(strict_types=1);

namespace App\Entity;

final class Transaction
{
    private int $id;

    private int $amount;

    private ?string $description;

    private int $status;

    private int $userId;

    private int $locationId;

    public function toJson(): object
    {
        return json_decode((string) json_encode(get_object_vars($this)), false);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function updateAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function updateDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function updateStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function updateUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getLocationId(): int
    {
        return $this->locationId;
    }

    public function updateLocationId(int $locationId): self
    {
        $this->locationId = $locationId;

        return $this;
    }
}
