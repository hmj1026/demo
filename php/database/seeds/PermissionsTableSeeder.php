<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();

        $targets = ['news', 'event', 'product', 'store', 'service', 'member', 'order', 'article', 'attach', 'admin'];
        $actions = ['access', 'create', 'update', 'delete'];

        foreach ($targets as $target) {
            foreach ($actions as $action) {
                Permission::create([
                    'target' => $target,
                    'action' => $action,
                    'authorize' => $target . '-' . $action,
                ]);
            }
        }
    }
}
