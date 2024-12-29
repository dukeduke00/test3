@extends('layout')

@section('content')

    <div class="container mt-5">
        <div class="row">
            @foreach ($cities as $city)

                <div class="col-12 col-sm-6 col-md-3 mb-3">
                    <div class="d-flex align-items-center p-3" style="background-color: #d4edda; border-radius: 8px;">

                        @php
                            $icon = \App\Http\ForecastHelper::IconsByWeatherType($city->todaysForecast->weather_type)
                        @endphp

                        <i class="{{ $icon }} me-2"></i>
                        <p class="mb-0">
                            <a href="{{ route('forecast.permalink', ['city' => $city->city]) }}"
                               style="text-decoration: none; color: #155724;">
                                {{ $city->city }}
                            </a>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



@endsection
