<?php

use App\Http\Controllers\ForecastController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/weather', [\App\Http\Controllers\WeatherController::class,'index']);

Route::post('/admin/weather/update', [\App\Http\Controllers\AdminWeatherController::class, 'update'])->name('weather.update');

Route::get('/admin/forecasts', [ForecastController::class, 'index']);

Route::post('admin/forecasts/update', [\App\Http\Controllers\AdminForecastsController::class, 'update'])->name('forecasts.update');

Route::get('/sedmicnaPrognoza', [\App\Http\Controllers\ForecastController::class,'index']);

Route::get('/forecast/{city:city}', [\App\Http\Controllers\ForecastController::class, 'allForecasts']);




