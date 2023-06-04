<?php

namespace Database\Factories;

use App\Models\TestLocation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TestLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TestLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'abbr' => Str::limit($this->faker->name, 2, ''),
        ];
    }
}
