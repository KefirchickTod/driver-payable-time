<?php

declare(strict_types=1);

namespace App\Drivers\Trips\Models;

use App\Drivers\Trips\Domain\Trip;

interface DriverTripRepositoryInterface
{
    public function all(): array;

    public function save(Trip $trip);
}
