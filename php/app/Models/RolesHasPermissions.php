<?php

namespace App\Models;

use App\Models\BasicModel;

class RolesHasPermissions extends BasicModel
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'role_id', 'permission_id',
   ];

}
