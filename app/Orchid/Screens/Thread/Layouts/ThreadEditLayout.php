<?php

namespace App\Orchid\Screens\Thread\Layouts;

use DvojkaT\Forumkit\Models\ThreadCategory;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class ThreadEditLayout extends Rows
{

    protected function fields(): iterable
    {
        return [
            Input::make('thread.title')
                ->title('Название')
                ->required(),

            Relation::make('thread.category_id')
                ->title('Категория')
                ->fromModel(ThreadCategory::class, 'title', 'id'),

            Cropper::make('thread.image_id')
                ->title('Изображение')
                ->targetId(),

            Quill::make('thread.content')
                ->title('Содержание')
        ];
    }
}
