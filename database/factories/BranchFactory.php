<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @see \App\Models\Branch
 */
class BranchFactory extends Factory
{
    /**
     * {@inheritDoc}
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
        ];
    }
}
