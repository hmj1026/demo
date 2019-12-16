<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserDetail;
use Faker\Generator as Faker;

$factory->define(UserDetail::class, function (Faker $faker, $params) {
    $userId = $params['user_id'];

    return [
        'user_id' => $userId,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => $faker->title,
        'phone_number' => $faker->phoneNumber,
        'billing_address' => $faker->streetAddress,
        'billing_city' => $faker->city, 
        'billing_postcode' => $faker->postcode, 
        'country_code' => 'TW',
    ];
});
