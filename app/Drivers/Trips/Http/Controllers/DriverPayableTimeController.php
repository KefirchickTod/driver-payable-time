<?php

declare(strict_types=1);

namespace App\Drivers\Trips\Http\Controllers;

use App\Drivers\Trips\Infrastructure\Persistence\MySqlDriversTripRepository;
use Illuminate\View\View;

final readonly class DriverPayableTimeController
{
    public function __construct(
        private MySqlDriversTripRepository $repository,
    ) {
    }

    public function index(): View
    {
        $groups = $this->repository->all();

        return view('drivers.trips.index', ['groups' => $groups]);
    }
}
