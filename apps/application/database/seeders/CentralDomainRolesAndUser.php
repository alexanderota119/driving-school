<?php

namespace Database\Seeders;

use App\Enums\UserTypes;
use App\Models\User;
use Illuminate\Database\Seeder;

class CentralDomainRolesAndUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $central_admin = User::firstOrCreate(['email' => 'admin@admin.com'], [
            'first_name'        => 'admin',
            'last_name'         => 'admin',
            'password'          => 'admin123',
            'user_type_id'      => UserTypes::CENTRAL,
            'email_verified_at' => now(),
        ]);

        $role = \Bouncer::allow('central-domain-admin')->everything();

        $central_admin->assign('central-domain-admin');
    }
}
