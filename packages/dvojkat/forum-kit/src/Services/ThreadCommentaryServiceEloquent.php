<?php

namespace Dvojkat\Forumkit\Services;

use App\Models\User;
use Dvojkat\Forumkit\DTO\ThreadCommentaryDTO;
use Dvojkat\Forumkit\Models\Thread;
use DvojkaT\Forumkit\Models\ThreadCommentary;
use Dvojkat\Forumkit\Repositories\Abstracts\ThreadCommentaryRepositoryInterface;
use Dvojkat\Forumkit\Services\Abstracts\ThreadCommentaryServiceInterface;
use Illuminate\Support\Collection;

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
        return $this->repository->find($id);
    }

    /**
     * @inheritDoc
     */
    public function transformCommentariesToHTML(Collection $commentaries): Collection
    {
        return $commentaries->transform(function (ThreadCommentary $commentary) {
            $commentary->text = $this->commentaryParser($commentary->text);
            return $commentary;
        });
    }

    /**
     * @inheritDoc
     */
    public function checkForLike(Collection $commentaries, User $user): Collection
    {
        $likedComments = $user->commentariesLikes->pluck('likable_id');
        return $commentaries->map(function (ThreadCommentary $commentary) use ($likedComments) {
            if($likedComments->contains($commentary->id)) {
                $isLiked = true;
            } else {
                $isLiked = false;
            }
            return new ThreadCommentaryDTO($commentary, $isLiked);
        });
    }

    /**
     * Преобразование текста по тегам
     *
     * @param string $comment
     * @return string
     */
    private function commentaryParser(string $comment): string
    {
        $patterns = [
            "((\<(.*?)\>))" => function (array $matches) {
                return "<code>$matches[2]</code>";
            },
            "(\*(.*?)\*)" => function (array $matches) {
                return str_replace($matches[0], '<u>'.$matches[1].'</u>', $matches[0]);
            },
            "((http|ftp|https):\/\/([\w_-]+(?:(?:\.[\w_-]+)+))([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-]))" => function (array $matches) {
                return "<a href='$matches[0]'>".$matches[0]."</a>";
            },
            '((\|(.*?)\|)([^\s,.;:"]+))' => function (array $matches) {
                return "<a href='$matches[2]'>".$matches[3]."</a>";
            },
        ];

        return preg_replace_callback_array($patterns, $comment);
    }
}
