<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StatusRedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('status_reds')->insert([
        'id'           => '1',
        'descripcion'         => 'ACTIVO',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('status_reds')->insert([
        'id'           => '2',
        'descripcion'         => 'INACTIVO',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

    }
}
