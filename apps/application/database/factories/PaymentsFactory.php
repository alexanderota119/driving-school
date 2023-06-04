<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Payments;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payments::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'amount'     => $this->faker->randomFloat(2, 0, 999999.99),
            'student_id' => Student::factory(),
            'course_id'  => Course::factory(),
        ];
    }
}
