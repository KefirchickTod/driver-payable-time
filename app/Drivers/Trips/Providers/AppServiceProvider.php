<?php

declare(strict_types=1);

namespace App\Drivers\Trips\Providers;

use App\Drivers\Trips\Application\Create\TripCreator;
use App\Drivers\Trips\Application\CreatorInterface;
use App\Drivers\Trips\Application\Read\CsvDataReader;
use App\Drivers\Trips\Application\ReaderInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ReaderInterface::class, CsvDataReader::class);
        $this->app->bind(CreatorInterface::class, TripCreator::class);
    }
}
