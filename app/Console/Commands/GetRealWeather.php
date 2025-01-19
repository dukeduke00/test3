<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetRealWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:get-real';

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
        $url = 'http://api.weatherapi.com/v1/current.json';

        $key = 'aaadf4aa2dab48759cd190328251601';

        $location = 'Belgrade';

        $response = Http::get($url, [
            'key' => $key,
            'q' => $location,
        ]);


        dd($response->json());
    }
}

