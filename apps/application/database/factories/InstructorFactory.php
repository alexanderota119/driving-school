<?php

namespace Database\Factories;

use App\Enums\UserTypes;
use App\Models\Car;
use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstructorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Instructor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'first_name'   => $this->faker->firstName,
            'last_name'    => $this->faker->lastName,
            'middle_name'  => $this->faker->firstName,
            'email'        => $this->faker->safeEmail,
            'password'     => 'admin123',
            'car_id'       => Car::factory(),
            'user_type_id' => UserTypes::INSTRUCTOR,
        ];
    }
}
