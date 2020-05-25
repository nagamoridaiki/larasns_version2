<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Background;
use App\User;
use Faker\Generator as Faker;

$factory->define(Background::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'job_detail' => $faker->text(500),
        'start_year' => $faker->integer(2020),
        'start_month' => $faker->integer(10),
        'end_year' => $faker->integer(2020),
        'end_month' => $faker->integer(10),
        'user_id' => function() {
            return factory(User::class);
        }
    ];
});
