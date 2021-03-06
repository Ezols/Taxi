<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ride;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manageRides')) {
            return redirect()->route('showRides');
        }

        $ride = Ride::current()->first();

        if($ride) {
            return redirect()->route('showApplication');
        }

        return redirect()->route('applyForTaxi');
    }
}
