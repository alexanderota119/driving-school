<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'street1'  => $this->faker->streetAddress,
            'city'     => $this->faker->city,
            'state_id' => State::inRandomOrder()->first(),
            'zipcode'  => $this->faker->postcode(),
        ];
    }
}
