<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
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
            'image' => null,
            'price' => $this->faker->randomFloat(2, 0, 999),
            'quantity' => $this->faker->numberBetween(0, 250),
            'is_visible' => $this->faker->boolean(),
            'category_id' => DB::table('categories')->inRandomOrder()->first()->id,
        ];
    }
}
