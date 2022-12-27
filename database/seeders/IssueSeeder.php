<?php

namespace Database\Seeders;

use App\Models\Issue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Populating comments
      DB::table('comments')->insert([
        'user_id' => 1,
        'content' => fake()->text(),
        'upvote' => fake()->numberBetween(0, 100),
        'downvote' => fake()->numberBetween(0, 100),
        'parent_id' => null
      ]);
      DB::table('comments')->insert([
        'user_id' => 2,
        'content' => fake()->text(),
        'upvote' => fake()->numberBetween(0, 100),
        'downvote' => fake()->numberBetween(0, 100),
        'parent_id' => null
      ]);

      // Populating issues
        DB::table('issues')->insert([
          'title' => fake()->sentence(),
          'author_id' => 1,
          'organization_id' => 1,
          'desc_comment_id' => 1,
          'assignee_id' => rand(1,5),
          'status_id' => rand(1,3),
        ]);
        DB::table('issues')->insert([
          'title' => fake()->sentence(),
          'author_id' => 2,
          'organization_id' => 1,
          'desc_comment_id' => 2,
          'assignee_id' => rand(1,5),
          'status_id' => rand(1,3),
        ]);

        // Populating issues_tags
        DB::table('issues_tags')->updateOrInsert([
          'issue_id' => 1,
          'tag_id' => rand(1,5),
        ]);
        DB::table('issues_tags')->updateOrInsert([
          'issue_id' => 1,
          'tag_id' => rand(1,5),
        ]);
        DB::table('issues_tags')->updateOrInsert([
          'issue_id' => 2,
          'tag_id' => rand(1,5),
        ]);
        DB::table('issues_tags')->updateOrInsert([
          'issue_id' => 2,
          'tag_id' => rand(1,5),
        ]);
    }
}
