<?php

namespace App\Models;

use App\Models\BasicModel;

class Event extends BasicModel
{
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'influncer_id', 'coupon', 'content', 'started_at', 'expired_at', 'comment','valid', 'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'started_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'order_id', 'id');
    }
    
}
