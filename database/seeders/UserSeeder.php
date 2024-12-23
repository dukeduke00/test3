<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

        public function run(): void
    {
        $amount= $this->command->ask('Koliko korisnika zelite da dodate?', 20);

        $password = $this->command->ask('Koju sifru zelite da postavite svim korisnicima?', '12345678');

        $faker = Faker::create('hr_HR');

        $this->command->getOutput()->progressStart($amount);

        for($i = 0; $i < $amount; $i++)
        {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make($password),
            ]);

            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();

        $this->command->info("Uspjesno ste dodali {$amount} korisnika sa unesenom šifrom.");

    }

}
