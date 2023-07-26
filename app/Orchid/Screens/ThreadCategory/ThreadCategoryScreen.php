<?php

namespace App\Orchid\Screens\ThreadCategory;

use DvojkaT\Forumkit\Models\ThreadCategory;
use Illuminate\Pagination\LengthAwarePaginator;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;

class ThreadCategoryScreen extends Screen
{
    /** @var string  */
    public $name = 'Категории тредов';
    /** @var string  */
    public $description = 'Просмотр/Создание/Редактирование/Удаление тредов';
    /**
     * @return array<string, LengthAwarePaginator>
     */
    public function query(): array
    {
        return [
            'categories' => ThreadCategory::filters()->defaultSort('id')->paginate(config('pagination.orchid.base')),
        ];
    }

    public function commandBar()
    {
        return [
            ModalToggle::make('Создать')
                ->modal('createUpdate')
                ->method('createUpdate')
                ->icon('full-screen')
        ];
    }

    public function layout(): iterable
    {
        return [
            ThreadCategoryListLayout::class,
            Layout::modal('createUpdate', new ThreadCategoryEditLayout())->async('asyncGetCategory')->title('Создание')
        ];
    }


    public function asyncGetCategory(?int $id = null): array
    {
        return [
            'category' => $id ? ThreadCategory::find($id) : $id
        ];
    }

    public function createUpdate(Request $request): void
    {
        $categoryData = $request->get('category');
        if(isset($categoryData['id'])) {
            ThreadCategory::query()->updateOrCreate(['id' => $categoryData['id']], $categoryData);
        } else {
            ThreadCategory::query()->create($categoryData);
        }

        Toast::success('Сохранено!');
    }

    public function remove(int $id)
    {
        $category = ThreadCategory::find($id);
        $category->delete();

        Toast::error('Удалено!');
    }
}
