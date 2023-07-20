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

    /**
     * @inheritDoc
     */
    public function show(int $id): ThreadCommentary
    {
        $commentary = $this->repository->find($id);
        $commentary->text = $this->commentaryParses($commentary->text);

        return $commentary;
    }

    /**
     * Преобразование текста по тегам
     *
     * @param string $comment
     * @return string
     */
    private function commentaryParses(string $comment): string
    {
        preg_replace_callback_array([
            "(\|(.*?)\|)" => function ($item) use ($comment) {
                $comment = str_replace($item[0], '<u>'.$item[1].'</u>', $comment);
            },
        ], $comment);
        dd($comment);
        return $comment;
    }
}
