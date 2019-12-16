<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\RolesHasPermissions;

use Illuminate\Auth\Access\HandlesAuthorization;

class RoleHasPermissionPolicy
{
    use HandlesAuthorization;
    
    public function before(Admin $admin, $ability)
    {
        if ($admin->role_id === $admin::ROLE_ADMIN_ROOT) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any roles has permissions.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can view the roles has permissions.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\RolesHasPermissions  $rolesHasPermissions
     * @return mixed
     */
    public function view(Admin $admin, RolesHasPermissions $rolesHasPermissions)
    {
        //
    }

    /**
     * Determine whether the user can create roles has permissions.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can update the roles has permissions.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\RolesHasPermissions  $rolesHasPermissions
     * @return mixed
     */
    public function update(Admin $admin, RolesHasPermissions $rolesHasPermissions)
    {
        $updatePermissionId = Permission::where('authorize', 'admin-update')->first()->id;
        $rolePermissionIds = RolesHasPermissions::where('role_id', $admin->role_id)->get()->pluck('permission_id')->toArray();
        
        if ($updatePermissionId && $rolePermissionIds && in_array($updatePermissionId, $rolePermissionIds)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the roles has permissions.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\RolesHasPermissions  $rolesHasPermissions
     * @return mixed
     */
    public function delete(Admin $admin, RolesHasPermissions $rolesHasPermissions)
    {
        return (int)$admin->role_id === $admin::ROLE_ADMIN_ROOT;
    }

    /**
     * Determine whether the user can restore the roles has permissions.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\RolesHasPermissions  $rolesHasPermissions
     * @return mixed
     */
    public function restore(Admin $admin, RolesHasPermissions $rolesHasPermissions)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the roles has permissions.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\RolesHasPermissions  $rolesHasPermissions
     * @return mixed
     */
    public function forceDelete(Admin $admin, RolesHasPermissions $rolesHasPermissions)
    {
        //
    }
}
