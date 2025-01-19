<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Models\UserCitiesModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminForecastsController;
use App\Http\Controllers\AdminWeatherController;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\WeatherController;



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

    $userFavourites = [];

    $user = Auth::user();
    if($user !== null)
    {
        $userFavourites = UserCitiesModel::where([
            'user_id' => $user->id
        ])->get();


    }


    return view('welcome', compact('userFavourites'));
} );

Route::get('/sedmicnaPrognoza', [ForecastController::class,'index']);

Route::get('/forecast/search', [ForecastController::class, 'search'])->name('forecast.search');

Route::get('/forecast/{city:city}', [ForecastController::class, 'allForecasts'])->name('forecast.permalink');



/*
 * User cities
 */

Route::get('/user-cities/favourite/{city}', [\App\Http\Controllers\UserCitiesController::class, 'favourite'])->name('city.favourite');

Route::get('/user-cities/unfavourite/{city}', [\App\Http\Controllers\UserCitiesController::class, 'unfavourite'])->name('city.unfavourite');

Route::prefix('/admin')->middleware(AdminCheckMiddleware::class)->group(function () {

    Route::get('/weather', [WeatherController::class,'index']);

    Route::post('/weather/update', [AdminWeatherController::class, 'update'])->name('weather.update');

    Route::view('/forecasts', 'admin.forecast_index');

    Route::post('/forecasts/create', [AdminForecastsController::class, 'create'])->name('forecasts.create');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
