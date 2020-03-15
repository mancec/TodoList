@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Tasks</h1>
        @foreach($tasks as $task)
            <div>
                <form  id="deleteUserForm" method="POST" action="/tasks/{{ $task->id }}">
                    @csrf
                    @method('DELETE')
                    <a  style="color: black; font-size: 20px"  href="/tasks/{{ $task->id }}"> {{ $task->title }} {{$task->due}} </a>
                    <a href="/tasks/edit/{{ $task->id }}">Edit</a>
                    <button style="font-size: 14px; padding: 0px; border: none; background-color: white; color: #007bff; font-size: 16px"  type="submit" onclick="return confirm('Are you sure?')" >Delete</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection