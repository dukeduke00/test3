@extends("admin.layout")

@section("content")
    <div class="container my-5">
        <!-- Forma za kreiranje novog forecasta -->
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('forecasts.create') }}" class="p-3 border rounded shadow-sm">
                    @csrf
                    <h2 class="mb-4">Kreiranje novog forecasta</h2>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="city_id" class="form-label">Izaberite grad</label>
                            <select name="city_id" id="city_id" class="form-control">
                                @foreach(\App\Models\CitiesModel::all() as $city)
                                    <option value="{{ $city->id }}">{{ $city->city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="weather_type" class="form-label">Tip vremena</label>
                            <select name="weather_type" id="weather_type" class="form-control">
                                @foreach(\App\Models\ForecastModel::WEATHER_TYPES as $weather)
                                    <option>{{ $weather }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="forecasted_at" class="form-label">Datum prognoze</label>
                            <input name="forecasted_at" type="date" id="forecasted_at" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="temperature" class="form-label">Temperatura</label>
                            <input type="number" name="temperature" id="temperature" placeholder="Unesite temperaturu" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="probability" class="form-label">Šansa za padavine (%)</label>
                            <input name="probability" type="number" min="1" max="100" id="probability" placeholder="Unesite šansu za padavine" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Snimi</button>
                </form>
            </div>
        </div>

        <!-- Prikaz gradova i prognoza -->
        <div class="row mt-5 row-cols-1 row-cols-md-5 g-4">
            @foreach(\App\Models\CitiesModel::all() as $city)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $city->city }}</h5>
                            <ul class="list-unstyled">
                                @foreach($city->forecasts as $forecast)
                                    @php
                                        $boja = \App\Http\ForecastHelper::getColorByTemperature($forecast->temperature);
                                        $icon = \App\Http\ForecastHelper::IconsByWeatherType($forecast->weather_type);
                                    @endphp
                                    <li class="mb-2">
                                        <strong>{{ date('d.m.Y.', strtotime($forecast->forecasted_at)) }}</strong>
                                        - <span style="color: {{ $boja }}; font-weight: bold;">
                                        {{ $forecast->temperature }}&deg;C
                                    </span>
                                    <i class="{{ $icon }}"></i>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <i class="fa-solid fa-raindrops"></i><i class="fa-solid fa-raindrops"></i><i class="fa-solid fa-sun"></i>

@endsection

