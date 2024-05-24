<?php

declare(strict_types=1);

namespace App\Drivers\Trips\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    private const PREFIX = 'drivers/trips';
    private const PATH = 'routes/drivers/trips/web.php';

    protected $namespace = 'App\Drivers\Trips\Http\Controllers';

    public function map(): void
    {
        Route::prefix(self::PREFIX)
            ->namespace($this->namespace)
            ->group(base_path(self::PATH));
    }
}
