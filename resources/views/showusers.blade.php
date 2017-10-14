@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                     <table class="table">

                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Action</th>
                            <th>Edit</th>
                        </tr>


                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role }}</td>
                            <td><a href="{{ url('/deleteuser', $user->id) }}">Delete</a></td>
                            <td><a href="{{ url('/updateuser', $user->id) }}">Edit</a></td>
                        </tr>
                        @endforeach
                
                     </table>                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
