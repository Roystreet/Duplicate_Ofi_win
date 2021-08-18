<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ServicioManicuristaAtencion;
use Faker\Generator as Faker;

$factory->define(ServicioManicuristaAtencion::class, function (Faker $faker) {

    return [
        'id_servicio_manicurista' => $faker->randomDigitNotNull,
        'id_tp_atencion'          => $faker->randomDigitNotNull,
        'url'                     => $faker->text,
        'status'                  => $faker->word,
        'created_at'              => $faker->date('Y-m-d H:i:s'),
        'updated_at'              => $faker->date('Y-m-d H:i:s')
    ];
});
