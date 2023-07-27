<?php

namespace App\Orchid\Screens\Thread;

use App\Orchid\Screens\Thread\Layouts\ThreadEditLayout;
use App\Orchid\Screens\Thread\Layouts\ThreadEditSeoLayout;
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

    /** @var array */
    private $layout;

    /**
     * @param Thread $thread
     * @return array
     */
    public function query(Thread $thread)
    {
        $thread->load(['commentaries', 'likes', 'image']);
        $this->thread = $thread;
        $thread->commentaries = $thread->commentariesTree();

        if($this->thread->exists) {
            $this->name = "Редактирование треда #$thread->id";
            $this->layout = $this->setShowLayout();
        } else {
            $this->layout = $this->setEditLayout();
        }

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
        return $this->layout;
    }

    public function createUpdate(Request $request): void
    {
        $data = $request->get('thread');
        $thread = $this->thread->fill($data);
        $thread->offsetUnset('commentaries');
        $thread->save();


        Toast::success('Сохранено!');
    }

    /**
     * @return array
     */
    private function setShowLayout(): array
    {
        return [
            Layout::tabs([
                'Статистика' => [ThreadShowLayout::class, Layout::view('orchid.tree')],
                'Редактирование' => ThreadEditLayout::class,
                'SEO' => ThreadEditSeoLayout::class
            ])->activeTab('Статистика')
        ];
    }

    /**
     * @return array
     */
    private function setEditLayout(): array
    {
        return [
            Layout::tabs([
                'Основное' => ThreadEditLayout::class,
                'SEO' => ThreadEditSeoLayout::class
            ])
        ];
    }
}
