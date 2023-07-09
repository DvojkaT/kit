<?php

namespace DvojkaT\Forumkit\Providers;

use DvojkaT\Forumkit\Repositories\Abstracts\ThreadRepositoryInterface;
use DvojkaT\Forumkit\Repositories\ThreadRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class ForumRepositoryServiceProvider extends ServiceProvider
{
    /** @var array<string, string> */
    protected array $mappings = [
        ThreadRepositoryInterface::class => ThreadRepositoryEloquent::class
    ];

    public function register(): void
    {
        foreach ($this->mappings as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }
}
