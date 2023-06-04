<?php

namespace Database\Factories;

use App\Models\SpecialEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpecialEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name'       => $this->faker->name,
            'date_start' => $this->faker->date(),
            'end_date'   => $this->faker->date(),
        ];
    }
}
