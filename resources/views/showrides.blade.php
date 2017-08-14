

@foreach($rides as $ride)
    <ul>
        <li>{{ $ride->userId }}</li>
        <li>{{ $ride->address }}</li>
        <li>{{ $ride->leavingTime }}</li>
        <li>{{ $ride->invoice }}</li>
    </ul>

@endforeach


<a href="/home"><h3>Back to home</h3></a>

