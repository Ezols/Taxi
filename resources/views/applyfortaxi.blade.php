@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Apply for taxi</div>

                <div class="panel-body">
                    <form action="{{ route('applyForTaxiStore') }}" method="POST">
                        {{ csrf_field() }}

                        @include('partials.inputs.text', ['name' => 'address', 'label' => 'Address'])
                        @include('partials.inputs.select', ['name' => 'leavingTime', 'label' => 'Leaving time', 'options' => $options])

                        <input type="submit" value="Submit" class="btn btn-default">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

