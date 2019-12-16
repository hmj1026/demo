<?php

use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\Permission;
use App\Models\RolesHasPermissions;

class RolesHasPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles_has_permissions')->truncate();

        $targets = ['news', 'event', 'product', 'store', 'service', 'member', 'order', 'article', 'attach', 'admin'];
        $actions = ['access','update', 'create', 'delete'];

        $rules = [
            [
                'id' => 1,
                'title' => 'novice',
                'targets' => ['news', 'event', 'product', 'store', 'service', 'member', 'order', 'article', 'attach'],
                'actions' => ['access'],
            ],
            [
                'id' => 2,
                'title' => 'advanced',
                'targets' => ['news', 'event', 'product', 'store', 'service', 'member', 'order', 'article', 'attach'],
                'actions' => ['access', 'update'],
            ],
            [
                'id' => 3,
                'title' => 'senior',
                'targets' => ['news', 'event', 'product', 'store', 'service', 'member', 'order', 'article', 'attach'],
                'actions' => ['access', 'update', 'create'],
            ],
            [
                'id' => 4,
                'title' => 'root',
                'targets' => ['news', 'event', 'product', 'store', 'service', 'member', 'order', 'article', 'attach', 'admin'],
                'actions' => ['access','update', 'create', 'delete'],
            ],
        ];

        $roles = Role::active()->get();
        $permissions = Permission::active()->get();

        collect($roles)->each(function($role) use ($permissions, $rules) {
            $roleId = $role->id;
            $roleTitle = $role->target;

            $rule = collect($rules)->filter(function($rule) use ($roleId) {
                return $roleId === $rule['id'];
            })->first();

            $rolePermissions = $permissions
                ->filter(function ($permission) use ($rule) {
                    return in_array($permission->action, $rule['actions']) && in_array($permission->target, $rule['targets']);
                })
                ->map(function($permission) use ($roleId) {
                    return [
                        'role_id' => $roleId,
                        'permission_id' => $permission->id
                    ];
                });
            $insertData = $rolePermissions->toArray() ?: [];
            
            RolesHasPermissions::insert($insertData);
        });
    }
}
