<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TpRolsSeeder::class);
        $this->call(TpSexosSeeder::class);

        $this->call(StatusRedsSeeder::class);
        $this->call(StatusSessionsSeeder::class);
        $this->call(StatusUsersAppsSeeder::class);

        $this->call(CountriesSeeder::class);
        $this->call(TpTokensSeeder::class);

    }
}
