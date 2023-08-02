<?php

namespace App\Orchid\Screens\Thread;

use Carbon\Carbon;
use DvojkaT\Forumkit\Models\Thread;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ThreadListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'threads';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', '#')
                ->sort()
                ->filter(Input::make())
                ->width('150px'),

            TD::make('title', 'Название')
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(function (Thread $item) {
                    if($this->query->get('user')->hasAccess(config('orchid-permissions.platform-check.threads.update'))) {
                        return Link::make($item->title)->route('platform.threads.edit', $item);
                    } else {
                        return $item->title;
                    }
                }),

            TD::make('created_at', 'Дата создания')
                ->render(function (Thread $item) {
                    return Carbon::make($item->created_at)->format('d.m.Y H:i');
                }),
            TD::make('updated_at', 'Последнее обновление')
                ->render(function (Thread $item) {
                    return Carbon::make($item->updated_at)->format('d.m.Y H:i');
                }),

            TD::make()->render(function (Thread $item) {
                if($this->query->get('user')->hasAccess(config('orchid-permissions.platform-check.threads.delete'))) {
                    return DropDown::make()->icon('three-dots-vertical')->list([
                        Button::make('Удалить')->method('remove')->parameters(['id' => $item->id])
                    ]);
                }
            })->alignRight()
        ];
    }
}
