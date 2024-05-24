<?php

declare(strict_types=1);

namespace App\Drivers\Trips\Infrastructure\Persistence;

use App\Drivers\Trips\Domain\Trip;
use App\Drivers\Trips\Domain\TripGroup;
use App\Drivers\Trips\Domain\Trips;
use App\Drivers\Trips\Models\DriverTripRepositoryInterface;
use App\Drivers\Trips\Models\Trip as TripModel;

class MySqlDriversTripRepository implements DriverTripRepositoryInterface
{
    public function all(): array
    {
        $data = TripModel::all()->groupBy('driver_id')->toArray();

        $groups = [];
        foreach ($data as $id => $trips) {
            $groups[] = new TripGroup($id, new Trips(array_map($this->transformer(...), $trips)));
        }

        return $groups;
    }

    private function transformer(array $data): Trip
    {
        return Trip::createFromArray($data);
    }

    public function save(Trip $trip): void
    {
        TripModel::create($trip->value());
    }
}
