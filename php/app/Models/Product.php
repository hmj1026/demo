<?php

namespace App\Models;

use App\Models\BasicModel;

class Product extends BasicModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'sub_category_id', 'name', 'desc', 'price_com', 'price_web', 'comment','valid', 'status',
    ];

    public function details()
    {
        return $this->hasMany('App\Models\ProductDetail', 'product_id');
    }

}
