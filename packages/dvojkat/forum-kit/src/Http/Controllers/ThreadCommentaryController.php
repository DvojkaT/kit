<?php

namespace Dvojkat\Forumkit\Http\Controllers;

use App\Http\Controllers\Controller;
use Dvojkat\Forumkit\Http\Requests\StoreThreadCommentaryForCommentaryRequest;
use Dvojkat\Forumkit\Http\Requests\StoreThreadCommentaryForThreadRequest;
use Dvojkat\Forumkit\Http\Resources\ThreadCommentaryResource;
use Dvojkat\Forumkit\Models\Thread;
use DvojkaT\Forumkit\Models\ThreadCommentary;
use Dvojkat\Forumkit\Services\Abstracts\ThreadCommentaryServiceInterface;

class ThreadCommentaryController extends Controller
{
    private ThreadCommentaryServiceInterface $service;

    public function __construct(ThreadCommentaryServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Создание комментария к треду
     *
     * @param StoreThreadCommentaryForThreadRequest $request
     * @return ThreadCommentaryResource
     */
    public function storeForThread(StoreThreadCommentaryForThreadRequest $request): ThreadCommentaryResource
    {
        return new ThreadCommentaryResource($this->service->storeForThread($request->validated()));
    }

    /**
     * Создание комментария к комментарию
     *
     * @param StoreThreadCommentaryForCommentaryRequest $request
     * @return ThreadCommentaryResource
     */
    public function storeForCommentary(StoreThreadCommentaryForCommentaryRequest $request): ThreadCommentaryResource
    {
        return new ThreadCommentaryResource($this->service->storeForCommentary($request->validated()));
    }
}
