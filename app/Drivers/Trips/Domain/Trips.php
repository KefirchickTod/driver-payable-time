<?php

declare(strict_types=1);

namespace App\Drivers\Trips\Domain;

use Carbon\Carbon;

final class Trips
{
    /**
     * @var Trip[]
     */
    private array $trips = [];

    public function __construct(array $trips = [])
    {
        foreach ($trips as $trip) {
            $this->push($trip);
        }
    }

    public function push(Trip $trip): void
    {
        $this->trips[] = $trip;
    }

    public function calculatePayableTime(): float
    {
        $time = array_reduce(
            $this->trips,
            static function (float $minutes, Trip $trip) {
                return $minutes + $trip->getDurationInMinutes();
            },
            0,
        );

        return round($time, 2);
    }

    public function each(callable $callback): void
    {
        foreach ($this->trips as $trip) {
            $callback($trip);
        }
    }

    /**
     * @return Trip[]
     */
    public function getTrips()
    {
        return $this->trips;
    }
}
