<?php

namespace Dvojkat\Forumkit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'slug',
        'content',
        'author_id',
        'category_id',
        'image_id',
        'seo_title'
    ];
}
