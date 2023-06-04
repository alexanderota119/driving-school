<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name'  => $this->faker->name,
            'make'  => $this->faker->name,
            'model' => $this->faker->name,
            'color' => $this->faker->colorName(),
            'year'  => $this->faker->year(),
        ];
    }
}
