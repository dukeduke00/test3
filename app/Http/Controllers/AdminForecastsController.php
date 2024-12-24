<?php

namespace App\Http\Controllers;

use App\Models\ForecastModel;
use App\Models\WeatherModel;
use Illuminate\Http\Request;

class AdminForecastsController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'temperature' => 'required',
            'weather_type' => 'required',
            'probability' => 'nullable|numeric|min:0|max:100',
            'date' => 'required',



        ]);

        $weather = new ForecastModel();
        $weather->city_id = $request->input('city_id');
        $weather->temperature = $request->input('temperature');
        $weather->weather_type = $request->input('weather_type');
        $weather->probability = $request->input('probability');
        $weather->forecasted_at = $request->input('date');
        $weather->save();

        return redirect()->back();
    }
}
