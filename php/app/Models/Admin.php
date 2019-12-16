<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;

class Admin extends Authenticatable
{
    use Notifiable;

    const ROLE_ADMIN_NOVICE = 1;
    const ROLE_ADMIN_ADVANCED = 2;
    const ROLE_ADMIN_SENIOR = 3;
    const ROLE_ADMIN_ROOT = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account', 'password', 'role_id', 'valid', 'status',
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
        // 'is_super_admin' => boolean,
        // 'email_verified_at' => 'datetime',
    ];

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->where(['valid' => 1, 'status' => 1]);
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    }
    
}
