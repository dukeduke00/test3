<?php

namespace App\Http\Controllers;

use App\Models\CitiesModel;
use App\Models\ForecastModel;
use App\Models\WeatherModel;

class ForecastController extends Controller
{
    public function index()
    {
        $sedmicnaPrognoza = ForecastModel::all();

        return view('fiveDaysWeather', compact('sedmicnaPrognoza'));
    }

    public function allForecasts(CitiesModel $city)
    {



        return view('allForecasts', compact('city'));
    }




}
