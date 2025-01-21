<?php

namespace App\Console\Commands;

use App\Models\CitiesModel;
use App\Models\ForecastModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use function PHPUnit\Framework\isEmpty;

class GetRealWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:get-real {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to synchronize real life weather with our application using the Open API.';

    /**
     * Execute the console command.
     */
    public function handle()
    {




        $city = $this->argument("city");


        // php artisan weather:get-real Belgrade -> SELECT * FROM cities WHERE  name = 'Belgrade'

        // IZvadi iz Cities grad koji ima ime  = Belgrade
        $dbCity = CitiesModel::where(['city' => $city])->first();


        // Ako grad postoji
        if($dbCity === null)
        {
            // Napravi novi grad i vrati nam podatke iz baze
            $dbCity = CitiesModel::create(['city' => $city]);
        }




        $response = Http::get(env('WEATHER_API_URL').'v1/forecast.json', [
            'key' => env("WEATHER_API_KEY"),
             'q' => $city,
            'aqi' => "no"

    ]);


        $jsonResponse = $response->json();

        if(isset($jsonResponse['error']))
        {
            $this->output->error($jsonResponse['error']['message']);
            return;
        }



         if($dbCity->todaysForecast !== null)
         {
             $this->output->comment('Command finished');
             return;
         }


             $forecastDate = $jsonResponse['forecast']['forecastday'][0]['date'];
             $temperature = $jsonResponse['forecast']['forecastday'][0]['day']['avgtemp_c'];
             $weatherType = $jsonResponse['forecast']['forecastday'][0]['day']['condition']['text'];
             $probability = $jsonResponse['forecast']['forecastday'][0]['day']['daily_chance_of_rain'];




             $forecast = [
                 'city_id' => $dbCity->id,
                 'temperature' =>  $temperature,
                 'forecasted_at' => $forecastDate,
                 'weather_type' => strtolower($weatherType),
                 'probability' => $probability,

             ];


             ForecastModel::create($forecast);
             $this->output->comment("Added new forecast!");


    }
}

