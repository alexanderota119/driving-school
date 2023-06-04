<?php

namespace Database\Factories;

use App\Models\Instructor;
use App\Models\TimeOff;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimeOffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TimeOff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'date_time_off' => $this->faker->date(),
            'time_start'    => $this->faker->time(),
            'time_end'      => $this->faker->time(),
            'instructor_id' => Instructor::factory(),
            'recur_token'   => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'comments'      => $this->faker->regexify('[A-Za-z0-9]{200}'),
        ];
    }
}
