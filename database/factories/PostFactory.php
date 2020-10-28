<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->unique()->words(4,true),
'subtitle' => $faker->unique()->words(4,true),
'article' => $faker->realText(150),
'rating' => $faker->numberBetween($min = 0, $max = 5),
'image' => 'defaultImage.jpg',
    ];
});
