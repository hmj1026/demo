<?php

namespace App\Models;

use App\Models\BasicModel;

class ProductDetail extends BasicModel
{
    protected $table = 'products_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'content', 'comment','valid', 'status',
    ];
}
