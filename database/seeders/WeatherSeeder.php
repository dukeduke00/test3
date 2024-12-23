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

            $userWeather = WeatherModel::where(['city_id' => $city->id])->first();
            if($userWeather !== null){
                $this->command->getOutput()->error("Ovaj grad vec postoji");
                continue;
            }


            // Dodaj podatke u tabelu weather
            WeatherModel::create([
                'city_id' => $city->id,
                'temperature' => rand(10, 19),
           ]);
        }
    }
}
