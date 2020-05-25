<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Article;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [

        'body' => $faker->text(10),
        'article_id' => function() {
            return factory(Article::class)->create()->id;
        },
        'comment_user_id' => function() {
            return factory(User::class)->create()->id;
        }
    ];
});
