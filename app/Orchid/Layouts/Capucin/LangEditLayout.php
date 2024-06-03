<?php

namespace App\Orchid\Layouts\Capucin;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class LangEditLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        //dd($lang);
        return [
            Input::make('lang.code')
                ->type('text')
                ->max(2)
                ->required()
                ->title(__('Code (size:2)'))
                ->placeholder(__('Code')),
            Input::make('lang.name')
                ->type('text')
                ->max(50)
                ->required()
                ->title(__('Name (max:50)'))
                ->placeholder(__('Name')),
            CheckBox::make('lang.active')
                //->checked(true)
                ->title(__('Activate'))
                ->placeholder(__('Activate'))

        ];
    }
}
