<?php

namespace Database\Factories;

use App\Models\NotificationPreference;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationPreferenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NotificationPreference::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'appointment_new_emails'    => $this->faker->optional(.8)->dateTime(),
            'appointment_update_emails' => $this->faker->optional(.8)->dateTime(),
            'appointment_cancel_emails' => $this->faker->optional(.8)->dateTime(),
        ];
    }
}
