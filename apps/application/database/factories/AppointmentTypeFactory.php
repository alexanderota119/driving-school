<?php

namespace Database\Factories;

use App\Models\AppointmentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AppointmentType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->name,
            'duration'    => $this->faker->randomFloat(2, 0, 120),
            'is_test'     => $this->faker->boolean,
            'test_offset' => $this->faker->word,
            'order'       => $this->faker->word,
        ];
    }
}
