<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StatusSessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('status_sessions')->insert([
        'id'           => '1',
        'status_session'         => 'ACTIVO',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('status_sessions')->insert([
        'id'           => '2',
        'status_session'         => 'INACTIVO',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('status_sessions')->insert([
        'id'           => '3',
        'status_session'         => 'ERROR DE INICIO',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

    }
}
