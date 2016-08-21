<?php

$factory->define(App\User::class, function ($faker) {
    static $password;

    return [
        'username' => $faker->userName,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Tweet::class, function ($faker) {
    return [
        'user_id' => App\User::pluck('id')->random(),
        'body' => $faker->text(141),
        'created_at' => $faker->dateTimeBetween('-2 months'),
    ];
});
