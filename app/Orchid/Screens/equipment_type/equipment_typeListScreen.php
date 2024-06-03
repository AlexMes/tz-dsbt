<?php

declare(strict_types=1);

namespace App\Orchid\Screens\equipment_type;

use App\Orchid\Layouts\equipment_type\equipment_typeEditLayout;
use App\Orchid\Layouts\equipment_type\equipment_typeFiltersLayout;
use App\Orchid\Layouts\equipment_type\equipment_typeListLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\equipment_type;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class equipment_typeListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'equipment_type' => equipment_type::filters()
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
        return __('equipmenttype.list.title');
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return __('equipmenttype.list.description');
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.equipment_type',
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
                ->route('platform.equipment_type.create'),
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
            //equipment_typeFiltersLayout::class,
            equipment_typeListLayout::class,

            //Layout::modal('asyncEditequipment_typeModal', equipment_typeEditLayout::class)
            //    ->async('asyncGetequipment_type'),
        ];
    }

    /**
     * @param equipment_type $equipment_type
     *
     * @return array
     */
    public function asyncGetequipment_type(equipment_type $equipment_type): iterable
    {
        return [
            'equipment_type' => $equipment_type,
        ];
    }

    /**
     * @param Request $request
     * @param equipment_type    $equipment_type
     */
    public function saveequipment_type(Request $request, equipment_type $equipment_type): void
    {
        /*$request->validate([
                               'user.email' => [
                                   'required',
                                   Rule::unique(User::class, 'email')->ignore($user),
                               ],
                           ]);*/

        $equipment_type->fill($request->input('equipment_type'))->save();

        Toast::info(__('equipment_type was saved.'));
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        equipment_type::findOrFail($request->get('id'))->delete();

        Toast::info(__('equipment_type was removed'));
    }
}
