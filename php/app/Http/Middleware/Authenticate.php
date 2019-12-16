<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        
        if (! $request->expectsJson()) {
            $actions = $request->route()->getAction();
            $prefix = $actions['prefix'] ?? '';
            // dd($actions);
            if (Str::startsWith($prefix, '/admin') || Str::startsWith($prefix, 'admin/')) {
                
                return route('admin.login.form');
            }
            if (Str::startsWith($prefix, 'member')) {
                
                return route('login');
            }

            return route('login');
        }
    }
}
