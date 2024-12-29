<?php

namespace App\Http\Controllers;

use App\Models\CitiesModel;
use App\Models\ForecastModel;
use App\Models\WeatherModel;
use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function index()
    {
        $sedmicnaPrognoza = ForecastModel::all();

        return view('forecasts', compact('sedmicnaPrognoza'));

    }

    public function allForecasts(CitiesModel $city)
    {

        return view('allForecasts', compact('city'));
    }

    public function search(Request $request)
    {
        $cityName = $request->get('city');

        $cities = CitiesModel::where('city', 'like', "%$cityName%")->get();

        return view('search_results', compact('cities'));
    }



}
