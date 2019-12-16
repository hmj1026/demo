<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderProduct;
use Faker\Generator as Faker;

$factory->define(OrderProduct::class, function (Faker $faker, $params) {
    $orderId = $params['order_id'] ?? $faker->randomDigit;
    $productId = $params['product_id'] ?? $faker->randomDigit;
    
    return [
        'order_id' => $orderId,
        'product_id' => $productId,
        'quantity' => 1
    ];
});
