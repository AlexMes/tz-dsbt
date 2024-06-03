<?php

namespace App\Orchid\Layouts\Capucin;

use App\Models\CpcnLang;
use App\Models\CpcnTables;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class LangListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'langs';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->width('100px')->defaultHidden()->sort()->filter(),
            TD::make('code', 'Code')->width('100px')->sort()->filter()
                ->render(fn (CpcnLang $lang) => Link::make($lang->code)->route('Capucin.LangList.lang.edit', $lang->id)),
            TD::make('name', __('Name'))->sort()->filter()
                ->render(fn (CpcnLang $lang) => Link::make($lang->name)->route('Capucin.LangList.lang.edit', $lang->id)),
            TD::make('active', __('Active'))->sort()
                ->render(fn (CpcnLang $lang) => CheckBox::make('checkbox')->checked($lang->active==1?true:false)->disabled() ),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (CpcnLang $lang) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                               Link::make(__('Edit'))
                                   ->route('Capucin.LangList.lang.edit', $lang->id)
                                   ->icon('pencil'),
                               Button::make(  ($lang->active==1?__('Deactivate'):__('Activate') )  )
                                   ->icon('trash')
                                   ->confirm(($lang->active==1?__('Deactivate lang?'):__('Activate lang?') ))
                                   ->method(($lang->active==1?'deactivate':'activate'), [
                                       'lang' => $lang->id,
                                   ]),
                           ])),


        ];
    }
}
