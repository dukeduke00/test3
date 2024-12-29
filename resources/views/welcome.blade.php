@extends('layout')

@section('content')



    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <div class="container mt-4">
        <!-- Search Bar -->
        <form method="GET" action="{{ route('forecast.search') }}" class="mb-5">
            <div class="input-group">
                <input
                    class="form-control form-control-lg"
                    type="text"
                    name="city"
                    placeholder="Unesite ime grada"
                    aria-label="Unesite ime grada"
                >
                <button class="btn btn-primary btn-lg" type="submit">Pronađi</button>
            </div>
        </form>

        <!-- User Favourites -->
        <div class="row g-4">
            @foreach($userFavourites as $userFavourite)
                @php
                    $icon = \App\Http\ForecastHelper::IconsByWeatherType($userFavourite->city->todaysForecast->weather_type);
                @endphp
                <div class="col-md-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <!-- Left Side: Weather Icon -->
                            <i class="{{ $icon }}" style="font-size: 2rem;"></i>
                            <!-- Center: City and Temperature -->
                            <div class="text-center">
                                <p class="mb-1 fw-bold">{{ $userFavourite->city->city }}</p>
                                <p class="mb-0 text-muted">{{ $userFavourite->city->todaysForecast->temperature }} °C</p>
                            </div>
                            <!-- Right Side: Remove Icon -->
                            <a
                                href="{{ route('city.unfavourite', ['city' => $userFavourite->city]) }}"
                                class="text-danger"
                            >
                                <i class="fa-solid fa-xmark" style="font-size: 1.5rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
