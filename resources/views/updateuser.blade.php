@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User {{ $user->name }}</div>

                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                    </tr>

                    <tr>
                        <td>{{ $user -> id }}</a></td>
                        <td>{{ $user-> name }}</td>
                        <td>{{ $user -> email }}</td>
                        <td>{{ $user -> role }}</td>
                        <td>{{ $user -> created_at }}</td>
                        <td>{{ $user -> updated_at }}</td>
                    </tr>
                </table>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">User <strong>{{ $user->name }}</strong></div>

                <div class="panel-body">
                    <form action="{{ route('updateFinal', $user->id) }}" method="post">
                        {{ csrf_field() }}
                        @include('partials.inputs.text', ['name' => 'name', 'label' => 'Name', 'value' => $user->name])
                        @include('partials.inputs.text', ['name' => 'email', 'label' => 'Email', 'value' => $user->email])
                        @if(Auth::user() && Auth::user()->can('changeRole'))    
                            @include('partials.inputs.select', ['name' => 'role', 'label' => 'Role', 'value' => $user->role, 'options' => $roleOptions])
                        @endif
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Rides: {{ $userRides->count() }}</div>

                <table class="table">

                <tr>
                    <th>Address</th>
                    <th>Leaving time</th>
                    <th>Date</th>
                    <th>Car</th>
                    <th>Invoice</th>
                </tr>


                    @foreach ($userRides as $ride)
                    <tr>
                        <td>{{ $ride -> address }}</td>
                        <td>{{ $ride -> leavingTime }}</td>
                        <td>{{ $ride -> date }}</td>
                        <td>{{ $ride -> car }}</td>
                        <td>{{ $ride -> invoice }}</td>
                    </tr>
                    @endforeach


                </table>
            </div>
        </div>
    </div>
</div>
@endsection
