<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BuildRolesAbilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_user = \Bouncer::allow('central-domain-admin')->everything();
    }
}
