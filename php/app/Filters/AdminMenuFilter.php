<?php

namespace App\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Auth;
use App\Models\Role;

class AdminMenuFilter implements FilterInterface
{
    private $permissions;

    public function transform($item, Builder $builder)
    {
        $roleId = Auth::guard('admin')->user()->role->id;

        if (empty($this->permissions)) {
            $role = Role::with('permissions')->where('id', $roleId)->first();
            $this->permissions = $role->permissions->toArray() ?: [];
        }
        
        if (isset($item['can']) && !empty($this->permissions)) {
            $authorizes = data_get($this->permissions, '*.authorize');
            if (! in_array($item['can'], $authorizes)) {
                return false;
            }
        }

        // if (isset($item['permission']) && ! Laratrust::can($item['permission'])) {
        //     return false;
        // }

        return $item;
    }
}