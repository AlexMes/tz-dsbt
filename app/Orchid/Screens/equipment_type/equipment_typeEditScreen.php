<?php

declare(strict_types=1);

namespace App\Orchid\Screens\equipment_type;

use App\Orchid\Layouts\Role\RolePermissionLayout;
use App\Orchid\Layouts\equipment_type\equipment_typeEditLayout;
use App\Orchid\Layouts\User\UserEditLayout;use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\equipment_type;
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

class equipment_typeEditScreen extends Screen
{
    /**
     * @var equipment_type
     */
    public $equipment_type;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param equipment_type $equipment_type
     *
     * @return array
     */
    public function query(equipment_type $equipment_type): iterable
    {
        return [
            'equipment_type'       => $equipment_type,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->equipment_type->exists ? 'Edit '.__('equipmenttype.list.title') : 'Create '.__('equipmenttype.list.title');
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return __('equipmenttype.list.description');;
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
                ->canSee($this->equipment_type->exists),

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

            equipment_typeEditLayout::class,

            Layout::rows([
                 Group::make([
                                 Button::make(__('buttons.remove'))
                                     ->icon('trash')
                                     ->type(Color::DARK())
                                     ->confirm(__('buttons.Remove?'))
                                     ->method('remove')
                                     ->canSee($this->equipment_type->exists),

                                 Button::make(__('buttons.save'))
                                     ->icon('check')
                                     ->type(Color::DARK())
                                     ->method('save'),
                             ])->autoWidth(),
             ]),

        ];
    }

    /**
     * @param equipment_type    $equipment_type
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(equipment_type $equipment_type, Request $request)
    {
        $equipment_type
            ->fill($request->collect('equipment_type')/*->except(['password', 'permissions', 'roles'])*/->toArray())
            //->fill(['permissions' => $permissions])
            ->save();

        Toast::info(__('equipment_type was saved.'));

        return redirect()->route('platform.equipment_type');
    }

    /**
     * @param equipment_type $equipment_type
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(equipment_type $equipment_type)
    {
        $equipment_type->delete();

        Toast::info(__('equipment_type was removed'));

        return redirect()->route('platform.systems.equipment_type');
    }

}
