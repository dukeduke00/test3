<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCitiesModel extends Model
{
    protected $table = 'user_cities';
    protected $fillable = [
        'city_id',
        'user_id',

    ];

    public function city()
    {
        return $this->hasOne(CitiesModel::class, 'id', 'city_id');
    }
}
