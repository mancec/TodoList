@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Tasks</h1>
        <div>
            {{ $task->title }} {{$task->due}}
        </div>

        <div>
            {{ $task->description }}
        </div>
    </div>

@endsection