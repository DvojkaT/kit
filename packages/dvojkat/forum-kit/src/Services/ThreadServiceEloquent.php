<?php

namespace DvojkaT\Forumkit\Services;

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

    public function getThreads(): Collection
    {
        return $this->repository->all();
    }
}
