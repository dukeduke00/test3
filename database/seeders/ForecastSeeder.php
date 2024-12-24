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

        // Interval datuma od 19. decembra do 23. decembra 2024.
        $startDate = Carbon::create(2024, 12, 19);
        $endDate = Carbon::create(2024, 12, 23);

        foreach ($cities as $city) {
            // Generiši 5 random temperatura za svaki grad
            foreach (range(1, 5) as $index) {
                // Random datum unutar intervala
                $randomDate = $faker->dateTimeBetween($startDate, $endDate);

                $weatherTypes = ForecastModel::WEATHER_TYPES[rand(0,2)];

                $probability = null;

                if($weatherTypes !== 'sunny')
                {
                    $probability = rand(1, 100);
                }

                // Dodaj prognozu u tabelu koristeći Eloquent model
                ForecastModel::create([
                    'city_id' => $city->id,
                    'temperature' => rand(-10, 15), // Nasumična temperatura
                    'weather_type' => $weatherTypes,
                    'probability' => $probability,
                    'forecasted_at' => $randomDate

                ]);
            }
        }
    }
}
