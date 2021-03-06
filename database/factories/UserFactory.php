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
    static $password;

    return [
        'name' => $faker->name,
        'role_id' => mt_rand(1, 2),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'jenis_kelamin' => $faker->title,
        'alamat' => $faker->address,
        'gambar' => 'img/avatar/avatar-3.png',
        'no_telp' => $faker->phoneNumber
    ];
});
