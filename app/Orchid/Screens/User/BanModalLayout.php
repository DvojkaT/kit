<?php

namespace App\Orchid\Screens\User;

use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class BanModalLayout extends Rows
{

    protected function fields(): iterable
    {
        return [
            CheckBox::make('ban.is_banned_forever')
                ->title('Вечная блокировка?')
                ->sendTrueOrFalse(),

            DateTimer::make('ban.ban_until')
                ->title('Период бана')
                ->min(now()->startOfDay())
                ->help('При вечной блокировке дата не учитывается!'),

            Input::make('ban.ban_reason')
                ->title('Причина блокировки'),
        ];
    }
}
