<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\job_title;

use App\Models\job_title;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class job_titleListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'job_title';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [

            
            TD::make('name', __('jobtitle.name.title'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(fn (job_title $job_title) => Link::make($job_title->name)->route('platform.job_title.edit', $job_title ->id))
                ,


            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (job_title $job_title) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.job_title.edit', $job_title->id)
                            ->icon('pencil'),

                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Delete!'))
                            ->method('remove', [
                                'id' => $job_title->id,
                            ]),
                    ])),
        ];
    }
}
