<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Permission;
use App\Models\RolesHasPermissions;
use App\Models\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function before(Admin $admin, $ability)
    {
        if ($admin->role_id === $admin::ROLE_ADMIN_ROOT) {
            return true;
        }
    }
    
    /**
     * Determine whether the user can view any events.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function viewAny(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can view the event.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function view(Admin $admin, Event $event)
    {
        //
    }

    /**
     * Determine whether the user can create events.
     *
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function create(Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can update the event.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function update(Admin $admin, Event $event)
    {
        $updatePermissionId = Permission::where('authorize', 'event-update')->first()->id;
        $rolePermissionIds = RolesHasPermissions::where('role_id', $admin->role_id)->get()->pluck('permission_id')->toArray();
        
        if ($updatePermissionId && $rolePermissionIds && in_array($updatePermissionId, $rolePermissionIds)) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the event.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function delete(Admin $admin, Event $event)
    {
        //
    }

    /**
     * Determine whether the user can restore the event.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function restore(Admin $admin, Event $event)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the event.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Event  $event
     * @return mixed
     */
    public function forceDelete(Admin $admin, Event $event)
    {
        //
    }
}
