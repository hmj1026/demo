<?php

namespace App\Presenters;

use App\Models\Permission;

class AdminPermissionPresenter
{
    public function getPermission($permissions, $type, $isEditable = false)
    {
        if ($type === 'checkbox') {
            $checkboxElem = '';

            $isEdit = $isEditable === false ? 'disabled' : '';
            $permissionsAll = Permission::active()
                ->get()
                ->mapToGroups(function($permission) {
                    return [$permission['target'] => $permission];
                });

            $checkedPermissions = $permissions->pluck('id')->values()->all();

            $checkboxElem .= $permissionsAll->reduce(function($carry, $items) use ($checkedPermissions) {
                $carry .= '<div class="row row_style_permission">';
                    foreach ($items as $item) {
                        $isChecked = in_array($item->id, $checkedPermissions) ? 'checked' : ''; 
                        $carry .= '<div class="col-md-3 col-xs-6"><label class="checkbox-inline">';
                        $carry .= '<input type="checkbox" name="permission['.$item->id.']" id="permission_'.$item->id.'" value="'.$item->id.'" '.$isChecked.'>'.$item->authorize;
                        $carry .= '</label></div>';
                    }
                $carry .= '</div>';

                return $carry;
            });
            
            return $checkboxElem;
        }
        
    }
}