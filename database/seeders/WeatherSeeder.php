<?php

namespace Database\Seeders;

use App\Models\WeatherModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CitiesModel;
use Faker\Factory as Faker;
use Carbon\Carbon;


class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        //  Povuci sve gradove iz baze koristeći Eloquent
        $cities = CitiesModel::all();  // Eloquent metoda za dobijanje svih gradova


        foreach ($cities as $city) {
            // Generiši jednu nasumičnu temperaturu za svaki grad
            $randomTemperature = $faker->numberBetween(-10, 35); // Nasumična temperatura

            // Dodaj podatke u tabelu weather
            WeatherModel::create([
                'city_id' => $city->id,
                'temperature' => $randomTemperature,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
