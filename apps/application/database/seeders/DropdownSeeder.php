<?php

namespace Database\Seeders;

use App\Models\Dropdown;
use Illuminate\Database\Seeder;

class DropdownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Dropdown::factory()->count(5)->create();
    }
}
