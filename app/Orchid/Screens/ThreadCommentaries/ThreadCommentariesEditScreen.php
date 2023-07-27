<?php

namespace App\Orchid\Screens\ThreadCommentaries;

use DvojkaT\Forumkit\Models\Thread;
use DvojkaT\Forumkit\Models\ThreadCommentary;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ThreadCommentariesEditScreen extends Screen
{
    /** @var string */
    public $name;

    /** @var ThreadCommentary */
    public $commentary;

    /** @var string */
    public $parentRoute;

    public function query(ThreadCommentary $commentary): array
    {
        $commentary->load(['commentable']);
        if($commentary->commentable instanceof Thread) {
            $this->parentRoute = 'platform.threads.edit';
        } else {
            $this->parentRoute = 'platform.threads.commentaries.edit';
        }
        $this->commentary = $commentary;
        $this->name = "Просмотр комментария #$commentary->id";

        return [
            'commentary' => $commentary,
        ];
    }

    public function commandBar()
    {
        return [
            Link::make('Перейти к родителю')
                ->type(Color::SECONDARY)
                ->route($this->parentRoute, $this->commentary->commentable),

            ModalToggle::make('Удалить')
                ->modal('confirmDelete')
                ->type(Color::DANGER)
                ->method('delete')
        ];
    }

    public function layout(): iterable
    {
        return [ThreadCommentariesEditLayout::class,
            Layout::modal('confirmDelete', Layout::rows([Input::make('deletion_reason')->title('Причина удаления')]))
                ->applyButton('Удалить')
                ->closeButton('Закрыть')
                ->title('Вы уверены, что хотите удалить?')
        ];
    }

    public function delete(Request $request): void
    {
        $deletionReason = $request->get('deletion_reason') ?? null;
        $this->commentary->update(['is_deleted' => true, 'deletion_reason' => $deletionReason]);

        Toast::error('Удалено!');
    }
}
