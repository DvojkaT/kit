<?php

namespace DvojkaT\Forumkit\database\seeders;

use DvojkaT\Forumkit\Models\Thread;
use Illuminate\Database\Seeder;

class ForumKitDatabaseSeeder extends Seeder
{

    /**
     * @param array $parameters
     * @return void
     */
    public function __invoke(array $parameters = []): void
    {
        $this->run();
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ThreadCategorySeeder::class,
            ThreadSeeder::class
        ]);

        Thread::factory()->count(25)->make();

    }
}
