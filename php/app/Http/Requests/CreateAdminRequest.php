<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Auth;
use Gate;

class CreateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $admin = Auth::guard('admin')->user();

        $isCanCreate = Gate::allows('create', $admin);
            
        return $admin && $isCanCreate;
    }

    protected function failedAuthorization()
    {
        throw new AuthorizationException('您得帳號沒有權限新增管理帳號權限!');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account' => 'required',
            'password' => 'required'
        ];
    }
}
