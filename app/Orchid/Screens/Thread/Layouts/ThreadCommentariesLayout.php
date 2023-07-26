<?php

namespace App\Orchid\Screens\Thread\Layouts;

use Carbon\Carbon;
use DvojkaT\Forumkit\Models\Thread;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ThreadCommentariesLayout extends Table
{
    public $target = 'commentaries';

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
                    return Link::make($item->title)->route('platform.threads.edit', $item);
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
                return DropDown::make()->icon('three-dots-vertical')->list([
                    Button::make('Удалить')->method('remove')->parameters(['id' => $item->id])
                ]);
            })->alignRight()
        ];
    }
}
