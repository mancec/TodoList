@extends('layouts.app')

@section('content')


    <div class="panel-body">

        <form  id="createEmail" method="POST" action="/weather/email">
            @csrf
            @method('PUT')

                <div class="col-sm-6" style="width: 20%">
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>


            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add email
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- TODO: Current tasks -->
@endsection