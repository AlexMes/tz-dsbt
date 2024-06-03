<?php

declare(strict_types=1);

namespace App\Orchid\Screens\structural_unit;

use App\Orchid\Layouts\Role\RolePermissionLayout;
use App\Orchid\Layouts\structural_unit\structural_unitEditLayout;
use App\Orchid\Layouts\User\UserEditLayout;use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\structural_unit;
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

class structural_unitEditScreen extends Screen
{
    /**
     * @var structural_unit
     */
    public $structural_unit;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param structural_unit $structural_unit
     *
     * @return array
     */
    public function query(structural_unit $structural_unit): iterable
    {
        return [
            'structural_unit'       => $structural_unit,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->structural_unit->exists ? 'Edit '.__('structuralunit.list.title') : 'Create '.__('structuralunit.list.title');
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return __('structuralunit.list.description');;
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
                ->canSee($this->structural_unit->exists),

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

            structural_unitEditLayout::class,

            Layout::rows([
                 Group::make([
                                 Button::make(__('buttons.remove'))
                                     ->icon('trash')
                                     ->type(Color::DARK())
                                     ->confirm(__('buttons.Remove?'))
                                     ->method('remove')
                                     ->canSee($this->structural_unit->exists),

                                 Button::make(__('buttons.save'))
                                     ->icon('check')
                                     ->type(Color::DARK())
                                     ->method('save'),
                             ])->autoWidth(),
             ]),

        ];
    }

    /**
     * @param structural_unit    $structural_unit
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(structural_unit $structural_unit, Request $request)
    {
        $structural_unit
            ->fill($request->collect('structural_unit')/*->except(['password', 'permissions', 'roles'])*/->toArray())
            //->fill(['permissions' => $permissions])
            ->save();

        Toast::info(__('structural_unit was saved.'));

        return redirect()->route('platform.structural_unit');
    }

    /**
     * @param structural_unit $structural_unit
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(structural_unit $structural_unit)
    {
        $structural_unit->delete();

        Toast::info(__('structural_unit was removed'));

        return redirect()->route('platform.systems.structural_unit');
    }

}
