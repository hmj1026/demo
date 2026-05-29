<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();

        $roles = ['novice', 'advanced', 'senior', 'root'];
        foreach ($roles as $role) {
            Role::create([
                'title' => $role
            ]);
        }

    }
}
