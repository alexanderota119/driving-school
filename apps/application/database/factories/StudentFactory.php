<?php

namespace Database\Factories;

use App\Enums\UserTypes;
use App\Models\Student;
use App\Models\StudentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @mixin Student
 */
class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $types = StudentType::all()->pluck('id')->toArray();
        $type_id = $this->faker->randomElement($types);

        return [
            'first_name'      => $this->faker->firstName,
            'last_name'       => $this->faker->lastName,
            'middle_name'     => $this->faker->firstName,
            'email'           => $this->faker->unique()->email,
            'password'        => 'admin123',
            'student_type_id' => $type_id,
            'user_type_id'    => UserTypes::STUDENT,
        ];
    }
}
