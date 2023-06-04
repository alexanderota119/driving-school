<?php

namespace Database\Seeders;

use App\Models\TestLocation;
use Illuminate\Database\Seeder;

class TestLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        TestLocation::factory()
            ->count(5)
            ->hasAddress()
            ->create();
    }
}
