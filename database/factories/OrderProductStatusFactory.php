<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderProductstatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => str_replace('.', '', $this->faker->sentence(1, true)),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->sentence(3, true),
        ];
    }
}
