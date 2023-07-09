<?php

namespace Dvojkat\Forumkit\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;
use DvojkaT\Forumkit\Models\ThreadCategory;
use DvojkaT\Forumkit\Models\ThreadCommentary;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property int $author_id
 * @property int $category_id
 * @property int $image_id
 * @property string $seo_title
 * @property User $author
 * @property ThreadCategory $category
 * @property ThreadCommentary $commentaries
 */
class Thread extends Model
{
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->title);
        });
    }
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

    /**
     * @return HasOne
     */
    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    /**
     * @return HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(ThreadCategory::class, 'id', 'category_id');
    }

    /**
     * @return MorphMany
     */
    public function commentaries(): MorphMany
    {
        return $this->morphMany(ThreadCommentary::class, 'commentable', 'commentable_type');
    }
}
