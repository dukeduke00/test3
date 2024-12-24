<form  method="POST" action="{{ route('weather.update') }}">

     @csrf

    <input type="number" name="temperature" placeholder="Unesite temperaturu">

    <select name="city_id">
        @foreach($prognoza as $weather)
        <option value="{{ $weather->city_id }}">{{ $weather->city->city }}</option>
        @endforeach
    </select>

    <button>Snimi</button>
</form>

@foreach($prognoza as $weather)
    <p>Trenutno je {{ $weather->temperature }} °C u gradu {{ $weather->city->city }}</p>
@endforeach
