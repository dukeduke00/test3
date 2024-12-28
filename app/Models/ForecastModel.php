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
        'weather_type',
        'probability',
    ];

    const WEATHER_TYPES = ['rainy', 'snowy', 'sunny', 'cloudy'];

    public function town()
    {
        return $this->hasOne( 'App\Models\CitiesModel', 'id', 'city_id' );
    }
}
