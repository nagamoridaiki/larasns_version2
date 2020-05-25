<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use App\User;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'send_user_id' => function() {
            return factory(User::class)->create()->id;
        },

        'receive_user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'message_text' => $faker->text(10),
    ];
});
