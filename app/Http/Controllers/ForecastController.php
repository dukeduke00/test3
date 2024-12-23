<?php

namespace App\Http\Controllers;

class ForecastController extends Controller
{
    public function index($city)
    {
        $forecasts = [
            "doboj" => [7, 11, 5, 0, -1],
            "sarajevo" => [5, 6, 0, -1, -3],
        ];

        $city = strtolower($city);

       if(!array_key_exists($city, $forecasts))
       {
            die("Ovaj grad ne postoji");
       }

       dd($forecasts[$city]);

    }


}
