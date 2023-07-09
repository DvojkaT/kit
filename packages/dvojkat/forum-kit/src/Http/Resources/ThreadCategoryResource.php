<?php

namespace Dvojkat\Forumkit\Http\Resources;

use Dvojkat\Forumkit\Models\Thread;
use DvojkaT\Forumkit\Models\ThreadCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ThreadCategory
 */
class ThreadCategoryResource extends JsonResource
{

    public function __construct(ThreadCategory $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug
        ];
    }
}
