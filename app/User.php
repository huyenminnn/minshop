<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //1 nguoi quan ly nhieu chi nhanh
    public function branch(){
        return $this->hasMany('App\Branch','manager_id','id');
    }

    //1 nguoi them nhieu sp
    public function product(){
        return $this->hasMany('App\Product','user_id','id');
    }
}
