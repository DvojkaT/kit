<?php

namespace DvojkaT\Forumkit\Services;

use Dvojkat\Forumkit\Models\Thread;
use DvojkaT\Forumkit\Repositories\Abstracts\ThreadRepositoryInterface;
use DvojkaT\Forumkit\Services\Abstracts\ThreadServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class ThreadServiceEloquent implements ThreadServiceInterface
{
    private ThreadRepositoryInterface $repository;

    public function __construct(ThreadRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritdoc
     */
    public function getThreadsByCategory(int $category_id): Collection
    {
        return $this->repository->findWhere(['category_id' => $category_id]);
    }

    /**
     * @inheritDoc
     */
    public function store(array $fields): Thread
    {
        return $this->repository->create($fields);
    }

    /**
     * @inheritDoc
     */
    public function destroy(int $thread_id): int
    {
        return $this->repository->delete($thread_id);
    }

    /**
     * @inheritDoc
     */
    public function show(int $thread_id): Thread
    {
        return $this->repository->find($thread_id);
    }

    /**
     * @inheritDoc
     */
    public function update(int $thread_id, array $attributes): Thread
    {
        return $this->repository->update($attributes, $thread_id);
    }
}
