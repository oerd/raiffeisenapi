<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "id_user";
    protected $table = "users";
    public $timestamps = true;
    protected $fillable = [
        'name', 'username', 'email', 'password', 'phone', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function agency()
    {
        return $this->hasOne('App\Agency', 'user_id');
    }

    public function offer()
    {
        return $this->hasMany('App\Offer', 'user_id');
    }
}
