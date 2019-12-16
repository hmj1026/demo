<?php

namespace App\Presenters;

use App\Models\Admin;
use App\Models\Role;

class AdminRolePresenter
{
    public function getRole(Admin $admin = null, $type, $isEditable = false, $roles = null)
    {
        if (! $roles) {
            $roles = Role::get();
        }
        $roleId = $admin->role_id ?? Admin::ROLE_ADMIN_NOVICE;
        
        if ($type === 'title') {
            $role = $roles->filter(function($item) use ($roleId) {
                return $item->id === $roleId;
            })->first();

            return $role->title ?? 'UNKNOWN';
        }

        if ($type === 'select') {
            $isEdit = $isEditable === false ? 'disabled' : '';

            $options = '<select class="form-control" name="role_id" id="role_id" '.$isEdit.'>';
            $options .= $roles->reduce(function($carry, $item) use ($roleId) {
                $isSelected = $roleId === $item->id ? 'selected' : '';
                $carry .= '<option value="'.$item->id.'" '.$isSelected.'>'.$item->title.'</option>';

                return $carry;
            }, '');
            $options .= '</select>';
            
            return $options;
        }
        
    }
}