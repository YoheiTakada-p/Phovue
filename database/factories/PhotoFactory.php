<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Photo::class, function (Faker $faker) {
    $id = \Str::random(12);
    return [
        'id' => $id,
        'user_id' => fn () => factory(App\User::class)->create()->id,
        'filename' => $id . '.jpg',
        'created_at' => $faker->dateTime(),
        'updated_at' => $faker->dateTime()
    ];
});
