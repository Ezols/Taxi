@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your application for today at <strong>{{ $ride->leavingTime }}</strong></div>

                <div class="panel-body">
                    @include('partials.dataRow', ['label' => 'Address', 'value' => $ride->address])
                    @include('partials.dataRow', ['label' => 'Car', 'value' => $ride->car])
                    @include('partials.dataRow', ['label' => 'Invoice', 'value' => $ride->invoice])
                    @include('partials.dataRow', ['label' => 'Driving with', 'value' => $ride->passenger])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
