<?php

namespace DvojkaT\Forumkit\Providers;

use DvojkaT\Forumkit\Services\Abstracts\ThreadServiceInterface;
use DvojkaT\Forumkit\Services\ThreadServiceEloquent;
use Illuminate\Support\ServiceProvider;

class ForumServiceServiceProvider extends ServiceProvider
{
    /** @var array<string, string> */
    protected array $mappings = [
        ThreadServiceInterface::class => ThreadServiceEloquent::class
    ];

    public function register(): void
    {
        foreach ($this->mappings as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }
}
