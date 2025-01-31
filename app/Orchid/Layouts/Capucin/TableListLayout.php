<?php

namespace App\Orchid\Layouts\Capucin;

use App\Models\CpcnLang;
use App\Models\CpcnTables;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Content;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TableListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'tables';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->width('100px')->defaultHidden()->sort()->filter(),
            TD::make('name', __('Name in DB'))->defaultHidden()->sort()->filter()
                ->render(fn (CpcnTables $table) => Link::make($table->name)->route('Capucin.TableList.table.edit', $table->id)),
            TD::make('localization->name->ua', __('Name'))->sort()->filter()
                ->render(fn (CpcnTables $table) => Link::make($table->localization['name']['ua'])
                    ->route('Capucin.TableList.table.edit', $table->id)),
            TD::make('localization->description->ua', __('Description'))
                ->sort()->filter()
                ->render(fn (CpcnTables $table) => $table->localization['description']['ua']),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (CpcnTables $table) => DropDown::make()
                    ->icon('options-vertical')
                    ->list([
                        Link::make(__('Edit'))
                            ->route('Capucin.TableList.table.edit', $table->id)
                            ->icon('pencil'),
                        Button::make(__('Delete'))
                            ->icon('trash')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $table->id,
                            ]),
                    ])),

        ];
    }
}
