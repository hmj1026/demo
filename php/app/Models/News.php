<?php

namespace App\Models;

use App\Models\BasicModel;

class News extends BasicModel
{
    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'title', 'sub_title', 'cotent', 'comment','valid', 'status',
    ];
}
