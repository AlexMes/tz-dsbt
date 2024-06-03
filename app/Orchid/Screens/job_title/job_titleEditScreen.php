<?php

declare(strict_types=1);

namespace App\Orchid\Screens\job_title;

use App\Orchid\Layouts\Role\RolePermissionLayout;
use App\Orchid\Layouts\job_title\job_titleEditLayout;
use App\Orchid\Layouts\User\UserEditLayout;use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\job_title;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\Relation;

class job_titleEditScreen extends Screen
{
    /**
     * @var job_title
     */
    public $job_title;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @param job_title $job_title
     *
     * @return array
     */
    public function query(job_title $job_title): iterable
    {
        return [
            'job_title'       => $job_title,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->job_title->exists ? 'Edit '.__('jobtitle.list.title') : 'Create '.__('jobtitle.list.title');
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return __('jobtitle.list.description');;
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
                ->canSee($this->job_title->exists),

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

            job_titleEditLayout::class,

            Layout::rows([
                 Group::make([
                                 Button::make(__('buttons.remove'))
                                     ->icon('trash')
                                     ->type(Color::DARK())
                                     ->confirm(__('buttons.Remove?'))
                                     ->method('remove')
                                     ->canSee($this->job_title->exists),

                                 Button::make(__('buttons.save'))
                                     ->icon('check')
                                     ->type(Color::DARK())
                                     ->method('save'),
                             ])->autoWidth(),
             ]),

        ];
    }

    /**
     * @param job_title    $job_title
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(job_title $job_title, Request $request)
    {
        $job_title
            ->fill($request->collect('job_title')/*->except(['password', 'permissions', 'roles'])*/->toArray())
            //->fill(['permissions' => $permissions])
            ->save();

        Toast::info(__('job_title was saved.'));

        return redirect()->route('platform.job_title');
    }

    /**
     * @param job_title $job_title
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(job_title $job_title)
    {
        $job_title->delete();

        Toast::info(__('job_title was removed'));

        return redirect()->route('platform.systems.job_title');
    }

}
