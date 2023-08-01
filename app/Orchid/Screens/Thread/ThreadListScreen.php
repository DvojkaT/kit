<?php

namespace App\Orchid\Screens\Thread;

use DvojkaT\Forumkit\Models\Thread;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Screen;

class ThreadListScreen extends Screen
{
    /** @var string  */
    public $name = 'Треды';
    /** @var string  */
    public $description = 'Просмотр тредов';

    /**
     * @return iterable
     */
    public function layout(): iterable
    {
        return [ThreadListLayout::class];
    }

    /**
     * @return array<string, LengthAwarePaginator>
     */
    public function query(): array
    {
        dd(array_keys(config('orchid-permissions')));
        dd(Auth::user()->hasAccess(array_keys(config('orchid-permissions.threads')[0])));
        return [
            'threads' => Thread::filters()->defaultSort('id')->paginate(config('pagination.orchid.base')),
            'user' => Auth::user()
        ];
    }
}
