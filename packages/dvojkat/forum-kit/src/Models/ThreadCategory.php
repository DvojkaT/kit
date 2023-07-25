<?php

namespace DvojkaT\Forumkit\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $seo_title
 * @property string $seo_description
 */
class ThreadCategory extends Model
{
    use HasFactory;
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
