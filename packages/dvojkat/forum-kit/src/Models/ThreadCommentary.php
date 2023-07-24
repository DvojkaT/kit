<?php

namespace DvojkaT\Forumkit\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $text
 * @property string $commentable_type
 * @property int $commentable_id
 * @property int $user_id
 * @property Collection<ThreadCommentary> $commentaries
 * @property Collection<ThreadLike> $likes
 * @property User $author
 */
class ThreadCommentary extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'commentable_type',
        'commentable_id',
        'text',
        'user_id'
    ];

    /**
     * @return MorphTo
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Комментарии привязанные к данному комментарию
     *
     * @return MorphMany
     */
    public function commentaries(): MorphMany
    {
        return $this->morphMany(ThreadCommentary::class, 'commentable', 'commentable_type', 'commentable_id', 'id');
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(ThreadLike::class, 'likable', 'likable_type');
    }

    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
