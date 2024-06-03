<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\structural_unit;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Switcher;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;

class structural_unitEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            
Input::make('structural_unit.name')
                    ->title('structuralunit.name.title')
                    //->popover('')
                    ->required()
                    ->help('structuralunit.name.description')
                    ->horizontal(),
        ];
    }
}
