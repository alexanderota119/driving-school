<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = State::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name'       => $name = $this->faker->name,
            'abbr'       => Str::limit($name, 2, ''),
            'country_id' => Country::factory(),
        ];
    }
}
