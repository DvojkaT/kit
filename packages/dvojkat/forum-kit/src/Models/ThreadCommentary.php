<?php

namespace DvojkaT\Forumkit\Models;

use Illuminate\Database\Eloquent\Model;

class ThreadCommentary extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'thread_id',
        'commentable_type',
        'commentable_id',
    ];
}
