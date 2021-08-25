<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TpTokensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tp_tokens')->insert([
        'id'           => '1',
        'descripcion'         => 'CONFIRMACIÓN CORREO',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('tp_tokens')->insert([
        'id'           => '2',
        'descripcion'         => 'RESTABLECER CONTRASEÑA',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('tp_tokens')->insert([
        'id'           => '3',
        'descripcion'         => 'CONTRASEÑA RESTABLECIDA',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('tp_tokens')->insert([
        'id'           => '4',
        'descripcion'         => 'INHABILITADO POR EL SISTEMA',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('tp_tokens')->insert([
        'id'           => '5',
        'descripcion'         => 'RECUPERAR USUARIO',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
    }
}
