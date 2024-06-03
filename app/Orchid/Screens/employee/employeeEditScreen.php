<?php

declare(strict_types=1);

namespace App\Orchid\Screens\employee;

use App\Orchid\Layouts\Role\RolePermissionLayout;
use App\Orchid\Layouts\employee\employeeEditLayout;
use App\Orchid\Layouts\User\UserEditLayout;use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\employee;
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

class employeeEditScreen extends Screen
{
    /**
     * @var employee
     */
    public $employee;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param employee $employee
     *
     * @return array
     */
    public function query(employee $employee): iterable
    {
        return [
            'employee'       => $employee,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->employee->exists ? 'Edit '.__('employee.list.title') : 'Create '.__('employee.list.title');
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return __('employee.list.description');;
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
                ->canSee($this->employee->exists),

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

            employeeEditLayout::class,

            Layout::rows([
                 Group::make([
                                 Button::make(__('buttons.remove'))
                                     ->icon('trash')
                                     ->type(Color::DARK())
                                     ->confirm(__('buttons.Remove?'))
                                     ->method('remove')
                                     ->canSee($this->employee->exists),

                                 Button::make(__('buttons.save'))
                                     ->icon('check')
                                     ->type(Color::DARK())
                                     ->method('save'),
                             ])->autoWidth(),
             ]),

        ];
    }

    /**
     * @param employee    $employee
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(employee $employee, Request $request)
    {
        $employee
            ->fill($request->collect('employee')/*->except(['password', 'permissions', 'roles'])*/->toArray())
            //->fill(['permissions' => $permissions])
            ->save();

        Toast::info(__('employee was saved.'));

        return redirect()->route('platform.employee');
    }

    /**
     * @param employee $employee
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(employee $employee)
    {
        $employee->delete();

        Toast::info(__('employee was removed'));

        return redirect()->route('platform.systems.employee');
    }

}
