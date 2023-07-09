<?php

namespace Dvojkat\Forumkit\Repositories;

use DvojkaT\Forumkit\Models\ThreadCategory;
use Dvojkat\Forumkit\Repositories\Abstracts\ThreadCategoryRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class ThreadCategoryRepositoryEloquent extends BaseRepository implements ThreadCategoryRepositoryInterface
{
    public function model(): string
    {
        return ThreadCategory::class;
    }
}
