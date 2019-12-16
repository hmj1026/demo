<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $guard = 'admin';
    protected $redirectTo = '/admin';

    protected function guard()
    {
        return Auth::guard($this->guard);
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        if ($this->guard()->attempt(['account' => $request->account, 'password' => $request->password])) {
            return $this->sendLoginResponse($request);
        }

        return back()->withErrors(['account' => 'Account or password are wrong.']);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/admin/login');
    }
}
