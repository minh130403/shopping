<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(5),
            'name' => fake()->name(),
            'content' => fake()->paragraph(1),
            'commentable_type' => null,
            'commentable_id' => null,
            'state' => fake()->randomElement(['published', 'hidden'])
         ];
    }

     public function forCommentable($model) : static {
        return $this->state(fn ()=> [
            'commentable_id' => $model->id,
            'commentable_type' => get_class($model)
        ]);
    }
}
