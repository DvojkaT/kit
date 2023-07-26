<?php

namespace App\Orchid\Screens\Thread;

use App\Orchid\Screens\Thread\Layouts\ThreadEditLayout;
use App\Orchid\Screens\Thread\Layouts\ThreadShowLayout;
use DvojkaT\Forumkit\Models\Thread;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ThreadEditScreen extends Screen
{
    /** @var string */
    public $name;

    /** @var null|Thread */
    public $thread;

    /**
     * @param Thread $thread
     * @return array
     */
    public function query(Thread $thread)
    {
        $thread->load(['commentaries', 'likes']);
        $this->thread = $thread;

        !$this->thread->exists ?: $this->name = "Редактирование треда #$thread->id";

        return [
            'thread' => $thread
        ];
    }

    /**
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar()
    {
        return [
            Button::make('Сохранить')
                ->type(Color::SUCCESS)
                ->method('createUpdate')
        ];
    }

    public function layout(): iterable
    {
        return [Layout::wrapper(ThreadShowLayout::class, [Layout::view('orchid.tree')])];
    }

    public function createUpdate(Request $request): void
    {
        $this->thread->fill($request->get('thread'))->save();

        Toast::success('Сохранено!');
    }
}
