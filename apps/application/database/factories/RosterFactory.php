<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Roster;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class RosterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Roster::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name'           => $this->faker->name,
            'class_time'     => $this->faker->dateTime(),
            'is_test_passed' => $this->faker->boolean(.75),
            'student_id'     => Student::factory(),
            'course_id'      => Course::factory(),
        ];
    }
}
