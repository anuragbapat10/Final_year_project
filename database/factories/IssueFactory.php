<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Status;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Issue>
 */
class IssueFactory extends Factory
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
            'title' => fake()->sentence(),
            'organization_id' => 1,
            'author_id' => User::where('id', rand(1,5)),
            'desc_comment_id' => Comment::where('id', rand(1,5)),
            'assignee_id' => User::where('id', rand(1,5)),
            'status_id' => Status::where('id', rand(1,3)),
        ];
    }
}
