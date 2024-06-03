<?php

declare(strict_types=1);

namespace App\Orchid\Screens\employee;

use App\Orchid\Layouts\employee\employeeEditLayout;
use App\Orchid\Layouts\employee\employeeFiltersLayout;
use App\Orchid\Layouts\employee\employeeListLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\employee;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class employeeListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'employee' => employee::filters()
                ->defaultSort('id', 'desc')
                ->paginate(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('employee.list.title');
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return __('employee.list.description');
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.employee',
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
                ->route('platform.employee.create'),
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
            //employeeFiltersLayout::class,
            employeeListLayout::class,

            //Layout::modal('asyncEditemployeeModal', employeeEditLayout::class)
            //    ->async('asyncGetemployee'),
        ];
    }

    /**
     * @param employee $employee
     *
     * @return array
     */
    public function asyncGetemployee(employee $employee): iterable
    {
        return [
            'employee' => $employee,
        ];
    }

    /**
     * @param Request $request
     * @param employee    $employee
     */
    public function saveemployee(Request $request, employee $employee): void
    {
        /*$request->validate([
                               'user.email' => [
                                   'required',
                                   Rule::unique(User::class, 'email')->ignore($user),
                               ],
                           ]);*/

        $employee->fill($request->input('employee'))->save();

        Toast::info(__('employee was saved.'));
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        employee::findOrFail($request->get('id'))->delete();

        Toast::info(__('employee was removed'));
    }
}
