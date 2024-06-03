<?php

declare(strict_types=1);

namespace App\Orchid\Screens\date_list;

use App\Orchid\Layouts\date_list\date_listEditLayout;
use App\Orchid\Layouts\date_list\date_listFiltersLayout;
use App\Orchid\Layouts\date_list\date_listListLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\date_list;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class date_listListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'date_list' => date_list::filters()
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
        return __('datelist.list.title');
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return __('datelist.list.description');
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.date_list',
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
                ->route('platform.date_list.create'),
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
            //date_listFiltersLayout::class,
            date_listListLayout::class,

            //Layout::modal('asyncEditdate_listModal', date_listEditLayout::class)
            //    ->async('asyncGetdate_list'),
        ];
    }

    /**
     * @param date_list $date_list
     *
     * @return array
     */
    public function asyncGetdate_list(date_list $date_list): iterable
    {
        return [
            'date_list' => $date_list,
        ];
    }

    /**
     * @param Request $request
     * @param date_list    $date_list
     */
    public function savedate_list(Request $request, date_list $date_list): void
    {
        /*$request->validate([
                               'user.email' => [
                                   'required',
                                   Rule::unique(User::class, 'email')->ignore($user),
                               ],
                           ]);*/

        $date_list->fill($request->input('date_list'))->save();

        Toast::info(__('date_list was saved.'));
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        date_list::findOrFail($request->get('id'))->delete();

        Toast::info(__('date_list was removed'));
    }
}
