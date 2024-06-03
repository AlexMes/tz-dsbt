<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\equipment_type;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Switcher;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;

class equipment_typeEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            
Input::make('equipment_type.name')
                    ->title('equipmenttype.name.title')
                    //->popover('')
                    ->required()
                    ->help('equipmenttype.name.description')
                    ->horizontal(),
        ];
    }
}
