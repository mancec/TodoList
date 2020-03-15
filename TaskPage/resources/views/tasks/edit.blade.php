@extends('layouts.app')

@section('content')

    <div class="container">
        <form  id="editTask" method="POST" action="/tasks/{{ $task->id }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <h2 for="task" class="col-sm-3 control-label">Update task</h2>

                <div class="col-sm-6">
                    <label>Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{$task->title}}">
                </div>

                <div class="col-sm-6">
                    <label>Description</label>
                    <input type="text" name="description" id="description" class="form-control" value="{{$task->description}}">
                </div>

                <div class="col-sm-6">
                    <label>Due data</label>
                    <input type="datetime-local" name="due" id="due" class="form-control" value="{{$task->date}}">
                </div>
            </div>

            <button  type="submit" >Update</button>
        </form>
    </div>

@endsection