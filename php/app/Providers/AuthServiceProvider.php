<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\RolesHasPermissions' => 'App\Policies\RoleHasPermissionPolicy',
        'App\Models\Product' => 'App\Policies\ProductPolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\News' => 'App\Policies\NewsPolicy',
        'App\Models\Order' => 'App\Policies\OrderPolicy',
        'App\Models\Event' => 'App\Policies\EventPolicy',
        'App\Models\Admin' => 'App\Policies\AdminPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
