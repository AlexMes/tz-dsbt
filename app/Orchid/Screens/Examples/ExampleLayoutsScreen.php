<?php

namespace App\Orchid\Screens\Examples;

use App\Orchid\Layouts\Examples\TabMenuExample;
use Orchid\Screen\Action;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ExampleLayoutsScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Overview layouts';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Components for laying out your project';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @throws \Throwable
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [

            Layout::block(Layout::view('platform::dummy.block'))
                ->title('Block header')
                ->description('Excellent description that editing or views in block'),

            Layout::block(Layout::tabs([
                                           'Example Tab 1' => Layout::rows([
                                                                               Input::make('table.localization.name.ua')
                                                                                   ->type('text')
                                                                                   ->required()
                                                                                   ->title('Name 1')
                                                                                   ->placeholder('Name 1'),

                                                                               Input::make('table.localization.description.ua')
                                                                                   ->type('text')
                                                                                   ->required()
                                                                                   ->title('description 1')
                                                                                   ->placeholder('description 1'),
                                                                           ]),
                                           'Example Tab 2' => Layout::rows([
                                                                               Input::make('table.localization.name.ua')
                                                                                   ->type('text')
                                                                                   ->required()
                                                                                   ->title('Name 2')
                                                                                   ->placeholder('Name 2'),

                                                                               Input::make('table.localization.description.ua')
                                                                                   ->type('text')
                                                                                   ->required()
                                                                                   ->title('description 2')
                                                                                   ->placeholder('description 2'),
                                                                           ]),
                                           'Example Tab 3' => Layout::rows([
                                                                               Input::make('table.localization.name.ua')
                                                                                   ->type('text')
                                                                                   ->required()
                                                                                   ->title('Name 3')
                                                                                   ->placeholder('Name 3'),

                                                                               Input::make('table.localization.description.ua')
                                                                                   ->type('text')
                                                                                   ->required()
                                                                                   ->title('description 3')
                                                                                   ->placeholder('description 3'),
                                                                           ]),
                                       ]))
                ->title('Block header')
                ->description('Excellent description that editing or views in block'),

            Layout::tabs([
                'Example Tab 1' => Layout::view('platform::dummy.block'),
                'Example Tab 2' => Layout::view('platform::dummy.block'),
                'Example Tab 3' => Layout::view('platform::dummy.block'),
            ]),

            TabMenuExample::class,
            Layout::view('platform::dummy.block'),

            Layout::columns([
                Layout::view('platform::dummy.block'),
                Layout::view('platform::dummy.block'),
                Layout::view('platform::dummy.block'),
            ]),

            Layout::accordion([
                'Collapsible Group Item #1' => Layout::view('platform::dummy.block'),
                'Collapsible Group Item #2' => Layout::view('platform::dummy.block'),
                'Collapsible Group Item #3' => Layout::view('platform::dummy.block'),
            ]),

        ];
    }
}
