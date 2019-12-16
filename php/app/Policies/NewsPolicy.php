<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\RolesHasPermissions;
use App\Models\News;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    public function before(Admin $admin, $ability)
    {
        if ($admin->role_id === $admin::ROLE_ADMIN_ROOT) {
            return true;
        }
    }
    
    /**
     * Determine whether the user can view any news.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can view the news.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\News  $news
     * @return mixed
     */
    public function view(Admin $admin, News $news)
    {
        //
    }

    /**
     * Determine whether the user can create news.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can update the news.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\News  $news
     * @return mixed
     */
    public function update(Admin $admin, News $news)
    {
        $updatePermissionId = Permission::where('authorize', 'news-update')->first()->id;
        $rolePermissionIds = RolesHasPermissions::where('role_id', $admin->role_id)->get()->pluck('permission_id')->toArray();
        
        if ($updatePermissionId && $rolePermissionIds && in_array($updatePermissionId, $rolePermissionIds)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the news.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\News  $news
     * @return mixed
     */
    public function delete(Admin $admin, News $news)
    {
        //
    }

    /**
     * Determine whether the user can restore the news.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\News  $news
     * @return mixed
     */
    public function restore(Admin $admin, News $news)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the news.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\News  $news
     * @return mixed
     */
    public function forceDelete(Admin $admin, News $news)
    {
        //
    }
}
