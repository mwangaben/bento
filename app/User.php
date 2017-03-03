<?php

namespace App;

use App\Customer;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function add($name)
    {
        return $this->customers()->save($name);
    }

    public function count()
    {
        return $this->customers()->count();
    }
}
