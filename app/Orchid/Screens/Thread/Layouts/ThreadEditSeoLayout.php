<?php

namespace App\Orchid\Screens\Thread\Layouts;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class ThreadEditSeoLayout extends Rows
{

    protected function fields(): iterable
    {
        return [
            Input::make('thread.seo_title')
                ->title('seo title')
        ];
    }
}
