<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForecastModel extends Model
{
    protected $table = 'forecasts';
    protected $fillable = [
        'city_id',
        'temperature',
        'forecasted_at',
    ];
}
