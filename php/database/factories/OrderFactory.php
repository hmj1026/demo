<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;

use Illuminate\Support\Arr;

$userIds = [1,2,3,4];

$factory->define(Order::class, function (Faker $faker, $params = null) use ($userIds) {
    $originAmount = $faker->numberBetween(1000, 9999);

    $userId = isset($params['user_id']) ? $params['user_id'] : Arr::random($userIds);
    $cashflowId = isset($params['cashflow_id']) ? $params['cashflow_id'] : Arr::random($userIds);

    return [
        'user_id' => $userId,
        'cashflow_id' => $cashflowId,
        'origin_amount' => $originAmount,
        'retail_amount' => $originAmount * 0.8,
        'event_id' => $faker->randomDigitNotNull,
    ];
});

$factory->state(Order::class, 'applied', function(Faker $faker) {
    return [
        'is_applied' => true,
    ];
});

$factory->state(Order::class, 'charged', function(Faker $faker) {
    return [
        'is_charged' => true,
    ];
});

$factory->state(Order::class, 'shipped', function(Faker $faker) {
    return [
        'is_shipped' => true,
    ];
});

$factory->state(Order::class, 'user_detail_used', function(Faker $faker) {
    return [
        'is_user_detail_used' => true,
    ];
});

$factory->state(Order::class, 'billing_address_used', function(Faker $faker) {
    return [
        'is_billing_address_used' => true,
    ];
});
