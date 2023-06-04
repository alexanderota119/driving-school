<?php

namespace Database\Seeders;

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
        //create global users
        $this->callWith([
            BuildRolesAbilitiesSeeder::class,
            CentralDomainRolesAndUser::class,
            CountriesAndStatesSeeder::class,

            // add some test data
            DefaultTenantSeeder::class,
        ]);
    }
}
