<?php

namespace App\Orchid\Layouts\Capucin;

use App\Models\CpcnTableFields;
use App\Models\CpcnTables;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class FieldsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'fields';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id', 'ID')->width('100px')->defaultHidden()->sort()->filter(),
            TD::make('name', __('Name in DB'))
                ->defaultHidden()->sort()->filter()
            /*->render(fn (User $user) => new Persona($user->presenter()))*/,

            TD::make('localization->name->ua', __('Name'))
                ->sort()->filter()
                ->render(fn (CpcnTableFields $field) => Link::make($field->localization['name']['ua'])
                    ->route('Capucin.TableList.table.field.edit', ['table' => $field->table_id, 'field' => $field->id])),

            TD::make('localization->description->ua', __('Description'))
                ->sort()->filter()
                ->render(function (CpcnTableFields $table){
                    return $table->localization['description']['ua'];
                } ),

        ];
    }
}
