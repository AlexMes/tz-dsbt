<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\equipment_list;

use App\Models\equipment_list;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class equipment_listListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'equipment_list';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [


            TD::make('equipment_type_id', __('equipmentlist.equipment_type_id.title'))
                ->sort()
                ->filter(TD::FILTER_SELECT, ['red'=>'Red', 'green'=>'Green'])
                ->render(fn (\App\Models\equipment_list $equipment_list) => Link::make($equipment_list -> equipment_type_equipment_type_id -> name)->route('platform.equipment_list.edit', $equipment_list ->id))
                ,

            TD::make('serial_number', __('equipmentlist.serial_number.title'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(fn (equipment_list $equipment_list) => Link::make($equipment_list->serial_number)
                    ->route('platform.equipment_list.edit', $equipment_list ->id))
                ,

            TD::make('inventory_number', __('equipmentlist.inventory_number.title'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(fn (equipment_list $equipment_list) => Link::make($equipment_list->inventory_number)
                    ->route('platform.equipment_list.edit', $equipment_list ->id))
                ,


            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (equipment_list $equipment_list) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.equipment_list.edit', $equipment_list->id)
                            ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Delete!'))
                            ->method('remove', [
                                'id' => $equipment_list->id,
                            ]),
                    ])),
        ];
    }
}
