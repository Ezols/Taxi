<style>

</style>



@foreach($users as $user)
    <ul>
        <a href="{{ url('/updateuser', $user->id) }}"><li>{{ $user->name }}</li></a>
    </ul>
@endforeach

<a href="/home"><p>Back to home</p></a>