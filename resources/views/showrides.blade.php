@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Rides {{ $selectedDate }}

                    <form action="{{ route('showRides') }}" class="form-inline pull-right noprint" style="margin-top: -3px; margin-right: -10px;">
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
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Address</th>
                            <th>LeavingTime</th>
                            <th>Car</th>
                            <th>Invocie</th>
                            <th>Action</th>
                        </tr>

              
                        @foreach($rides as $ride)
                            <tr>
                                <td>{{ $ride->user->name }}</td>
                                <td>{{ $ride->user->surname }}</td>
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
                                <td> 
                                    <a class="btn btn-danger" class="" role="group" href="{{ route('deleteRide', $ride -> id) }}"
                                    onclick="
                                        event.preventDefault();
                                        var form = document.getElementById('delete-form');
                                        var href = this.getAttribute('href');
                                        form.action = href;
                                        form.submit();
                                        ">

                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                    Delete
                                    </a>                        
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="col-md-12 noprint">
                        <input class="btn btn-primary pull-right" type="submit" name="submit" value="Save data changes">
                    </div>

                </form>
                <form id="delete-form" action="" method="POST" style="display: none;">
                        {{ csrf_field() }}
                </form>                
                
                <form class="panel-body" action="{{ route('exportRide') }}" method="get">

                    <div class="col-md-12 noprint">
                        <label for="startDate">Chose date from:</label>       
                        <input class ="form-control" type="date" id="startDate" name="startDate">
                        <label for="endDate">Chose date till:</label>       
                        <input class="form-control" type="date" id="endDate" name="endDate">   
                        <input style="margin-top: 15px" class="btn btn-primary pull-right" type="submit" name="submit" value="Export">  
                    </div>
                </form>                            
            </div>
        </div>
    </div>
</div>
@endsection
