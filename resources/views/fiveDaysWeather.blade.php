@foreach($sedmicnaPrognoza as $prognoza)
    <p>Prognoza za grad {{ $prognoza->town->city }}, dana {{ date('d.m.Y.', strtotime($prognoza->forecasted_at)) }} je {{ $prognoza->temperature }} stepeni.</p>
@endforeach

