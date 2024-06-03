<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\register_events;

use App\Models\equipment_list;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Switcher;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Select;

class register_eventsEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        $equipment_list = [];
        $equipment_list_q = equipment_list::select("equipment_list.id", "name", "serial_number", "inventory_number")
        ->join('equipment_type', 'equipment_list.equipment_type_id', '=', 'equipment_type.id')
            ->defaultSort('equipment_list.id', 'desc')->get()->toArray();
        //dd($equipment_list_q);
        foreach ($equipment_list_q as $id => $item){
            $equipment_list[$item['id']] = $item['name']." / ".$item['serial_number']." / ".$item['inventory_number'];
        }

        //dd($equipment_list);

        return [

Input::make('register_events.date')
                    ->type('date')
                    ->title('registerevents.date.title')
                    ->help('registerevents.date.description')
                    ->required()
                    ->horizontal(),
Relation::make('register_events.from')
                        ->fromModel(\App\Models\employee::class, 'name')
                        ->title('registerevents.from.title')
                        ->help('registerevents.from.description')
                        ->required()
                        ->horizontal(),
Relation::make('register_events.accepted')
                        ->fromModel(\App\Models\employee::class, 'name')
                        ->title('registerevents.accepted.title')
                        ->help('registerevents.accepted.description')
                        ->required()
                        ->horizontal(),

Select::make('register_events.equipment_id')
                        //->fromModel(\App\Models\equipment_list::class, 'equipment_type_id')
                        ->options($equipment_list)
                        ->title('registerevents.equipment_id.title')
                        ->help('registerevents.equipment_id.description')
                        ->empty('')
                        ->required()
                        ->horizontal(),



        ];
    }
}
