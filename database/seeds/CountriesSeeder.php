<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('countries')->insert([
        'id'                => 1,
        'country'           => 'PERÚ',
        'code_country'      => 'PE',
        'code_phone'        => '51',
        'moneda_local'      => 'SOL',
        'moneda_admitida'   => 'USD',
        'simbolo_local'     => 'S./',
        'simbolo_admitida'  => '$',
        'conversion_monto'  => NULL,
        'url_image'    => null,
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('countries')->insert([
        'id'                => 2,
        'country'           => 'COLOMBIA',
        'code_country'      => 'CO',
        'code_phone'        => '57',
        'moneda_local'      => 'COP',
        'moneda_admitida'   => 'USD',
        'simbolo_local'     => '$',
        'simbolo_admitida'  => '$',
        'conversion_monto'  => NULL,
        'url_image'    => null,
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('countries')->insert([
        'id'                => 3,
        'country'           => 'BOLIVIA',
        'code_country'      => 'BO',
        'code_phone'        => '591',
        'moneda_local'      => 'BOB',
        'moneda_admitida'   => 'USD',
        'simbolo_local'     => 'Bs',
        'simbolo_admitida'  => '$',
        'conversion_monto'  => NULL,
        'url_image'    => null,
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('countries')->insert([
        'id'                => 4,
        'country'           => 'MÉXICO',
        'code_country'      => 'MX',
        'code_phone'        => '52',
        'moneda_local'      => 'MXN',
        'moneda_admitida'   => 'USD',
        'simbolo_local'     => '$',
        'simbolo_admitida'  => '$',
        'conversion_monto'  => NULL,
        'url_image'    => null,
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);


      DB::table('countries')->insert([
        'id'                => 5,
        'country'           => 'ECUADOR',
        'code_country'      => 'EC',
        'code_phone'        => '593',
        'moneda_local'      => 'USD',
        'moneda_admitida'   => 'USD',
        'simbolo_local'     => '$',
        'simbolo_admitida'  => '$',
        'conversion_monto'  => NULL,
        'url_image'    => null,
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);


    }
}
