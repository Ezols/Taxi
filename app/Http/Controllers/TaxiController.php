<?php namespace App\Http\Controllers;
use DB;



class TaxiController
{
        public function applyForTaxi()
        {
            $data = request()->all();
            //dd($data);
            DB::table('rides')->insert($data);

            return view('applyfortaxi', $data);
        }

        public function showRides()
        {
            dd(1);
        }
}