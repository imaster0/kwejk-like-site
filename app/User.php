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

	//Role, funkcje, które mogą pełnić użytkownicy
	public function hasRole(){
    $theroles = [
      'user', 'admin',
    ];

		return $theroles[$this->role];
	}

  //ulubione
  public function ulubione(){
    return $this->belongsToMany('App\Post', 'ulubiones', 'user_id', 'post_id');
  }
}
