<?php

$factory->define(App\User::class, function ($faker) {
    return [
        'username' => $faker->userName,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Tweet::class, function ($faker) {
    return [
        'user_id' => App\User::lists('id')->random(),
        'message' => $faker->paragraph,
        'created_at' => $faker->dateTimeBetween('-2 months'),
    ];
});
