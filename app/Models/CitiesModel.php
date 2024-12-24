<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CitiesModel extends Model
{
    protected $table = 'cities';
    protected $fillable = [
        'city',
    ];

   public function forecasts()
   {
       return $this->hasMany(ForecastModel::class, 'city_id', 'id');

   }

   public function weather()
   {
       return $this->hasMany(WeatherModel::class, 'city_id', 'id');
   }
}
