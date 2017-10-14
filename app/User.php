<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function can($something, $params = [])
    {
        switch ($something) {
            case 'manageRides':
            case 'manageUsers':
                return $this->role === 'admin';

            default:
                throw new \Exception("What is {$something} action?");
                break;
        }
    }

    public function getFullNameAttribute()
    {
        return join(" ", [$this->name, $this->surname]);
    }
}
