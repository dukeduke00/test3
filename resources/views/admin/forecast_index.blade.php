<form method="POST" action="{{ route('forecasts.create') }}">
    @csrf
    <select name="city_id">
        @foreach(\App\Models\CitiesModel::all() as $city)
            <option value="{{ $city->id }}"> {{$city->city}} </option>
        @endforeach
    </select>

    <input type="number" name="temperature" placeholder="Unesite temperaturu">


    <select name="weather_type">
        @foreach(\App\Models\ForecastModel::WEATHER_TYPES as $weather)
            <option>{{ $weather }}</option>
       @endforeach
    </select>
    <input name="probability" type="number" min="1" max="100" placeholder="Unesite sansu za padavine">

    <input name="forecasted_at" type="date">

    <button>Snimi</button>
</form>

@foreach(\App\Models\CitiesModel::all() as $city)
    <h4>{{ $city->city }}</h4>
    <ul>
        @foreach($city->forecasts as $forecast)

            @php
                $boja;

                if($forecast->temperature <= 0)
                    {
                        $boja = 'lightblue';

                    }

                else if($forecast->temperature >= 1 && $forecast->temperature <= 15)
                    {
                        $boja = 'blue';
                    }

                else if($forecast->temperature > 15 && $forecast->temperature <= 25)
                    {
                        $boja = 'green';
                    }



                else
                    {
                        $boja = 'red';
                    }

            @endphp

            <li>Datum: {{ date('d.m.Y.', strtotime($forecast->forecasted_at)) }}   - <span style="color: {{ $boja }}">  Temperatura:{{ $forecast->temperature }}</span></li>
        @endforeach
    </ul>
@endforeach
