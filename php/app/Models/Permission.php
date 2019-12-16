<?php

namespace App\Models;

use App\Models\BasicModel;

class Permission extends BasicModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'target', 'action', 'authorize', 'valid', 'status',
    ];

    
}
