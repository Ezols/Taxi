@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your application for today at <strong>{{ $ride->leavingTime }}</strong></div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-2 text-right">
                            Address
                        </div>
                        <div class="col-sm-9">
                            <strong>{{ $ride->address }}</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 text-right">
                            Car
                        </div>
                        <div class="col-sm-9">
                            <strong>{{ $ride->car ?: 'Not assigned yet' }}</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 text-right">
                            Invoice
                        </div>
                        <div class="col-sm-9">
                            <strong>{{ $ride->invoice ?: 'Not assigned yet' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
