<?php

namespace  App\Http;

class ForecastHelper
{

    const WEATHER_ICONS = [
        "rainy" => 'fa-solid fa-cloud-rain',
        "sunny" => 'fa-solid fa-sun',
        'snowy' => 'fa-regular fa-snowflake',
        'cloudy' => 'fa-solid fa-cloud',
    ];

    public static function IconsByWeatherType($weatherType)
    {
        $icon = self::WEATHER_ICONS[$weatherType];

        return $icon;
    }



    public static function getColorByTemperature($temperature)
    {

        if($temperature <= 0)
        {
            $boja = 'lightblue';

        }

        else if($temperature >= 1 && $temperature <= 15)
        {
            $boja = 'blue';
        }

        else if($temperature > 15 && $temperature <= 25)
        {
            $boja = 'green';
        }



        else
        {
            $boja = 'red';
        }

        return $boja;

    }


}
