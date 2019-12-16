<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();
        Admin::insert([
            'role_id' => 4,
            'account' => 'paul',
            'password' => bcrypt('password')
        ]);
        factory(Admin::class, 20)->create();
    }
}
