<?php

declare(strict_types=1);

namespace App\Drivers\Trips\Application;

use App\Drivers\Trips\Domain\Trips;

interface CreatorInterface
{
    public function create(Trips $trips): void;
}
