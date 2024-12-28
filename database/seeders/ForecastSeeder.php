<?php

namespace Database\Seeders;

use App\Models\CitiesModel;
use App\Models\ForecastModel;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;


class ForecastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        $faker = Faker::create();

        // Povuci sve gradove iz baze koristeći Eloquent
        $cities = CitiesModel::all();  // Eloquent metoda za dobijanje svih gradova

        $dates =
        [
            Carbon::create(2024, 12, 26),
            Carbon::create(2024, 12, 27),
            Carbon::create(2024, 12, 28),
            Carbon::create(2024, 12, 29),
            Carbon::create(2024, 12, 30),

        ];

        foreach ($cities as $city) {
            // Generiši 5 random temperatura za svaki grad

            $previousTemperature = null; // Cuvanje temperature iz prethodnog dana


            foreach ($dates as $date) {

                $weatherTypes = ForecastModel::WEATHER_TYPES[rand(0,3)];

                if($previousTemperature === null) {

                    $temperature = match ($weatherTypes) {
                      'sunny' => rand(-15, 42),
                      'rainy' => rand(-5, 15),
                      'snowy' => rand(-15, 1),
                      'cloudy' => rand(-15, 15),
                    };

                }

                else
                {
                    $minTemperature = max($previousTemperature - 5, -15); // Minimalna temperatura (ne manje od -15)
                    $maxTemperature = min($previousTemperature + 5, 42);  // Maksimalna temperatura (ne više od 42)

                    $temperature = rand($minTemperature, $maxTemperature);
                }

                $probability = null;

                if($weatherTypes !== 'sunny')
                {
                    $probability = rand(1, 100);
                }

                // Dodaj prognozu u tabelu koristeći Eloquent model
                ForecastModel::create([
                    'city_id' => $city->id,
                    'temperature' => $temperature,
                    'weather_type' => $weatherTypes,
                    'probability' => $probability,
                    'forecasted_at' => $date,

                ]);

                $previousTemperature = $temperature; // Update prethodne temperature
            }
        }
    }
}
