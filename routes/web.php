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

Route::view('/admin/forecasts', 'admin.forecast_index');

Route::post('admin/forecasts/create', [\App\Http\Controllers\AdminForecastsController::class, 'create'])->name('forecasts.create');

Route::get('/sedmicnaPrognoza', [\App\Http\Controllers\ForecastController::class,'index']);

Route::get('/forecast/{city:city}', [\App\Http\Controllers\ForecastController::class, 'allForecasts']);




