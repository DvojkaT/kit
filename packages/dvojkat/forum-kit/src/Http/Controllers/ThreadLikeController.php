<?php

namespace Dvojkat\Forumkit\Http\Controllers;

use App\Http\Controllers\Controller;
use Dvojkat\Forumkit\Http\Resources\ThreadCommentaryResource;
use Dvojkat\Forumkit\Http\Resources\ThreadShortResource;
use DvojkaT\Forumkit\Models\ThreadCommentary;
use Dvojkat\Forumkit\Services\Abstracts\ThreadLikeServiceInterface;

class ThreadLikeController extends Controller
{
    private ThreadLikeServiceInterface $service;

    public function __construct(ThreadLikeServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Привязка лайка к треду
     *
     * @param int $thread_id
     * @return ThreadShortResource
     */
    public function setLikeToThread(int $thread_id)
    {
        $thread = $this->service->setLikeToThread($thread_id, 1); //Todo: Auth::id();
        return new ThreadShortResource($thread);
    }

    /**
     * Привязка лайка к комментарию
     *
     * @param int $commentary_id
     * @return ThreadCommentaryResource
     */
    public function setLikeToCommentary(int $commentary_id)
    {
        $commentary = $this->service->setLikeToCommentary($commentary_id, 1); //Todo: Auth::id()
        return new ThreadCommentaryResource($commentary);
    }

    /**
     * Отвязка лайка от треда
     *
     * @param int $thread_id
     * @return ThreadShortResource
     */
    public function unsetThreadLike(int $thread_id)
    {
        $thread = $this->service->unsetThreadLike($thread_id, 1); //Todo: Auth::id()
        return new ThreadShortResource($thread);
    }

    /**
     * Отвязка лайка от комментария
     *
     * @param int $commentary_id
     * @return ThreadCommentaryResource
     */
    public function unsetCommentaryLike(int $commentary_id)
    {
        $commentary = $this->service->unsetCommentaryLike($commentary_id, 1); //Todo: Auth::id()
        return new ThreadCommentaryResource($commentary);
    }
}