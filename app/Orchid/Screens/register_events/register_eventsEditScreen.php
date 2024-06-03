<?php

declare(strict_types=1);

namespace App\Orchid\Screens\register_events;

use App\Orchid\Layouts\Role\RolePermissionLayout;
use App\Orchid\Layouts\register_events\register_eventsEditLayout;
use App\Orchid\Layouts\User\UserEditLayout;use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\register_events;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Relation;
use App\Models\equipment_list;

class register_eventsEditScreen extends Screen
{
    /**
     * @var register_events
     */
    public $register_events;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param register_events $register_events
     *
     * @return array
     */
    public function query(register_events $register_events): iterable
    {

        $equipment_list = equipment_list::join('equipment_type', 'equipment_list.equipment_type_id', '=', 'equipment_type.id')
            ->defaultSort('equipment_list.id', 'desc');

        return [
            'register_events'       => $register_events,
            'equipment_list'        => $equipment_list,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->register_events->exists ? 'Edit '.__('registerevents.list.title') : 'Create '.__('registerevents.list.title');
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return __('registerevents.list.description');;
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('buttons.remove'))
                ->icon('trash')
                ->type(Color::DARK())
                ->confirm(__('buttons.Remove?'))
                ->method('remove')
                ->canSee($this->register_events->exists),

            Button::make(__('buttons.save'))
                ->icon('check')
                ->type(Color::DARK())
                ->method('save'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [

            register_eventsEditLayout::class,

            Layout::rows([
                 Group::make([
                                 Button::make(__('buttons.remove'))
                                     ->icon('trash')
                                     ->type(Color::DARK())
                                     ->confirm(__('buttons.Remove?'))
                                     ->method('remove')
                                     ->canSee($this->register_events->exists),

                                Button::make(__('buttons.print'))
                                     ->icon('trash')
                                     ->type(Color::DARK())
                                     ->method('print')
                                     ->canSee($this->register_events->exists),


                                 Button::make(__('buttons.save'))
                                     ->icon('check')
                                     ->type(Color::DARK())
                                     ->method('save'),
                             ])->autoWidth(),
             ]),

        ];
    }

    /**
     * @param register_events    $register_events
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(register_events $register_events, Request $request)
    {
        $register_events
            ->fill($request->collect('register_events')/*->except(['password', 'permissions', 'roles'])*/->toArray())
            //->fill(['permissions' => $permissions])
            ->save();

        Toast::info(__('register_events was saved.'));

        return redirect()->route('platform.register_events');
    }

    /**
     * @param register_events $register_events
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(register_events $register_events)
    {
        $register_events->delete();

        Toast::info(__('register_events was removed'));

        return redirect()->route('platform.register_events');
    }


    /**
     * @param register_events $register_events
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function print(register_events $register_events)
    {
        echo '<script>window.open("/print/register_events/'.$register_events['id'].'");location.reload();</script>';exit;

    }




}
