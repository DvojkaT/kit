<?php

namespace App\Models;

use Dvojkat\Forumkit\Models\Thread;
use DvojkaT\Forumkit\Models\ThreadCommentary;
use DvojkaT\Forumkit\Models\ThreadLike;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Passport\HasApiTokens;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Platform\Models\User as Authenticatable;

/**
 * @property string $name
 * @property Collection<ThreadLike> $threadsLikes
 * @property Collection<ThreadLike> $commentariesLikes
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string>
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array<string>
     */
    protected $allowedFilters = [
           'id'         => Where::class,
           'name'       => Like::class,
           'email'      => Like::class,
           'updated_at' => WhereDateStartEnd::class,
           'created_at' => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array<string>
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    /**
     * @return HasMany
     */
    public function threadsLikes(): HasMany
    {
        /** @phpstan-ignore-next-line  */
        return $this->hasMany(ThreadLike::class, 'user_id', 'id')->where('likable_type', Thread::class);
    }

    /**
     * @return HasMany
     */
    public function commentariesLikes(): HasMany
    {
        /** @phpstan-ignore-next-line */
        return $this->hasMany(ThreadLike::class, 'user_id', 'id')->where('likable_type', ThreadCommentary::class);
    }
}
