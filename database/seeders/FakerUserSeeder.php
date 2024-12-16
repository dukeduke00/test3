<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class FakerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = $this->command->getOutput()->ask('Koji je Vas email?');

        if($email === null)
        {
            $this->command->getOutput()->error("Niste unijeli email");
            return;
        }

        $password = $this->command->getOutput()->ask('Koju sifru zelite?');

        if($password === null)
        {
            $this->command->getOutput()->error("Niste unijeli sifru");
            return;
        }

        $username = $this->command->getOutput()->ask('Korisnicko ime?');
        if($username === null)
        {
            $this->command->getOutput()->error("Niste unijeli korisnicko ime");
            return;
        }

        $user = User::where(['email' => $email])->first();
        if($user instanceof User)
        {
            $this->command->getOutput()->error("Korisnik sa ovom email adresom vec postoji");
            return;
        }

        User::create([
            "email" => $email,
            "password" => Hash::make($password),
            "name" => $username,
        ]);
    }
}
