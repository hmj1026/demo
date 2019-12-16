<?php

namespace App\Models;

use App\Models\BasicModel;

class UserEquipment extends BasicModel
{
    protected $table = 'users_equipments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'serial_number', 'warranty_valid_to', 'valid', 'status',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'warranty_valid_to',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'warranty_valid_to' => 'datetime',
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
