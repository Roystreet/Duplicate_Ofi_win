<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TpSexosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tp_sexos')->insert([
        'id'           => '1',
        'descripcion'         => 'FEMENINO',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('tp_sexos')->insert([
        'id'           => '2',
        'descripcion'         => 'MASCULINO',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
    }
}
