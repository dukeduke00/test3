<?php

namespace App\Http\Controllers;

use App\Models\CitiesModel;
use App\Models\ForecastModel;
use App\Models\WeatherModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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

        // php artisan weather:get-real $cityName
        Artisan::call('weather:get-real', ['city' => $cityName]);

        $cities = CitiesModel::with('todaysForecast')->where('city', 'like', "%$cityName%")->get();

        if($cities->isEmpty())
        {
            return redirect()->back()->with('error', 'Nismo pronasli nijedan grad!');
        }

        $userFavourites = [];

        if(Auth::check())
        {
            $userFavourites = Auth::user()->cityFavourites();

            $userFavourites = $userFavourites->pluck('city_id')->toArray(); // pluck vraca samo odredjeni podatak koji navedemo, i moze vratit max 2 podatka

        }

        return view('search_results', compact('cities', 'userFavourites'));
    }



}
