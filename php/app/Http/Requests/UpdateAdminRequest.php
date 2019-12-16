<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Gate;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $admin = $this->route('admin');
        $isCanUpdate = Gate::allows('update', $admin);
            
        return $admin && $isCanUpdate;
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('您得帳號沒有權限變更管理帳號權限!');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role_id' => 'required',
            'status' => 'required',
        ];
    }
}
