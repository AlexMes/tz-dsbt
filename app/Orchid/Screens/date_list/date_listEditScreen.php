<?php

declare(strict_types=1);

namespace App\Orchid\Screens\date_list;

use App\Orchid\Layouts\Role\RolePermissionLayout;
use App\Orchid\Layouts\date_list\date_listEditLayout;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\date_list;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;

class date_listEditScreen extends Screen
{
    /**
     * @var date_list
     */
    public $date_list;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param date_list $date_list
     *
     * @return array
     */
    public function query(date_list $date_list): iterable
    {
        return [
            'date_list'       => $date_list,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->date_list->exists ? 'Edit '.__('datelist.list.title') : 'Create '.__('datelist.list.title');
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return __('datelist.list.description');;
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('buttons.remove'))
                ->icon('trash')
                ->type(Color::DARK())
                ->confirm(__('buttons.Remove?'))
                ->method('remove')
                ->canSee($this->date_list->exists),

            Button::make(__('buttons.save'))
                ->icon('check')
                ->type(Color::DARK())
                ->method('save'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [

            Layout::rows([		])->title(/*__('datelist.list.title')*/),

        ];
    }

    /**
     * @param date_list    $date_list
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(date_list $date_list, Request $request)
    {
        $date_list
            ->fill($request->collect('date_list')/*->except(['password', 'permissions', 'roles'])*/->toArray())
            //->fill(['permissions' => $permissions])
            ->save();

        Toast::info(__('date_list was saved.'));

        return redirect()->route('platform.date_list');
    }

    /**
     * @param date_list $date_list
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(date_list $date_list)
    {
        $date_list->delete();

        Toast::info(__('date_list was removed'));

        return redirect()->route('platform.systems.date_list');
    }

}
