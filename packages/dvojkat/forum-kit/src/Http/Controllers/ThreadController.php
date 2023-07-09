<?php

namespace DvojkaT\Forumkit\Http\Controllers;

use App\Http\Controllers\Controller;
use DvojkaT\Forumkit\Services\Abstracts\ThreadServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ThreadController extends Controller
{
    /** @var ThreadServiceInterface */
    private $service;

    public function __construct(ThreadServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @return Collection<array-key,Model>
     */
    public function getThreads(): Collection
    {
        return $this->service->getThreads();
    }
}
