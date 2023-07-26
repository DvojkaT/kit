<?php

namespace App\Orchid\Screens\Thread\Layouts;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Layouts\Rows;

class ThreadEditLayout extends Rows
{

    protected function fields(): iterable
    {
        return [
            Input::make('thread.title')
                ->title('Название')
                ->required(),

            Quill::make('thread.content')
                ->title('Содержание')
        ];
    }
}
