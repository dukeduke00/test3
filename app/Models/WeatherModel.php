<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherModel extends Model
{
    protected $table = 'weather';
    protected $fillable = [
        'city_id',
        'temperature',
    ];


}

// Relacije:

// OneToOne - Weather city_id -> CityModel

// OneToMany -> Weather city_id -> povezan sa vise CityModel

// ManyToOne

// ManyToMany



