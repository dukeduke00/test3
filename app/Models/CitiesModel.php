<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class CitiesModel extends Model
{
    protected $table = 'cities';
    protected $fillable = [
        'city',
    ];

   public function forecasts()
   {
       return $this->hasMany(ForecastModel::class, 'city_id', 'id')->orderBy('forecasted_at');

   }

   public function weather()
   {
       return $this->hasMany(WeatherModel::class, 'city_id', 'id');
   }

   public function todaysForecast()
   {
       return $this->hasOne(ForecastModel::class, 'city_id', 'id')
           ->whereDate('forecasted_at', Carbon::now());
   }
}
