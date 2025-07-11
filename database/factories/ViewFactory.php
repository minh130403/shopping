<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\View>
 */
class ViewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'viewable_id' => null,
            'viewable_type' => null,
            'ip_address' => fake()->ipv4()
        ];
    }



    public function forViewable($model): static {
        return $this->state(fn ()=> [
            'viewable_id' => $model->id,
            'viewable_type' => get_class($model),
        ]);
    }
}
