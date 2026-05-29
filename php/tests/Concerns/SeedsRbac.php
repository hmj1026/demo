<?php

namespace Tests\Concerns;

/**
 * Seeds the role / permission tables that the admin panel depends on.
 *
 * The AdminLTE menu filter (App\Filters\AdminMenuFilter) reads
 * Auth::guard('admin')->user()->role->id while rendering, so any test that
 * renders an admin view must have the RBAC reference data present. Production
 * gets this from DatabaseSeeder; RefreshDatabase does not, so we seed it here.
 */
trait SeedsRbac
{
    protected function seedRbac()
    {
        $this->artisan('db:seed', ['--class' => 'RolesTableSeeder']);
        $this->artisan('db:seed', ['--class' => 'PermissionsTableSeeder']);
        $this->artisan('db:seed', ['--class' => 'RolesHasPermissionsTableSeeder']);
    }
}
