@php
    $groupedByTown = $sedmicnaPrognoza->groupBy('town.city');
@endphp

<form  method="POST" action="{{ route('forecasts.update') }}">

    @csrf



    <select name="city_id">
        @foreach($groupedByTown as $town => $forecasts)
            <option value="{{ $forecasts->first()->town->id }}">{{ $town }}</option>
        @endforeach
    </select>

    <input type="number" name="temperature" placeholder="Unesite temperaturu">

    <select name="weather_type">
        <option>rainy</option>
        <option>sunny</option>
        <option>snowy</option>
    </select>
    <input name="probability" type="number" min="1" max="100" placeholder="Unesite sansu za padavine">

    <input name="date" type="date">

    <button>Snimi</button>
</form>




@foreach($groupedByTown as $town => $forecasts)
    <h4>{{ $town }}</h4>
    <ul>
        @foreach($forecasts as $prognoza)
            <li>{{ date('d.m.Y.', strtotime($prognoza->forecasted_at)) }}    {{ $prognoza->temperature }}°C</li>
        @endforeach
    </ul>
@endforeach
