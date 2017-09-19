<?php namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Ride;
use Auth;
use Carbon\Carbon;

class TaxiController
{
    use ValidatesRequests;

    const OPTIONS = ['23:00' => '23:00', '00:00' => '00:00', '02:00' => '02:00'];
    const FROM = 17;
    const TO = 22;

    public function applyForTaxi()
    {  
        if( ! $this->canApply()) {
            $response = file_get_contents('http://api.icndb.com/jokes/random');
            $joke = json_decode($response, true)['value']['joke'];
            $data['joke'] = $joke;
            $data['start'] = $startHour = "17:00";
            $data['end'] = $endHour = "22:00";
            
            return view('jokes', $data);    
        }
        
        $ride = Ride::current()->first();

        if($ride) {
            return redirect()->route('showApplication');
        }
        $options = static::OPTIONS;
  
        return view('applyfortaxi', compact('options'));      
    }

   

    public function applyForTaxiStore()
    {
        if( ! $this->canApply()) {

        }
        $ride = Ride::current()->first();

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
        $ride = Ride::current()->first();

        if(! $ride) {
            return redirect()->route('applyForTaxi');
        }

        return view('showApplication', compact('ride'));
    }

    public function showRides()
    {
        
        $options = Ride::groupBy('date')->orderBy('date', 'desc')->select('date')->get()
            ->mapWithKeys(function($item, $key) {
                return [$item->date => $item->date];
            });

        if(!$options->first() || !isTodayDate($options->first())) {
            $today = Carbon::now()->format('Y-m-d');

            $options = [$today => $today] + $options->toArray();
        }

        $selectedDate = request()->date ?: head($options);
        $rides = Ride::orderBy('car', 'asc')->where('date', $selectedDate)->get();

        return view('showrides', compact('options', 'rides', 'selectedDate'));
    }

    public function assignCarsStore()
    {
        // Validation
        $this->validate(request(), [
            'ride.*.rideId' => 'required|exists:rides,id',
            'ride.*.car' => "nullable|integer",
            'ride.*.invoice' => "nullable",
        ]);

        foreach(request()->ride as $index => $ride) {
            Ride::where('id', $ride['rideId'])->update([
                'car' => $ride['car'],
                'invoice' => $ride['invoice'],
            ]);
        }

        return redirect()->back();
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

    public function canApply()
    {
        $currentHour = date("H");
        $startHour = static::FROM;
        $endHour = static::TO;

        return $startHour < $currentHour && $currentHour < $endHour;
    }
}
