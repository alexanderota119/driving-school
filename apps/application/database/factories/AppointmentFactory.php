<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\Car;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\TestLocation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'student_id'          => Student::factory(),
            'instructor_id'       => Instructor::factory(),
            'creator_id'          => User::factory(),
            'date'                => $this->faker->date(),
            'time_start'          => $this->faker->time(),
            'time_end'            => $this->faker->time(),
            'appointment_type_id' => AppointmentType::factory(),
            'test_location_id'    => TestLocation::factory(),
            'test_passed'         => $this->faker->randomElement([null, $this->faker->dateTime()]),
            'cancelled_date'      => $this->faker->randomElement([null, $this->faker->dateTime()]),
            'cancelled_comment'   => $this->faker->sentence,
            'car_id'              => Car::factory(),
            'pickup_location_id'  => TestLocation::factory(),
            'dl304a'              => $this->faker->randomElement([$this->faker->regexify('[A-Za-z0-9]{6}'), null]),
            'dl304c'              => $this->faker->randomElement([$this->faker->regexify('[A-Za-z0-9]{6}'), null]),
        ];
    }
}
