<?php

namespace DvojkaT\Forumkit\Services\Abstracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ThreadServiceInterface
{
    /**
     * @return Collection<array-key, Model>
     */
    public function getThreads(): Collection;
}
