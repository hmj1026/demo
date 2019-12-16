<?php

namespace App\Models;

use App\Models\BasicModel;

class OrderShippingDetail extends BasicModel
{
    protected $table = 'orders_shipping_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'gender', 'phone_number',
        'first_name', 'last_name', 'address', 'city', 'postcode', 'comment'
    ];
    
}
