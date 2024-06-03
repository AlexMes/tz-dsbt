<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\job_title;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Switcher;
use Orchid\Support\Color;
use Orchid\Screen\Fields\Relation;
use Orchid\Support\Facades\Layout;

class job_titleEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            
Input::make('job_title.name')
                    ->title('jobtitle.name.title')
                    //->popover('')
                    ->required()
                    ->help('jobtitle.name.description')
                    ->horizontal(),
        ];
    }
}
