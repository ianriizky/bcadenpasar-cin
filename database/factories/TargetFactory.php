<?php

namespace Database\Factories;

use App\Enum\Periodicity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @see \App\Models\Branch
 */
class TargetFactory extends Factory
{
    /**
     * {@inheritDoc}
     */
    public function definition()
    {
        return [
            'periodicity' => $this->faker->randomElement(Periodicity::toArray()),
            'start_date' => $startDate = $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'end_date' => $this->faker->dateTimeBetween($startDate, '+1 year'),
            'amount' => $this->faker->numberBetween(1, 100),
            'note' => $this->faker->word(),
        ];
    }
}
