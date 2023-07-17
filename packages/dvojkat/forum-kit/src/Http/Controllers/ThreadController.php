<?php

namespace DvojkaT\Forumkit\Http\Controllers;

use App\Http\Controllers\Controller;
use Dvojkat\Forumkit\Http\Requests\StoreThreadRequest;
use Dvojkat\Forumkit\Http\Resources\ThreadFullResource;
use Dvojkat\Forumkit\Http\Resources\ThreadShortResource;
use DvojkaT\Forumkit\Models\ThreadCommentary;
use DvojkaT\Forumkit\Services\Abstracts\ThreadServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ThreadController extends Controller
{
    private ThreadServiceInterface $service;

    public function __construct(ThreadServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Получение тредов по категории
     *
     * @param int $category_id
     * @return AnonymousResourceCollection
     */
    public function index(int $category_id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ThreadShortResource::collection($this->service->getThreadsByCategory($category_id));
    }

    /**
     * Создание треда
     *
     * @return ThreadFullResource
     */
    public function store(StoreThreadRequest $request)
    {
        $data = $request->validated();
        $data['author_id'] = 1; //TODO: Auth::id();
        return new ThreadFullResource($this->service->store($data));
    }

    /**
     * Удаление треда
     *
     * @param int $thread_id
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function destroy(int $thread_id)
    {
        try {
            $this->service->destroy($thread_id);
        } catch (\Exception $e) {
            return \response('not found!', 409); //TODO: Изменить на exception
        }

        return response('deleted!', 200);
    }

    /**
     * Получение одного конкретного треда
     *
     * @param int $thread_id
     * @return ThreadFullResource
     */
    public function show(int $thread_id)
    {
        return new ThreadFullResource($this->service->show($thread_id));
    }

    /**
     * Обновление треда
     *
     * @param int $thread_id
     * @param StoreThreadRequest $request
     * @return ThreadFullResource
     */
    public function update(int $thread_id, StoreThreadRequest $request)
    {
        return new ThreadFullResource($this->service->update($thread_id, $request->validated()));
    }
}