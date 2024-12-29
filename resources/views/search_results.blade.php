@extends('layout')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
        <div class="text-center mt-3">
            <a class="btn btn-primary btn-lg" href="/login" style="border-radius: 5px; text-decoration: none;">
                <i class="fa-solid fa-right-to-bracket me-2"></i> Uloguj se
            </a>
        </div>
    @endif

    <div class="container mt-5">
        <div class="row">
            @foreach ($cities as $city)
                <div class="col-12 col-sm-6 col-md-3 mb-3">
                    <div class="d-flex align-items-center p-3" style="background-color: #d4edda; border-radius: 8px;">
                        @php
                            $icon = \App\Http\ForecastHelper::IconsByWeatherType($city->todaysForecast->weather_type)
                        @endphp
                        <i class="{{ $icon }} me-2"></i>
                        <p class="mb-0 flex-grow-1">
                            <a href="{{ route('forecast.permalink', ['city' => $city->city]) }}"
                               style="text-decoration: none; color: #155724;">
                                {{ $city->city }}
                            </a>
                        </p>
                        @if(in_array($city->id, $userFavourites))
                            <a href="{{ route('city.unfavourite', ['city' => $city->id])  }} "><i class="fa-solid fa-heart"></i></a>
                        @else
                            <a href="{{ route('city.favourite', ['city' => $city->id]) }}"><i class="fa-regular fa-heart ms-auto"></i></a>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection
