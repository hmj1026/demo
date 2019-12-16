<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Gate;

class UpdateRolePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $rolePermissions = $this->route('role')->rolePermissions;

        $isCanUpdate = Gate::allows('update', $rolePermissions->first());
        $isCanDelete = Gate::allows('delete', $rolePermissions->first());

        return $isCanUpdate && $isCanDelete;
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('您得帳號沒有權限編輯帳號類型權限!');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'permission' => 'required',
            'status' => 'required',
        ];
    }
}
