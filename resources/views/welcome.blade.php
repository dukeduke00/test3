@extends('layout')

@section('content')

    <form method="GET" action="{{ route('forecast.search') }}" style="margin-top:350px"  class="d-flex justify-content-center align-items-center">

        <div class="d-flex flex-column gap-3">
            <input class="input-group-text" type="text" name="city" placeholder="Unesite ime grada">
            <button class="btn btn-primary" type="submit">Pronadji</button>
        </div>
    </form>
@endsection
