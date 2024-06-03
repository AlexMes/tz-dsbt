<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\structural_unit;

use App\Models\structural_unit;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class structural_unitListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'structural_unit';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [

            
            TD::make('name', __('structuralunit.name.title'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(fn (structural_unit $structural_unit) => Link::make($structural_unit->name)->route('platform.structural_unit.edit', $structural_unit ->id))
                ,


            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (structural_unit $structural_unit) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.structural_unit.edit', $structural_unit->id)
                            ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Delete!'))
                            ->method('remove', [
                                'id' => $structural_unit->id,
                            ]),
                    ])),
        ];
    }
}
