<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\StatusRed;
use Faker\Generator as Faker;

$factory->define(StatusRed::class, function (Faker $faker) {

    return [
        'descripcion' => $faker->text,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
