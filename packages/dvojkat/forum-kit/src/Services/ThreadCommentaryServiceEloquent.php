<?php

namespace Dvojkat\Forumkit\Services;

use Dvojkat\Forumkit\Models\Thread;
use DvojkaT\Forumkit\Models\ThreadCommentary;
use Dvojkat\Forumkit\Repositories\Abstracts\ThreadCommentaryRepositoryInterface;
use Dvojkat\Forumkit\Services\Abstracts\ThreadCommentaryServiceInterface;

class ThreadCommentaryServiceEloquent implements ThreadCommentaryServiceInterface
{
    private ThreadCommentaryRepositoryInterface $repository;

    public function __construct(ThreadCommentaryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function storeForThread(array $fields): ThreadCommentary
    {
        return $this->repository->create([
            'text' => $fields['text'],
            'commentable_id' => $fields['thread_id'],
            'commentable_type' => Thread::class
        ]);
    }

    /**
     * @inheritDoc
     */
    public function storeForCommentary(array $fields): ThreadCommentary
    {
        return $this->repository->create([
            'text' => $fields['text'],
            'commentable_id' => $fields['commentary_id'],
            'commentable_type' => ThreadCommentary::class
        ]);
    }
}
