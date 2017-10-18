<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

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
            case 'changeRole':
            case 'manageRides':
                return $this->role === 'admin';
            case 'manageUsers':
                return $this->role === 'admin' || $this->id == $params;

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
