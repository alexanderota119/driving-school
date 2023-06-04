<?php

namespace Database\Factories;

use App\Models\StudentType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StudentType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $types = [
            'teen',
            'audit',
        ];

        return [
            'name'  => $label = $this->faker->randomElement($types),
            'label' => Str::of($label)->ucfirst(),
        ];
    }
}
