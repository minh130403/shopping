<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
    {
        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();

        $amount = $this->faker->numberBetween(1, 5);
        $price = $product->price ?? $this->faker->numberBetween(10000, 500000);
        $totalPrice = $amount * $price;

        return [
            'order_id' => Order::factory(),
            'product_id' => $product->id,
            'product_name' => $product->name ?? $this->faker->words(3, true),
            'amount' => $amount,
            'price' => $price,
            'total_price' => $totalPrice,
        ];
    }
}
