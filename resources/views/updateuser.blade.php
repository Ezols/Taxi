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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                        </tr>
                        
                        <tr>
                            <td>{{ $user -> id }}</a></td>
                            <td>{{ $user-> name }}</td>
                            <td>{{ $user -> email }}</td>
                            <td>{{ $user -> created_at }}</td>
                            <td>{{ $user -> updated_at }}</td>
                        </tr>
                        
                        
                        <form action="{{ route('updateFinal', $user->id) }}" method="get">

                            Name:<br>
                            <input type="text" name="name">
                            <br>
                            Email:<br>
                            <input type="text" name="email">
                            <br>
                            <input type="submit" value="Update">


                        </form>
                
                     </table>                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
