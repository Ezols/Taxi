<?php namespace App;

use Eloquent;
use Carbon\Carbon;
use Auth;

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

    public function scopeCurrent($query)
    {
        $query->where('userId', Auth::id());
        $this->scopeCurrentDate($query);
    }

    public function scopeCurrentDate($query)
    {
        if(isToday()) {
            $query->where('date', Carbon::now()->format('Y-m-d'));
        } else {
            $query->where('date', Carbon::now()->subDay()->format('Y-m-d'));
        }
    }

    public function scopeMatchingDate($query, $date)
    {
        $query->where('date', $date);
    }

    public function scopeMatchingCar($query)
    {
        $query->where('car', $this->car);
    }

    public function scopeNotMe($query)
    {
        $query->where('id', '!=', $this->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId')->withTrashed();
    }

    public function getPassengerAttribute()
    {
        if(!$this->car)
        {
            return null;
        }
        $passangers = static::matchingCar()
            ->notMe()
            ->matchingDate($this->date)
            ->get()
            ->map(function($ride) {
                return $ride->user->fullName;
            });

        return join(", ", $passangers->toArray());
    }
}
