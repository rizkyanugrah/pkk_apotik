<?php

use App\Supplier;
use Faker\Generator as Faker;

$factory->define(Supplier::class, function (Faker $faker) {
    return [
        'nama_supplier' => $faker->name,
        'alamat' => $faker->address,
        'nomor_handphone' => $faker->phoneNumber
    ];
});
