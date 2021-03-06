<?php namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Ride;
use App\User;
use Auth;
use Carbon\Carbon;
use Excel;

class TaxiController
{
    use ValidatesRequests;

    const OPTIONS = ['23:00' => '23:00', '00:00' => '00:00', '02:00' => '02:00'];
    const ROLE_OPTIONS = ['user' => 'User', 'admin' => 'Admin'];
    const FROM = 17;
    const TO = 20;

    public function applyForTaxi()
    {
        //dd($this->canApply());       
        if( ! $this->canApply()) {
            $response = file_get_contents('http://api.icndb.com/jokes/random');
            $joke = json_decode($response, true)['value']['joke'];
            $data['joke'] = $joke;
            $data['start'] = $startHour = static::FROM . ":00";
            $data['end'] = $endHour = static::TO . ":00";

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
            return redirect()->route('showApplication');
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

            $options->prepend($today, $today);
        }

        $selectedDate = request()->date ?: $options->first();
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

        $rides = (array) request()->ride;

        foreach($rides as $index => $ride)
            {
            Ride::where('id', $ride['rideId'])->update([
                'car' => $ride['car'],
                'invoice' => $ride['invoice'],
            ]);
        }

        return redirect()->back();
    }

    // public function showUserRides($id)
    // {
    //     $userRides = DB::table('rides')
    //         -where('id', $id)
    //         ->get();

    //     $data['userRides'] = $userRides;

    //     return view('updateuser', $data);
    // }

    public function showUsers()
    {
        if(!Auth::user() || !Auth::user()->can('manageUsers')) {
            return redirect()->route('showApplication');
        }

        $users = User::all();

        $data['users'] = $users;

        return view('showusers', $data);
    }

    public function userForm($id)
    {
        if(!Auth::user() || !Auth::user()->can('manageUsers', $id)) {
            return redirect()->route('showApplication');
        }

        $user = DB::table('users')
            ->where('id', $id)
            ->first() ?: abort(404);

        $data['user'] = $user;

        $userRides = DB::table('rides')
            ->where('userId', $id)
            ->get();

        $data['roleOptions'] = static::ROLE_OPTIONS;
        $data['userRides'] = $userRides;

        return view('updateuser', $data);
    }

    public function userUpdate($id)
    {
        if(!Auth::user() || !Auth::user()->can('manageUsers', $id)) {
            return redirect()->route('showApplication');
        }

        $rules = [
            'name' => 'required',
            'surname' => 'required',
            'email' => "required|email",
        ];

        if(Auth::user() && Auth::user()->can('changeRole'))
        {
            $roles = join(',', array_keys(static::ROLE_OPTIONS));
            $rules['role'] = 'required|in:' . $roles;
        }

        $this->validate(request(), $rules);

        DB::table('users')
            ->where('id', $id)
            ->update(request()->only(array_keys($rules)));

        return Redirect::back();
    }

    public function deleteUser($id)
    {
        if(!Auth::user() || !Auth::user()->can('manageUsers')) {
            return redirect()->route('showApplication');
        }

        User::findOrFail($id)->delete();

        return Redirect::back();
    }

    public function deleteRide($id)
    {
        if(!Auth::user() || !Auth::user()->can('manageUsers'))
        {
            return redirect()->route('showRides');
        }       

        DB::table('rides')
            ->where('id', $id)
            ->delete();            

        return Redirect::back();
    }

    public function canApply()
    {
        // if(Auth::user()->role == 'admin')
        // {
        //     return true;
        // }

        if(Auth::user()->can('applyAtAnyTime'))
        {
            return true;
        }

        $currentHour = date("H");
        $startHour = static::FROM;
        $endHour = static::TO;

        return $startHour <= $currentHour && $currentHour < $endHour;
    }

    public function exportRide()
    {


        $this->validate(request(), [
            "startDate" => "nullable|date",
            "endDate" => "nullable|date",
        ]);

        $file = Excel::create('Export', function($excel) 
        {
            $excel->sheet('Rides', function($sheet)
            {
                $from = request()->startDate;
                $to = request()->endDate;
                $querry = Ride::with('user');

                if($from)
                {
                    $querry->where("date", ">=", $from);
                }
                if($to)
                {
                    $querry->where("date", "<=", $to);
                }

                $data['rides'] = $querry->get();
                $sheet->loadView('excel', $data);        
            });
        
        })->export('xls');
    }
}
