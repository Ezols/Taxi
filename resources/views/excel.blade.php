<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>

<table class="table">
    <tr>
    <th>Name</th>
    <th>Surname</th>
    <th>Address</th>
    <th>LeavingTime</th>
    <th>Date</th>
    <th>Car</th>
    <th>Invocie</th>
    </tr>

    @foreach($rides as $ride)
        <tr>
            <td>{{ $ride->user->name }}</td>
            <td>{{ $ride->user->surname }}</td>
            <td>{{ $ride->address }}</td>
            <td>{{ $ride->leavingTime }}</td>
            <td>{{ $ride->date }}</td>
            <td>{{ $ride->car}}</td>
            <td>{{ $ride->invoice }}</td>
        </tr>
    @endforeach
 </table>

</html>
