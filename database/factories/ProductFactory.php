<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->sentence(7);

        return [
            // 'id' => generateRandomId('SP'),
            'name' => $name,
            'description' => fake()->paragraph(5),
            'short_description' => fake()->paragraph(3),
            'price' => fake()->numberBetween(),
            'slug' => Product::slugChecker($name),
            'state' => fake()->randomElement(['published', 'draft', 'hidden']),
            'status' => fake()->randomElement(['new', 'old', 'out_of_stock', 'coming_soon'])
        ];
    }
}
