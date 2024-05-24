<?php

declare(strict_types=1);

namespace App\Drivers\Trips\Domain;

use Carbon\Carbon;
use DateTimeInterface;

final class Trip
{
    private const DATE_FORMAT = 'Y-m-d H:i:s';

    public function __construct(
        private readonly int $id,
        private readonly int $driverId,
        private readonly DateTimeInterface $pickup,
        private readonly DateTimeInterface $dropoff
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDriverId(): int
    {
        return $this->driverId;
    }

    public function getPickup(): DateTimeInterface
    {
        return $this->pickup;
    }

    public function getDropoff(): DateTimeInterface
    {
        return $this->dropoff;
    }

    public function value(): array
    {
        return [
            'driver_id' => $this->getDriverId(),
            'pickup' => $this->getPickup()->format(self::DATE_FORMAT),
            'dropoff' => $this->getDropoff()->format(self::DATE_FORMAT)
        ];
    }

    public function getDurationInMinutes(): float
    {
        return Carbon::parse($this->pickup->getTimestamp())->diffInMinutes($this->dropoff);
    }

    public static function createFromArray(array $data): Trip
    {
        return new Trip(
            (int)$data['id'],
            (int)$data['driver_id'],
            Carbon::parse($data['pickup']),
            Carbon::parse($data['dropoff'])
        );
    }
}
