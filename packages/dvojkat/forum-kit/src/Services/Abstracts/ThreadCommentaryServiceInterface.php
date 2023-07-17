<?php

namespace Dvojkat\Forumkit\Services\Abstracts;

use DvojkaT\Forumkit\Models\ThreadCommentary;

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
}
