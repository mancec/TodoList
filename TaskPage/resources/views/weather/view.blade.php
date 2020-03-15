@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Current Weather</h1>
        <div>
            <label>Country name:</label>
            {{ $weather['name'] }}
        </div>

        <div>
            <label>Temperature:</label>
            {{ $weather['main']['temp'] }}
        </div>

        <div>
            <label>Wind direction:</label>
            {{ $direction }}
        </div>

        <div>
            <label>Wind speed:</label>
            {{ $weather['wind']['speed'] }}
        </div>
    </div>
@endsection