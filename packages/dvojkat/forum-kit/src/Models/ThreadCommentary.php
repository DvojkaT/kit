<?php

namespace DvojkaT\Forumkit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $text
 * @property string $commentable_type
 * @property int $commentable_id
 */

/**
 * @property int $id
 * @property string $text
 */
class ThreadCommentary extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'commentable_type',
        'commentable_id',
        'text'
    ];

    /**
     * @return MorphTo
     */
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return MorphMany
     */
    public function commentaries(): MorphMany
    {
        return $this->morphMany(ThreadCommentary::class, 'commentable', 'commentable_type', 'commentable_id', 'commentable_id');
    }
}