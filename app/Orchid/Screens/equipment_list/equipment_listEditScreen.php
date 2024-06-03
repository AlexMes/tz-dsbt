<?php

declare(strict_types=1);

namespace App\Orchid\Screens\equipment_list;

use App\Orchid\Layouts\Role\RolePermissionLayout;
use App\Orchid\Layouts\equipment_list\equipment_listEditLayout;
use App\Orchid\Layouts\User\UserEditLayout;use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\equipment_list;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Relation;

class equipment_listEditScreen extends Screen
{
    /**
     * @var equipment_list
     */
    public $equipment_list;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param equipment_list $equipment_list
     *
     * @return array
     */
    public function query(equipment_list $equipment_list): iterable
    {
        return [
            'equipment_list'       => $equipment_list,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->equipment_list->exists ? 'Edit '.__('equipmentlist.list.title') : 'Create '.__('equipmentlist.list.title');
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return __('equipmentlist.list.description');;
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
                ->canSee($this->equipment_list->exists),

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

            equipment_listEditLayout::class,

            Layout::rows([
                 Group::make([
                                 Button::make(__('buttons.remove'))
                                     ->icon('trash')
                                     ->type(Color::DARK())
                                     ->confirm(__('buttons.Remove?'))
                                     ->method('remove')
                                     ->canSee($this->equipment_list->exists),

                                 Button::make(__('buttons.save'))
                                     ->icon('check')
                                     ->type(Color::DARK())
                                     ->method('save'),
                             ])->autoWidth(),
             ]),

        ];
    }

    /**
     * @param equipment_list    $equipment_list
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(equipment_list $equipment_list, Request $request)
    {
        $equipment_list
            ->fill($request->collect('equipment_list')/*->except(['password', 'permissions', 'roles'])*/->toArray())
            //->fill(['permissions' => $permissions])
            ->save();

        Toast::info(__('equipment_list was saved.'));

        return redirect()->route('platform.equipment_list');
    }

    /**
     * @param equipment_list $equipment_list
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(equipment_list $equipment_list)
    {
        $equipment_list->delete();

        Toast::info(__('equipment_list was removed'));

        return redirect()->route('platform.systems.equipment_list');
    }

}
