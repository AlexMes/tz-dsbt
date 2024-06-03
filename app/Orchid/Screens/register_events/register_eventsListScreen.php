<?php

declare(strict_types=1);

namespace App\Orchid\Screens\register_events;

use App\Models\employee;
use App\Models\equipment_list;
use App\Orchid\Layouts\register_events\register_eventsEditLayout;
use App\Orchid\Layouts\register_events\register_eventsFiltersLayout;
use App\Orchid\Layouts\register_events\register_eventsListLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\register_events;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class register_eventsListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $register_events = register_events::select('register_events.id as id',
                                                   'register_events.date as date',
                                                   'equipment_list.serial_number as serial_number',
                                                   'equipment_list.inventory_number as inventory_number',
                                                   'equipment_type.name as name',
                                                   'employee_from.name as employee_from',
                                                   'employee_to.name as employee_to',

        )
        ->leftJoin('equipment_list', 'equipment_list.id', 'register_events.equipment_id')
        ->leftJoin('equipment_type', 'equipment_list.equipment_type_id', 'equipment_type.id')

        ->leftJoin('employee as employee_from', 'register_events.from', 'employee_from.id')

        ->leftJoin('employee as employee_to', 'register_events.accepted', 'employee_to.id')


        ->defaultSort('register_events.id', 'desc')
        ->paginate();

        return [
            'register_events' => $register_events,
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('registerevents.list.title');
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return __('registerevents.list.description');
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.register_events',
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->route('platform.register_events.create'),
        ];
    }

    /**
     * Views.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            register_eventsListLayout::class,

        ];
    }

    /**
     * @param register_events $register_events
     *
     * @return array
     */
    public function asyncGetregister_events(register_events $register_events): iterable
    {
        return [
            'register_events' => $register_events,
        ];
    }

    /**
     * @param Request $request
     * @param register_events    $register_events
     */
    public function saveregister_events(Request $request, register_events $register_events): void
    {
        $register_events->fill($request->input('register_events'))->save();

        Toast::info(__('register_events was saved.'));
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        register_events::findOrFail($request->get('id'))->delete();

        Toast::info(__('register_events was removed'));
    }
}
