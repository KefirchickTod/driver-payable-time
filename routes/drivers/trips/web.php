<?php

use App\Drivers\Trips\Http\Controllers\Reader\ReadFileController;
use Illuminate\Support\Facades\Route;
use App\Drivers\Trips\Http\Controllers\DriverPayableTimeController;

Route::get('/', [DriverPayableTimeController::class, 'index'])->name('drivers.trips.index');

Route::post('/', ReadFileController::class)->name('drivers.trips.save');
