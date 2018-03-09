<?php

use Faker\Generator as Faker;

$factory->define(App\Tutor::class, function (Faker $faker) {
    return [
        'location_id' => rand(1,20),
        'course_id' => rand(1, 20)
    ];
});
