<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\employee;

use App\Models\employee;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class employeeListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'employee';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [


            TD::make('structural_unit_id', __('employee.structural_unit_id.title'))
                ->sort()
                ->render(fn (\App\Models\employee $employee) => Link::make($employee -> structural_unit_structural_unit_id -> name)->route('platform.employee.edit', $employee ->id))
                ,

            TD::make('job_title_id', __('employee.job_title_id.title'))
                ->sort()
                ->render(fn (\App\Models\employee $employee) => Link::make($employee -> job_title_job_title_id -> name)->route('platform.employee.edit', $employee ->id))
                ,

            TD::make('name', __('employee.name.title'))
                ->sort()
                ->render(fn (employee $employee) => Link::make($employee->name)->route('platform.employee.edit', $employee ->id))
                ,


            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (employee $employee) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.employee.edit', $employee->id)
                            ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Delete!'))
                            ->method('remove', [
                                'id' => $employee->id,
                            ]),
                    ])),
        ];
    }
}
