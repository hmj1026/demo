<?php

namespace App\Models;

use App\Models\BasicModel;

class UserHope extends BasicModel
{
    protected $table = 'users_hopes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
