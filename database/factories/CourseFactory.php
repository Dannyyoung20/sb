<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Course::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'category_id' => rand(1,10),
        'tutor_id' => rand(1,10),
        'slug' => uniqid(true)
    ];
});
