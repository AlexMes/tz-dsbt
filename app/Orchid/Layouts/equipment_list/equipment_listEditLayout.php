<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\equipment_list;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Switcher;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;

class equipment_listEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [

Relation::make('equipment_list.equipment_type_id')
                        ->fromModel(\App\Models\equipment_type::class, 'name')
                        ->title('equipmentlist.equipment_type_id.title')
                        ->help('equipmentlist.equipment_type_id.description')
                        ->required()
                        ->horizontal(),
Input::make('equipment_list.serial_number')
                    ->title('equipmentlist.serial_number.title')
                    //->popover('')
                        ->unless()
                    ->required()

                    ->help('equipmentlist.serial_number.description')
                    ->horizontal(),
Input::make('equipment_list.inventory_number')
                    ->title('equipmentlist.inventory_number.title')
                    //->popover('')
                    ->required()
                    ->help('equipmentlist.inventory_number.description')
                    ->horizontal(),
        ];
    }
}
