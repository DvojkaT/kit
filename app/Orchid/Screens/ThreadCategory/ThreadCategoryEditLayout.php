<?php

namespace App\Orchid\Screens\ThreadCategory;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class ThreadCategoryEditLayout extends Rows
{
    /**
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('category.id')->hidden(),

            Input::make('category.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title('Название'),

            Input::make('category.seo_title')
                ->type('text')
                ->title('seo title'),

            Input::make('category.seo_description')
                ->type('text')
                ->title('seo description')
        ];
    }
}
