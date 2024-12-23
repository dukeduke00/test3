<?php

namespace Database\Seeders;

use App\Models\CitiesModel;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $amount= $this->command->ask('Koliko gradova zelite da dodate?', 5);

        $faker = Faker::create();

        $this->command->getOutput()->progressStart($amount);

        foreach (range(1, $amount) as $index) {
            CitiesModel::insert([
                'city' => $faker->city,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();

        $this->command->info("Uspjesno ste dodali {$amount} gradova.");
    }
}
