<?php

namespace App\Orchid\Screens\Thread\Layouts;

use DvojkaT\Forumkit\Models\Thread;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class ThreadShowLayout extends Rows
{

    protected function fields(): iterable
    {
        return [
            Input::make('likes')
                ->value($this->query->get('thread.likes')->count())
                ->disabled()
                ->title('Количество лайков')
                ->style("color:#000")
        ];
    }
}
