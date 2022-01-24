<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @see \App\Models\Company
 */
class CompanyFactory extends Factory
{
    /**
     * {@inheritDoc}
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
        ];
    }
}
