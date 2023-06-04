<?php

namespace Database\Factories;

use App\Models\Phone;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Phone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'is_primary'      => $this->faker->boolean(.99),
            'can_receive_sms' => $this->faker->optional()->dateTime(),
            'number'          => $this->faker->phoneNumber,
        ];
    }
}
