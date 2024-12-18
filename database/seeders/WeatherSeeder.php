<?php

namespace Database\Seeders;

use App\Models\WeatherModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grad = $this->command->getOutput()->ask("Unesite ime grada");
        if($grad === null)
        {
            $this->command->getOutput()->error("Niste unijeli ime grada");
            return;
        }

        $postojeciGrad = WeatherModel::where('town_name', $grad)->first();
        if($postojeciGrad){
            $this->command->getOutput()->error("Ovaj grad vec postoji u bazi");
            continue;
        }

        $temperatura = $this->command->getOutput()->ask("Unesite temperaturu");
        if($temperatura === null)
        {
            $this->command->getOutput()->error("Niste unijeli temperaturu");
            return;
        }

        WeatherModel::create([
            'town_name' => $grad,
            'temperature' => $temperatura,
        ]);

        $this->command->info("Uspjesno ste dodali grad i temperaturu.");
    }
}
