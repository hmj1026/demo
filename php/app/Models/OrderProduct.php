<?php

namespace App\Models;

use App\Models\BasicModel;

class OrderProduct extends BasicModel
{
    protected $table = 'orders_products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id', 'quantity',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
    
}
