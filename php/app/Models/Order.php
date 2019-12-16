<?php

namespace App\Models;

use App\Models\BasicModel;

class Order extends BasicModel
{
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'cashflow_id',
        'is_applied', 'is_charged', 'is_shipped', 'is_user_detail_used', 'is_billing_address_used',
        'origin_amount', 'retail_amount',
        'event_id', 'event_content_backup', 'comment','valid', 'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_applied' => 'boolean',
        'is_billing_address_used' => 'boolean',
        'is_charged' => 'boolean',
        'is_shipped' => 'boolean',
        'is_user_detail_used' => 'boolean',
        'status' => 'boolean',
    ];

    public function detail()
    {
        return $this->hasOne('App\Models\OrderShippingDetail', 'order_id', 'id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\OrderProduct', 'order_id', 'id');
    }

    public function event()
    {
        return $this->belongsTo('App\Models\Event', 'event_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
