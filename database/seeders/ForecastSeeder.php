<?php

namespace Database\Seeders;

use App\Models\CitiesModel;
use App\Models\ForecastModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;


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

                // Dodaj prognozu u tabelu koristeći Eloquent model
                ForecastModel::create([
                    'city_id' => $city->id,
                    'temperature' => $faker->numberBetween(-10, 15), // Nasumična temperatura
                    'forecasted_at' => $randomDate,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
