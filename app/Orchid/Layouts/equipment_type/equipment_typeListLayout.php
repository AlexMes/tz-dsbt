<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\equipment_type;

use App\Models\equipment_type;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class equipment_typeListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'equipment_type';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [

            
            TD::make('name', __('equipmenttype.name.title'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(fn (equipment_type $equipment_type) => Link::make($equipment_type->name)->route('platform.equipment_type.edit', $equipment_type ->id))
                ,


            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (equipment_type $equipment_type) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.equipment_type.edit', $equipment_type->id)
                            ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Delete!'))
                            ->method('remove', [
                                'id' => $equipment_type->id,
                            ]),
                    ])),
        ];
    }
}
