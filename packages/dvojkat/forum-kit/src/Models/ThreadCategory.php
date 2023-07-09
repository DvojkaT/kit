<?php

namespace DvojkaT\Forumkit\Models;

use Illuminate\Database\Eloquent\Model;

class ThreadCategory extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'slug',
        'seo_title',
        'seo_description'
    ];
}
