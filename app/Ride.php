<?php namespace App;

use Eloquent;
use Carbon\Carbon;

class Ride extends Eloquent
{
    public $timestamps = false;

    public static function applyForTaxi($userId, $address, $leavingTime)
    {
        $ride = new static;
        $ride->userId = $userId;
        $ride->address = $address;
        $ride->leavingTime = $leavingTime;
        $ride->date = Carbon::now()->format('Y-m-d');
        $ride->save();

        return $ride;
    }

    public function getLeavingTimeAttribute($value)
    {
        $parts = explode(':', $value);
        unset($parts[2]);

        return join(':', $parts);
    }
}
