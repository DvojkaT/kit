<?php

namespace DvojkaT\Forumkit\Providers;

use Dvojkat\Forumkit\Services\Abstracts\ThreadCategoryServiceInterface;
use Dvojkat\Forumkit\Services\Abstracts\ThreadCommentaryServiceInterface;
use Dvojkat\Forumkit\Services\Abstracts\ThreadLikeServiceInterface;
use DvojkaT\Forumkit\Services\Abstracts\ThreadServiceInterface;
use Dvojkat\Forumkit\Services\ThreadCategoryServiceEloquent;
use Dvojkat\Forumkit\Services\ThreadCommentaryServiceEloquent;
use Dvojkat\Forumkit\Services\ThreadLikeServiceEloquent;
use DvojkaT\Forumkit\Services\ThreadServiceEloquent;
use Illuminate\Support\ServiceProvider;

class ForumServiceServiceProvider extends ServiceProvider
{
    /** @var array<string, string> */
    protected array $mappings = [
        ThreadServiceInterface::class => ThreadServiceEloquent::class,
        ThreadCategoryServiceInterface::class => ThreadCategoryServiceEloquent::class,
        ThreadCommentaryServiceInterface::class => ThreadCommentaryServiceEloquent::class,
        ThreadLikeServiceInterface::class => ThreadLikeServiceEloquent::class
    ];

    public function register(): void
    {
        foreach ($this->mappings as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }
}
