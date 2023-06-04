<?php

namespace Database\Factories;

use App\Models\Dropdown;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DropdownFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dropdown::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name'      => $name = $this->faker->name,
            'slug'      => Str::of($name)->lower()->slug(),
            'type_name' => Str::of($this->faker->company)->lower()->slug(),
            'sort'      => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
