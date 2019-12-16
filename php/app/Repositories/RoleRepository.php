<?php

namespace App\Repositories;

use App\Repositories\BaseMethod;
use App\Models\Role;

class RoleRepository
{
    use BaseMethod;

    private $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

}