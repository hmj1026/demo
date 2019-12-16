<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderShippingDetail;
use Faker\Generator as Faker;

$factory->define(OrderShippingDetail::class, function (Faker $faker, $params) {
    $orderId = $params['order_id'] ?? $faker->randomDigit;

    return [
        'order_id' => $orderId,
        'gender' => $faker->title,
        'phone_number' => $faker->phoneNumber,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'address' => $faker->streetAddress,
        'city' => $faker->city, 
        'postcode' => $faker->postcode, 
    ];
});
