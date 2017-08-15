<h1>Update {{ $user -> name }} account:</h1>

ID:
{{ $user -> id }}
<br>
Name:
{{ $user -> name }}
<br>
Email:
{{ $user -> email }}
<br>
Password:
{{ $user -> password }}
<br>
Created at:
{{ $user -> created_at }}
<br>
Updated at:
{{ $user -> updated_at }}
<br>
<br>
<br>
<br>
<br>


<form action="{{ route('updateFinal', $user->id) }}" method="get">

    Name:<br>
    <input type="text" name="name">
    <br>
    Email:<br>
    <input type="text" name="email">
    <br>
    Password:<br>
    <input type="text" name="password">
    <br>
    <input type="submit" value="Update">


</form>


<a href="{{ url('/home') }}"><h3>Back to home</h3></a>