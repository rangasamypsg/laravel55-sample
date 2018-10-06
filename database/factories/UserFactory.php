<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween($min =1, $max = 10),
        'phone' => $faker->PhoneNumber,
        'address' => $faker->address,        
    ];
});

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'title' => $faker->title,
        'body' => $faker->text(),        
    ];
});

/* $factory->define(App\Vote::class, function ($faker) {
    return [
        'type' => $faker->word,
        'user_id' => factory(App\User::class)->create()->id,
        'post_id' => factory(App\Post::class)->create()->id,
    ];
}); */

