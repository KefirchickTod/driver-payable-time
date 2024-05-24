<?php

declare(strict_types=1);

namespace App\Drivers\Trips\Domain;

final readonly class TripGroup
{
    public function __construct(
        private int $id,
        private Trips $trips,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTrips(): Trips
    {
        return $this->trips;
    }
}
