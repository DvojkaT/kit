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
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'forum-kit-migrations');

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php'); //Todo:: выпилить и перенести в основной проект
    }
}
