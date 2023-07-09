<?php

namespace DvojkaT\Forumkit\Providers;

use Dvojkat\Forumkit\Repositories\Abstracts\ThreadCategoryRepositoryInterface;
use DvojkaT\Forumkit\Repositories\Abstracts\ThreadRepositoryInterface;
use Dvojkat\Forumkit\Repositories\ThreadCategoryRepositoryEloquent;
use DvojkaT\Forumkit\Repositories\ThreadRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class ForumRepositoryServiceProvider extends ServiceProvider
{
    /** @var array<string, string> */
    protected array $mappings = [
        ThreadRepositoryInterface::class => ThreadRepositoryEloquent::class,
        ThreadCategoryRepositoryInterface::class => ThreadCategoryRepositoryEloquent::class
    ];

    public function register(): void
    {
        foreach ($this->mappings as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }
}
