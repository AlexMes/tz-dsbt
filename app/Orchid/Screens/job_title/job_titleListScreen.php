<?php

declare(strict_types=1);

namespace App\Orchid\Screens\job_title;

use App\Orchid\Layouts\job_title\job_titleEditLayout;
use App\Orchid\Layouts\job_title\job_titleFiltersLayout;
use App\Orchid\Layouts\job_title\job_titleListLayout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\job_title;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class job_titleListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'job_title' => job_title::filters()
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
        return __('jobtitle.list.title');
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return __('jobtitle.list.description');
    }

    /**
     * @return iterable|null
     */
    public function permission(): ?iterable
    {
        return [
            'platform.job_title',
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
                ->route('platform.job_title.create'),
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
            //job_titleFiltersLayout::class,
            job_titleListLayout::class,

            //Layout::modal('asyncEditjob_titleModal', job_titleEditLayout::class)
            //    ->async('asyncGetjob_title'),
        ];
    }

    /**
     * @param job_title $job_title
     *
     * @return array
     */
    public function asyncGetjob_title(job_title $job_title): iterable
    {
        return [
            'job_title' => $job_title,
        ];
    }

    /**
     * @param Request $request
     * @param job_title    $job_title
     */
    public function savejob_title(Request $request, job_title $job_title): void
    {
        /*$request->validate([
                               'user.email' => [
                                   'required',
                                   Rule::unique(User::class, 'email')->ignore($user),
                               ],
                           ]);*/

        $job_title->fill($request->input('job_title'))->save();

        Toast::info(__('job_title was saved.'));
    }

    /**
     * @param Request $request
     */
    public function remove(Request $request): void
    {
        job_title::findOrFail($request->get('id'))->delete();

        Toast::info(__('job_title was removed'));
    }
}
