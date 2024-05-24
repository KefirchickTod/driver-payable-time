<?php

declare(strict_types=1);

namespace App\Drivers\Trips\Http\Controllers\Reader;

use App\Drivers\Trips\Http\Requests\StoreTripsRequest;
use Illuminate\Http\RedirectResponse;

use App\Drivers\Trips\Application\Create\TripCreator;
use App\Drivers\Trips\Application\Read\CsvDataReader;

final readonly class ReadFileController
{
    public function __construct(
        private CsvDataReader $reader,
        private TripCreator $creator
    ) {
    }

    public function __invoke(StoreTripsRequest $request): RedirectResponse
    {
        $this->creator->create($this->reader->read($request->file('file')));

        return redirect()->route('drivers.trips.index');
    }
}
