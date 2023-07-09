<?php

namespace DvojkaT\Forumkit\Providers;

use Illuminate\Support\ServiceProvider;

class ForumServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations/');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
    }
}
