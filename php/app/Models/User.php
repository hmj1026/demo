<?php

namespace App\Models;

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
        'email', 'password', 'comment', 'valid', 'status', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function detail()
    {
        return $this->hasOne('App\Models\UserDetail', 'user_id', 'id');
    }

    public function hopes()
    {
        return $this->hasMany('App\Models\UserHope', 'user_id', 'id');
    }

    public function equips()
    {
        return $this->hasMany('App\Models\UserEquipment', 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'user_id', 'id');
    }
}
