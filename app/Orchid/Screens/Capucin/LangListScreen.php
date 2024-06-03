<?php

namespace App\Orchid\Screens\Capucin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use App\Models\CpcnLang;
use App\Orchid\Layouts\Capucin\LangListLayout;
use Orchid\Support\Facades\Toast;

class LangListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $langs = CpcnLang::filters()
            ->defaultSort('id')
            ->paginate();
        return [
            'langs' => $langs,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Localization';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'All project languages';
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.lang',
        ];

    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->type(Color::DARK())
                ->route('Capucin.LangList.lang.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [LangListLayout::class];
    }

    /**
     * @param Request $request
     */
    public function deactivate($id): void
    {
        $lang = CpcnLang::findOrFail($id);
        $lang->active = 0;
        $lang->save();
        Toast::info(__('Lang was deactivate'));
    }
    /**
     * @param Request $request
     */
    public function activate($id): void
    {
        $lang = CpcnLang::findOrFail($id);
        $lang->active = 1;
        $lang->save();
        Toast::info(__('Lang was activate'));
    }


}
