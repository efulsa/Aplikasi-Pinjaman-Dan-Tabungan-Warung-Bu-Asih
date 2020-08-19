<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public function borrow(){
        return $this->hasMany('App\Borrow','user_id','id');
    }

    public function borrowSaldo(){
        return $this->hasMany('App\Borrow','user_id','id')->orderBy('created_at','desc');
    }
    
    public function loan(){
        return $this->hasMany('App\Saving','user_id','id');
    }

    public function loanSaldo(){
        return $this->hasMany('App\Saving','user_id','id')->orderBy('created_at','desc');
    }

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
