@foreach($city->weather as $danasnjaPrognoza)
    <p>Danasnja temperatura: {{ $danasnjaPrognoza->temperature }} °C</p>
@endforeach

<br>
<br>

@foreach($city->forecasts as $prognoza)

    <p> Datum: {{ date('d.m.Y.', strtotime($prognoza->forecasted_at)) }} - Temperatura: {{ $prognoza->temperature }} °C</p>
@endforeach


