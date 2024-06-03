<?php

declare(strict_types=1);

namespace App\Orchid\Screens\equipment_list;

use App\Orchid\Layouts\equipment_list\equipment_listEditLayout;
use App\Orchid\Layouts\equipment_list\equipment_listFiltersLayout;
use App\Orchid\Layouts\equipment_list\equipment_listListLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\equipment_list;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class equipment_listListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'equipment_list' => equipment_list::filters()
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
        return __('equipmentlist.list.title');
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return __('equipmentlist.list.description');
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.equipment_list',
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
                ->route('platform.equipment_list.create'),
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
            //equipment_listFiltersLayout::class,
            equipment_listListLayout::class,

            //Layout::modal('asyncEditequipment_listModal', equipment_listEditLayout::class)
            //    ->async('asyncGetequipment_list'),
        ];
    }

    /**
     * @param equipment_list $equipment_list
     *
     * @return array
     */
    public function asyncGetequipment_list(equipment_list $equipment_list): iterable
    {
        return [
            'equipment_list' => $equipment_list,
        ];
    }

    /**
     * @param Request $request
     * @param equipment_list    $equipment_list
     */
    public function saveequipment_list(Request $request, equipment_list $equipment_list): void
    {
        /*$request->validate([
                               'user.email' => [
                                   'required',
                                   Rule::unique(User::class, 'email')->ignore($user),
                               ],
                           ]);*/

        $equipment_list->fill($request->input('equipment_list'))->save();

        Toast::info(__('equipment_list was saved.'));
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        equipment_list::findOrFail($request->get('id'))->delete();

        Toast::info(__('equipment_list was removed'));
    }
}
