<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\RedUsuarios;
use Faker\Generator as Faker;

$factory->define(RedUsuarios::class, function (Faker $faker) {

    return [
        'id_users_sponsor' => $faker->randomDigitNotNull,
        'id_users_invitado' => $faker->randomDigitNotNull,
        'codigo_sponsor' => $faker->text,
        'usuario_invitado' => $faker->text,
        'id_status_red' => $faker->randomDigitNotNull,
        'status' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
