<?php

namespace App\Models;

use App\Models\BasicModel;

class Role extends BasicModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'comment', 'valid', 'status',
    ];

    public function admins()
    {
        return $this->hasMany('App\Models\Admin', 'role_id');
    }

    public function rolePermissions()
    {
        return $this->hasMany('App\Models\RolesHasPermissions', 'role_id');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission', 'roles_has_permissions', 'role_id', 'permission_id')->active();
    }
}
