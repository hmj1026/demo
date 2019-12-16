<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\RolesHasPermissions;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function before(Admin $admin, $ability)
    {
        if ($admin->role_id === $admin::ROLE_ADMIN_ROOT) {
            return true;
        }
    }
    
    /**
     * Determine whether the user can view any admins.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can view the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function view(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can create admins.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        $updatePermissionId = Permission::where('authorize', 'admin-create')->first()->id;
        $rolePermissionIds = RolesHasPermissions::where('role_id', $admin->role_id)->get()->pluck('permission_id')->toArray();
        
        if ($updatePermissionId && $rolePermissionIds && in_array($createPermissionId, $rolePermissionIds)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function update(Admin $admin)
    {
        $updatePermissionId = Permission::where('authorize', 'admin-update')->first()->id;
        $rolePermissionIds = RolesHasPermissions::where('role_id', $admin->role_id)->get()->pluck('permission_id')->toArray();
        
        if ($updatePermissionId && $rolePermissionIds && in_array($updatePermissionId, $rolePermissionIds)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function delete(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can restore the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function restore(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the admin.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function forceDelete(Admin $admin)
    {
        //
    }
}
