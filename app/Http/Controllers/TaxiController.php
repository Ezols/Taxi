<?php namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Redirect;


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