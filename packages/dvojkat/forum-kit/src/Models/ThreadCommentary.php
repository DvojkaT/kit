<?php

namespace DvojkaT\Forumkit\Models;

use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
