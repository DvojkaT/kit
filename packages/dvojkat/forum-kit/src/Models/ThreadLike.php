<?php

namespace DvojkaT\Forumkit\Models;

use Illuminate\Database\Eloquent\Model;

class ThreadLike extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'likable_type',
        'likable_id'
    ];
}
