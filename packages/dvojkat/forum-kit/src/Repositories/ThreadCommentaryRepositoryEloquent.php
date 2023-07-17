<?php

namespace Dvojkat\Forumkit\Repositories;

use DvojkaT\Forumkit\Models\ThreadCommentary;
use Dvojkat\Forumkit\Repositories\Abstracts\ThreadCommentaryRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class ThreadCommentaryRepositoryEloquent extends BaseRepository implements ThreadCommentaryRepositoryInterface
{
    public function model(): string
    {
        return ThreadCommentary::class;
    }
}
