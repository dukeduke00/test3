<?php

namespace App\Http\Controllers;

use App\Models\ForecastModel;
use App\Models\WeatherModel;
use Illuminate\Http\Request;

class AdminForecastsController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'temperature' => 'required',
            'weather_type' => 'required',
            'probability' => 'nullable|numeric|min:0|max:100',
            'forecasted_at' => 'required',



        ]);


        ForecastModel::create($request->all());

        return redirect()->back();
    }
}
