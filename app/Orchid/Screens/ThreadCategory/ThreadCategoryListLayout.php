<?php

namespace App\Orchid\Screens\ThreadCategory;

use DvojkaT\Forumkit\Models\ThreadCategory;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ThreadCategoryListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'categories';

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
                ->render(function (ThreadCategory $item) {
                    return ModalToggle::make($item->title)
                        ->modal('createUpdate')
                        ->asyncParameters(['id' => $item->id])
                        ->modalTitle("Редактирование #$item->id")
                        ->method('createUpdate');
                }),

            TD::make()->render(function (ThreadCategory $item) {
                return DropDown::make()->icon('three-dots-vertical')->list([
                    ModalToggle::make('Редактировать')
                        ->modal('createUpdate')
                        ->asyncParameters(['id' => $item->id])
                        ->modalTitle("Редактирование #$item->id")
                        ->method('createUpdate'),
                    Button::make('Удалить')->method('remove')->parameters(['id' => $item->id])
                ]);
            })->alignRight()
        ];
    }
}
