@foreach($prognoza as $weather)
    <p>Trenutno je {{ $weather->temperature }} u gradu {{ $weather->city->city }}</p>
@endforeach
