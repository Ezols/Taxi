

<h1>Apply for taxi</h1>

<form action="/applyfortaxi" method="get">

    Name:<br>
    <input type="text" name="userId">
    <br>
    Address:<br>
    <input type="text" name="address">
    <br>
    Leaving time:<br>
    <select type="text" name="leavingTime">
        <option value="23:00">23:00</option>
        <option value="24:00">24:00</option>
    </select>
    <br>
    Invoice:<br>
    <input type="text" name="invoice">
    <br>
    <input type="submit" value="Submit">

</form>

<a href="{{ url('/home') }}"><h3>Back to home</h3></a>