<?php

namespace App\Orchid\Layouts\Capucin;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class FieldEditLayout extends Rows
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
        return [
            Input::make('field.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Field Name in DB Table'))
                ->placeholder(__('Field Name in DB Table')),
            /*Input::make('table.id')->type('hidden'),
            Input::make('table.name')->type('hidden'),*/
        ];
    }
}
