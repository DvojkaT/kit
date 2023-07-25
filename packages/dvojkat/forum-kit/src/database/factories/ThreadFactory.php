<?php

namespace DvojkaT\Forumkit\database\factories;

use App\Models\User;
use DvojkaT\Forumkit\Models\Thread;
use DvojkaT\Forumkit\Models\ThreadCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;


/**
 * @extends Factory<Model>
 */
class ThreadFactory extends Factory
{

    protected $model = Thread::class;

    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'content' => fake()->text(),
            'author_id' => User::factory(),
            'category_id' => ThreadCategory::factory(),
        ];
    }
}
