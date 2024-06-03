<?php

declare(strict_types=1);

namespace App\Orchid\Screens\structural_unit;

use App\Orchid\Layouts\structural_unit\structural_unitEditLayout;
use App\Orchid\Layouts\structural_unit\structural_unitFiltersLayout;
use App\Orchid\Layouts\structural_unit\structural_unitListLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\structural_unit;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class structural_unitListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'structural_unit' => structural_unit::filters()
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
        return __('structuralunit.list.title');
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return __('structuralunit.list.description');
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.structural_unit',
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
                ->route('platform.structural_unit.create'),
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
            //structural_unitFiltersLayout::class,
            structural_unitListLayout::class,

            //Layout::modal('asyncEditstructural_unitModal', structural_unitEditLayout::class)
            //    ->async('asyncGetstructural_unit'),
        ];
    }

    /**
     * @param structural_unit $structural_unit
     *
     * @return array
     */
    public function asyncGetstructural_unit(structural_unit $structural_unit): iterable
    {
        return [
            'structural_unit' => $structural_unit,
        ];
    }

    /**
     * @param Request $request
     * @param structural_unit    $structural_unit
     */
    public function savestructural_unit(Request $request, structural_unit $structural_unit): void
    {
        /*$request->validate([
                               'user.email' => [
                                   'required',
                                   Rule::unique(User::class, 'email')->ignore($user),
                               ],
                           ]);*/

        $structural_unit->fill($request->input('structural_unit'))->save();

        Toast::info(__('structural_unit was saved.'));
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        structural_unit::findOrFail($request->get('id'))->delete();

        Toast::info(__('structural_unit was removed'));
    }
}
