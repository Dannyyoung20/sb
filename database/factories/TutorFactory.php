<?php

use Faker\Generator as Faker;

$factory->define(App\Tutor::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastname,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'bio' => $faker->text,
        'phone' => $faker->phoneNumber,
        'location_id' => rand(1,20),
        'course_id' => rand(1, 20),
        'remember_token' => str_random(10),
    ];
});
