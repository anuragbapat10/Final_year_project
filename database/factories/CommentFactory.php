<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
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
    public function definition()
    {
        return [
            //
            'user_id' => rand(1,5),
            'content' => fake()->text(),
            'upvote' => fake()->numberBetween(0, 100),
            'downvote' => fake()->numberBetween(0, 100),
            'parent_id' => null,
        ];
    }
}
