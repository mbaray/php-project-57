<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Label>
 */
class LabelFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => 'testLabel',
            'description' => fake()->paragraph(),
        ];
    }
}
