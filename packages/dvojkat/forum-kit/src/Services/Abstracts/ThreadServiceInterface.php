<?php

namespace DvojkaT\Forumkit\Services\Abstracts;

use Dvojkat\Forumkit\Models\Thread;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ThreadServiceInterface
{
    /**
     * Получение тредов по категории
     *
     * @param int $category_id
     * @return Collection<array-key, Model>
     */
    public function getThreadsByCategory(int $category_id): Collection;

    /**
     * @param array<string, string> $fields
     * @return Thread
     */
    public function store(array $fields): Thread;

    /**
     * @param int $thread_id
     * @return int
     */
    public function destroy(int $thread_id): int;

    /**
     * @param int $thread_id
     * @return Thread
     */
    public function show(int $thread_id): Thread;

    /**
     * @param int $thread_id
     * @param array<string, string> $attributes
     * @return Thread
     */
    public function update(int $thread_id, array $attributes): Thread;
}
