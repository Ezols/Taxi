@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Sorry, application for taxi will be open starting from {{ $start }} till {{ $end }}.
                    <br>Here's a Chuck joke
                </div>
                <div class="panel-body">
                    {{ $joke }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

