<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'image' => $faker->imageUrl($width = 640, $height = 480) 
    ];
});
