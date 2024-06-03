<?php

namespace App\Orchid\Screens\Capucin;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use App\Models\CpcnTables;
use App\Orchid\Layouts\Capucin\TableListLayout;
use Orchid\Support\Color;


class TableListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        $tableList = CpcnTables::filters()
            ->defaultSort('id')
            ->paginate();

        return [
            'tables' => $tableList,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Table List';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'All project tables';
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.systems.DBM',
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
            Link::make(__('buttons.Add'))
                ->icon('plus')
                ->type(Color::DARK() )
                ->route('Capucin.TableList.table.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            TableListLayout::class,
        ];
    }
}
