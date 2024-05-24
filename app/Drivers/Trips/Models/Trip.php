<?php

namespace App\Drivers\Trips\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'pickup',
        'dropoff'
    ];

    protected $table = 'trips';
}
