<?php namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Ride;
use Auth;

class TaxiController
{
    use ValidatesRequests;

    const OPTIONS = ['23:00' => '23:00', '00:00' => '00:00', '02:00' => '02:00'];

    public function applyForTaxi()
    {
        $ride = Ride::where('userId', Auth::id())->first();

        if($ride) {
            return redirect()->route('showApplication');
        }

        $options = static::OPTIONS;
        return view('applyfortaxi', compact('options'));
    }

    public function applyForTaxiStore()
    {
        $ride = Ride::where('userId', Auth::id())->first();

        if($ride) {
            return redirect()->route('showApplication');
        }

        // Validation rule preperation
        $levingTimeIn = join(',', static::OPTIONS);

        // Validation
        $this->validate(request(), [
            'address' => 'required',
            'leavingTime' => "required|in:{$levingTimeIn}",
        ]);

        // Storing data
        Ride::applyForTaxi(Auth::id(), request()->address, request()->leavingTime);

        return redirect()->route('showApplication');
    }

    public function showApplication()
    {
        $ride = Ride::where('userId', Auth::id())->first();

        if(! $ride) {
            return redirect()->route('applyForTaxi');
        }



        return view('showApplication', compact('ride'));
    }

    public function showRides()
    {
        $rides = DB::table('rides')->get();
        $data['rides'] = $rides;

        return view('showrides', $data);
    }

    public function showUsers()
    {
        $users = DB::table('users')->get();

        $data['users'] = $users;

        return view('showusers', $data);
    }

    public function updateUser($id)
    {
        $user = DB::table('users')
            ->where('id', $id)
            ->first() ?: abort(404);

        $data['user'] = $user;

        return view('updateuser', $data);
    }

    public function updateFinal($id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update(['name' => request()->name, 'email' => request()->email, 'password' => request()->password]);

        return Redirect::back();
    }

    public function deleteUser($id)
    {
        DB::table('users')
            ->where('id', $id)
            ->delete();

        return Redirect::back();
    }
}
