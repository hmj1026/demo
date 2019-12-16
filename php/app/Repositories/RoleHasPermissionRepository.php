<?php

namespace App\Repositories;

use App\Repositories\BaseMethod;
use App\Models\RolesHasPermissions;

class RoleHasPermissionRepository
{
    use BaseMethod;

    private $model;

    public function __construct(RolesHasPermissions $model)
    {
        $this->model = $model;
    }
    
}