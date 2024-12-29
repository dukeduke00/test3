@extends('layout')

@section('content')

    @foreach($cities as $city)

        <p><a href="{{ route('forecast.permalink', ['city' => $city->city]) }}">{{$city->city}}</a></p>
    @endforeach

@endsection
