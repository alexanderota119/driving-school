<?php

namespace Database\Factories;

use App\Models\AuditReason;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuditReasonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AuditReason::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
