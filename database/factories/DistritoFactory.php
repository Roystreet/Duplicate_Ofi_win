<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Distrito;
use Faker\Generator as Faker;

$factory->define(Distrito::class, function (Faker $faker) {

    return [
        'id_city' => $faker->randomDigitNotNull,
        'distrito' => $faker->text,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
