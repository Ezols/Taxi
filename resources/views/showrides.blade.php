@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Rides

                    <form action="{{ route('showRides') }}" class="form-inline pull-right" style="margin-top: -3px; margin-right: -10px;">
                    @include('partials.inputs.select', [
                        'name' => 'date',
                        'value' => $selectedDate,
                        'label' => 'Date',
                        'isSmall' => true,
                        'inline' => true,
                        'options' => $options,
                        'class' => 'submitOnChange'
                    ])
                    </form>
                </div>

                <form class="panel-body" action="{{ route('assignCarsStore') }}" method="post">
                    {{ csrf_field() }}
                    <table class="table">
                        <tr>
                            <th>User</th>
                            <th>Address</th>
                            <th>LeavingTime</th>
                            <th>Car</th>
                            <th>Invocie</th>
                        </tr>
                        @foreach($rides as $ride)
                            <tr>
                                <td>{{ $ride->userId }}</td>
                                <td>{{ $ride->address }}</td>
                                <td>{{ $ride->leavingTime }}</td>
                                <td class="sauraisLauks">
                                    <input type="hidden" name="ride[{{ $ride->id }}][rideId]" value="{{ $ride->id }}">
                                    @include('partials.inputs.text', [
                                        'name' => "ride[{$ride->id}][car]",
                                        'value' => $ride->car,
                                        'isSmall' => true,
                                        'hideLabel' => true,
                                        'errorKey' => "ride.{$ride->id}.car",
                                        'hideErrorMessage' => true,
                                        'class' => 'carIndex',
                                    ])
                                </td>
                                <td class="sauraisLauks">
                                    @include('partials.inputs.text', [
                                        'name' => "ride[$ride->id][invoice]",
                                        'value' => $ride->invoice,
                                        'isSmall' => true,
                                        'hideLabel' => true,
                                        'class' => 'invoiceNumber',
                                        'errorKey' => "ride.{$loop->index}.invoice",
                                        'hideErrorMessage' => true,
                                    ])
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="col-md-12">
                        <input class="btn btn-primary pull-right" type="submit" name="submit" value="Save data changes">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection