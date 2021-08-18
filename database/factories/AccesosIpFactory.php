<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AccesosIp;
use Faker\Generator as Faker;

$factory->define(AccesosIp::class, function (Faker $faker) {

    return [
        'ip' => $faker->text,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
