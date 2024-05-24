<?php

declare(strict_types=1);

namespace App\Drivers\Trips\Application\Create;

use App\Drivers\Trips\Application\CreatorInterface;
use App\Drivers\Trips\Domain\Trip;
use App\Drivers\Trips\Domain\Trips;
use App\Drivers\Trips\Infrastructure\Persistence\MySqlDriversTripRepository;

final readonly class TripCreator implements CreatorInterface
{
    public function __construct(private MySqlDriversTripRepository $repository)
    {
    }

    public function create(Trips $trips): void
    {
        $trips->each(fn (Trip $trip) => $this->repository->save($trip));
    }
}
