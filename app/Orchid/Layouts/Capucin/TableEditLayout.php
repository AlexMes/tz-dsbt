<?php

namespace App\Orchid\Layouts\Capucin;

use App\Models\CpcnLang;
use Illuminate\Support\Facades\Session;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;


class TableEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('table.name')
            ->type('text')
            ->max(255)
                ->value("")
            ->required()
            ->title(__('Name in DB'))
            ->placeholder(__('Name in DB'))
        ];

    }
}
