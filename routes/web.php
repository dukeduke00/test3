<?php

use App\Http\Controllers\AdminForecastsController;
use App\Http\Controllers\AdminWeatherController;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\WeatherController;
use App\Http\Middleware\AdminCheckMiddleware;
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

Route::view('/', 'welcome');



Route::prefix('/admin')->middleware(AdminCheckMiddleware::class)->group(function () {

    Route::get('/weather', [WeatherController::class,'index']);

    Route::post('/weather/update', [AdminWeatherController::class, 'update'])->name('weather.update');

    Route::view('/forecasts', 'admin.forecast_index');

    Route::post('/forecasts/create', [AdminForecastsController::class, 'create'])->name('forecasts.create');
});


Route::get('/sedmicnaPrognoza', [ForecastController::class,'index']);

Route::get('/forecast/search', [ForecastController::class, 'search'])->name('forecast.search');

Route::get('/forecast/{city:city}', [ForecastController::class, 'allForecasts'])->name('forecast.permalink');








