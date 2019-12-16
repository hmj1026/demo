<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetail;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users_detail')->truncate();

        factory(User::class, 10)
            ->create()
            ->each(function($user) {
                $user->detail()->save(factory(UserDetail::class)->make(['user_id' => $user->id]));
            });
    }
}
