<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\employee;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Switcher;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;

class employeeEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            
Relation::make('employee.structural_unit_id')
                        ->fromModel(\App\Models\structural_unit::class, 'name')
                        ->title('employee.structural_unit_id.title')
                        ->help('employee.structural_unit_id.description')
                        ->horizontal(),
Relation::make('employee.job_title_id')
                        ->fromModel(\App\Models\job_title::class, 'name')
                        ->title('employee.job_title_id.title')
                        ->help('employee.job_title_id.description')
                        ->horizontal(),
Input::make('employee.name')
                    ->title('employee.name.title')
                    //->popover('')
                    ->required()
                    ->help('employee.name.description')
                    ->horizontal(),
        ];
    }
}
