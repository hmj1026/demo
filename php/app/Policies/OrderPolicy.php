<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\RolesHasPermissions;
use App\Models\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function before(Admin $admin, $ability)
    {
        if ($admin->role_id === $admin::ROLE_ADMIN_ROOT) {
            return true;
        }
    }
    
    /**
     * Determine whether the user can view any orders.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can view the order.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Order  $order
     * @return mixed
     */
    public function view(Admin $admin, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can create orders.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can update the order.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Order  $order
     * @return mixed
     */
    public function update(Admin $admin, Order $order)
    {
        $updatePermissionId = Permission::where('authorize', 'order-update')->first()->id;
        $rolePermissionIds = RolesHasPermissions::where('role_id', $admin->role_id)->get()->pluck('permission_id')->toArray();
        
        if ($updatePermissionId && $rolePermissionIds && in_array($updatePermissionId, $rolePermissionIds)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the order.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Order  $order
     * @return mixed
     */
    public function delete(Admin $admin, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can restore the order.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Order  $order
     * @return mixed
     */
    public function restore(Admin $admin, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the order.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Order  $order
     * @return mixed
     */
    public function forceDelete(Admin $admin, Order $order)
    {
        //
    }
}
