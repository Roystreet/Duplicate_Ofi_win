<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class StatusUsersAppsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('status_users_apps')->insert([
        'id'           => '1',
        'status_users_app'         => 'PRE-REGISTRADO',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('status_users_apps')->insert([
        'id'           => '2',
        'status_users_app'         => 'REGISTRADO',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

      DB::table('status_users_apps')->insert([
        'id'           => '3',
        'status_users_app'         => 'BLOQUEADO',
        'status'       => true,
        'created_at'   => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at'   => Carbon::now()->format('Y-m-d H:i:s'),
      ]);

    }
}
