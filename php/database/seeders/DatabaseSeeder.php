<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesHasPermissionsTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        if (env('APP_ENV') == 'local') {
            $this->call(UsersTableSeeder::class);
            $this->call(ProductsTableSeeder::class);
            $this->call(NewsTableSeeder::class);
        }
    }
}
