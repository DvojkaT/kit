<?php

namespace Dvojkat\Forumkit\Services\Abstracts;

use DvojkaT\Forumkit\Models\ThreadCommentary;
use Illuminate\Support\Collection;

interface ThreadCommentaryServiceInterface
{
    /**
     * Создание комментария к треду
     *
     * @param array<string, string> $fields
     * @return ThreadCommentary
     */
    public function storeForThread(array $fields): ThreadCommentary;

    /**
     * Создание комментария к комментарию
     *
     * @param array<string, string> $fields
     * @return ThreadCommentary
     */
    public function storeForCommentary(array $fields): ThreadCommentary;

    /**
     * Получение комментария по id
     *
     * @param int $id
     * @return ThreadCommentary
     */
    public function show(int $id): ThreadCommentary;

    /**
     * Преобразование комментариев к html виду
     *
     * @param Collection $commentaries
     * @return Collection
     */
    public function transformCommentariesToHTML(Collection $commentaries): Collection;
}
