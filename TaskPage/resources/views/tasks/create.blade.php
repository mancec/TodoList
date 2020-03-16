@extends('layouts.app')

@section('content')


    <div class="panel-body">

        <form action="/tasks" method="POST" class="form-horizontal">
        {{ csrf_field() }}

            <div class="form-group" style="width: 40%">
                <h2 for="task" class="col-sm-3 control-label">Create task</h2>

                <div class="col-sm-6">
                    <label>Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>

                <div class="col-sm-6">
                    <label>Description</label>
                    <input type="text" name="description" id="description" class="form-control">
                </div>

                <div class="col-sm-6">
                    <label>Due data</label>
                    <input type="datetime-local" name="due" id="due" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Task
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- TODO: Current tasks -->
@endsection