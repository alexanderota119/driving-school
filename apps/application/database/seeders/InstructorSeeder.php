<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Instructor::factory()
            ->count(5)
            ->hasAddress()
            ->hasPhone()
            ->create()
            ->each(fn ($instructor) => $instructor->assign('instructor'));
    }
}
