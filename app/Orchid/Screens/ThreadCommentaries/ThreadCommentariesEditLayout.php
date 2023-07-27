<?php

namespace App\Orchid\Screens\ThreadCommentaries;

use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class ThreadCommentariesEditLayout extends Rows
{

    protected function fields(): iterable
    {
        return [
            Group::make([
                Switcher::make('commentary.is_deleted')
                    ->title('Удален')
                    ->disabled(),

                Input::make('commentary.deletion_reason')
                    ->title('Причина удаления')
                    ->disabled()
                    ->style("color:#000")
            ]),

            Group::make([
                TextArea::make('commentary.text')
                    ->title('Текст')
                    ->disabled()
                    ->rows(10)
                    ->style("color:#000"),

                Input::make('hidden')->hidden() //Заглушка для ширины
            ]),

        ];
    }
}
