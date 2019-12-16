<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\News;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;

$newsType = ['news', 'event', 'article'];

$factory->define(News::class, function (Faker $faker) use ($newsType) {
    return [
        'type' => Arr::random($newsType),
        'title' => $faker->word,
        'sub_title' => $faker->sentence,
        'content' => $faker->paragraph
    ];
});
