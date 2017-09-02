@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your application for today at <strong>{{ $ride->leavingTime }}</strong></div>

                <div class="panel-body">
                    <strong>Address</strong>
                    <p>{{ $ride->address }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
