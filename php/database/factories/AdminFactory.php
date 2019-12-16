<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$roleIds = [1,2,3];

$factory->define(Admin::class, function (Faker $faker) use($roleIds) {
    return [
        'account' => $faker->unique()->userName,
        'role_id' => Arr::random($roleIds),
        'password' => bcrypt('password'),
    ];
});

$factory->state(Admin::class, 'ROOT', [
    'role_id' => Admin::ROLE_ADMIN_ROOT
]);

$factory->state(Admin::class, 'ADVANCED', [
    'role_id' => Admin::ROLE_ADMIN_ADVANCED
]);

$factory->state(Admin::class, 'SENIOR', [
    'role_id' => Admin::ROLE_ADMIN_SENIOR
]);

$factory->state(Admin::class, 'NOVICE', [
    'role_id' => Admin::ROLE_ADMIN_NOVICE
]);
