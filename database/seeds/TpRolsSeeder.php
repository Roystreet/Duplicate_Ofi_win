<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TpRolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tp_rols')->insert([
        'id'           => '1',
        'descripcion'         => 'ADMINISTRADOR',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('tp_rols')->insert([
        'id'           => '2',
        'descripcion'         => 'EMBAJADOR',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('tp_rols')->insert([
        'id'           => '3',
        'descripcion'         => 'PASAJERO',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('tp_rols')->insert([
        'id'           => '4',
        'descripcion'         => 'CONDUCTOR',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('tp_rols')->insert([
        'id'           => '5',
        'descripcion'         => 'BÁSICO',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
    }
}
