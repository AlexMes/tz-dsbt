<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\register_events;

use App\Models\register_events;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Color;

class register_eventsListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'register_events';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [


            TD::make('id', 'id'),

            TD::make('date', __('registerevents.date.title'))
                ->sort()
                ->filter(TD::FILTER_DATE_RANGE)
                ->render(fn (register_events $register_events) => Link::make($register_events->date)->route('platform.register_events.edit', $register_events ->id))
                ,

            TD::make('equipment_id', __('registerevents.equipment_id.title'))
                ->sort()
                ->render(
                    fn(\App\Models\register_events $register_events) => Link::make(
                        $register_events->name." / ".$register_events->serial_number." / ".$register_events->inventory_number
                    )->route('platform.register_events.edit', $register_events->id)
                )
            ,

            TD::make('from', __('registerevents.from.title'))
                ->sort()
                ->render(fn (\App\Models\register_events $register_events) => Link::make($register_events -> employee_from)->route('platform.register_events.edit', $register_events ->id))
                ,

            TD::make('accepted', __('registerevents.accepted.title'))
                ->sort()
                ->render(
                    fn(\App\Models\register_events $register_events) => Link::make(
                        $register_events->employee_to
                    )->route('platform.register_events.edit', $register_events->id)
                )
                ,



            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (register_events $register_events) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.register_events.edit', $register_events->id)
                            ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Delete!'))
                            ->method('remove', [
                                'id' => $register_events->id,
                            ]),
                    ])),
        ];
    }
}
