<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Product;
use App\Models\Permission;
use App\Models\RolesHasPermissions;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function before(Admin $admin, $ability)
    {
        if ($admin->role_id === $admin::ROLE_ADMIN_ROOT) {
            return true;
        }
    }
    
    /**
     * Determine whether the user can view any products.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can view the product.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function view(Admin $admin, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can create products.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function update(Admin $admin, Product $product)
    {
        $updatePermissionId = Permission::where('authorize', 'product-update')->first()->id;
        $rolePermissionIds = RolesHasPermissions::where('role_id', $admin->role_id)->get()->pluck('permission_id')->toArray();
        
        if ($updatePermissionId && $rolePermissionIds && in_array($updatePermissionId, $rolePermissionIds)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function delete(Admin $admin, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can restore the product.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function restore(Admin $admin, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the product.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Product  $product
     * @return mixed
     */
    public function forceDelete(Admin $admin, Product $product)
    {
        //
    }
}
