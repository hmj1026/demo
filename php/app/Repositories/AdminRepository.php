<?php

namespace App\Repositories;

use App\Repositories\BaseMethod;
use App\Models\Admin;

class AdminRepository
{
    use BaseMethod;

    private $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

}