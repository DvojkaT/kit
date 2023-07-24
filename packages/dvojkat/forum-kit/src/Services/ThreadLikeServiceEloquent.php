<?php

namespace Dvojkat\Forumkit\Services;

use Dvojkat\Forumkit\Exceptions\LikeAlreadyExistsHttpException;
use Dvojkat\Forumkit\Exceptions\LikeDoNotExistHttpException;
use Dvojkat\Forumkit\Models\Thread;
use DvojkaT\Forumkit\Models\ThreadCommentary;
use Dvojkat\Forumkit\Repositories\Abstracts\ThreadCommentaryRepositoryInterface;
use DvojkaT\Forumkit\Repositories\Abstracts\ThreadRepositoryInterface;
use Dvojkat\Forumkit\Services\Abstracts\ThreadLikeServiceInterface;

class ThreadLikeServiceEloquent implements ThreadLikeServiceInterface
{
    private ThreadCommentaryRepositoryInterface $threadCommentaryRepository;

    private ThreadRepositoryInterface $threadRepository;

    public function __construct(
        ThreadCommentaryRepositoryInterface $threadCommentaryRepository,
        ThreadRepositoryInterface           $threadRepository
    )
    {
        $this->threadCommentaryRepository = $threadCommentaryRepository;
        $this->threadRepository = $threadRepository;
    }

    /**
     * @inheritDoc
     */
    public function setLikeToThread(int $thread_id, int $user_id): Thread
    {
        $thread = $this->threadRepository->with(['likes'])->find($thread_id);

        if ($thread->likes->where('user_id')->count() > 0) {
            throw new LikeAlreadyExistsHttpException();
        }

        $thread->likes()->create(['user_id' => $user_id]);

        return $thread;
    }

    /**
     * @inheritDoc
     */
    public function setLikeToCommentary(int $commentary_id, int $user_id): ThreadCommentary
    {
        $commentary = $this->threadCommentaryRepository->with(['likes'])->find($commentary_id);

        if ($commentary->likes->where('user_id')->count() > 0) {
            throw new LikeAlreadyExistsHttpException();
        }

        $commentary->likes()->create(['user_id' => $user_id]);

        return $commentary;
    }

    /**
     * @inheritDoc
     */
    public function unsetThreadLike(int $thread_id, int $user_id): Thread
    {
        $thread = $this->threadRepository->with(['likes'])->find($thread_id);

        if ($thread->likes->where('user_id')->count() == 0) {
            throw new LikeDoNotExistHttpException();
        }

        $thread->likes()->delete(['user_id' => $user_id]);

        return $thread;
    }

    /**
     * @inheritDoc
     */
    public function unsetCommentaryLike(int $commentary_id, int $user_id): ThreadCommentary
    {
        $commentary = $this->threadCommentaryRepository->with(['likes'])->find($commentary_id);

        if($commentary->likes->where('user_id')->count() == 0) {
            throw new LikeDoNotExistHttpException();
        }

        $commentary->likes()->delete(['user_id' => $user_id]);

        return $commentary;
    }
}