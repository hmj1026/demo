<?php

namespace App\Models;

use App\Models\BasicModel;

class UserDetail extends BasicModel
{
    protected $table = 'users_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'gender', 'phone_number',
        'billing_address', 'billing_dist','billing_county', 'billing_postcode', 
        'country_code',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->first_name}";
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
