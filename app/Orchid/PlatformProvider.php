<?php

declare(strict_types=1);

namespace App\Orchid;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;
use App\Models\CpcnLang;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        //All lang in DB
        $all_langs = CpcnLang::select(['code', 'name', 'active'])->get()->toArray();
        Session::put('all_langs', $all_langs);
        //Only active lang
        $active_langs = CpcnLang::select(['code', 'name'])->where('active', 1)->get()->toArray();
        Session::put('active_langs', $active_langs);
        $Localization_menu = Menu::make('');
        $Localization_list = [];
        if(count($active_langs)>1){
            foreach ($active_langs as $id => $lang) {
                $Localization_list[] = Menu::make(mb_strtoupper($lang['code'])/*'UA'*/)->route('locale', $lang['code']);
            }
            $Localization_menu = Menu::make(__('mainMenu.Localization').' ('.App::getLocale().')')
                ->icon('globe')
                ->list($Localization_list);
        }

        $defaultMenu = [
            /*Menu::make('Example screen')
                ->icon('monitor')
                ->route('platform.example')
                ->title('Navigation')
                ->badge(fn () => 6),

            Menu::make('Dropdown menu')
                ->icon('code')
                ->list([
                    Menu::make('Sub element item 1')->icon('bag'),
                    Menu::make('Sub element item 2')->icon('heart'),
                ]),
*/
            /*            Menu::make('Basic Elements')
                            ->title('Form controls')
                            ->icon('note')
                            ->route('platform.example.fields'),

                        Menu::make('Advanced Elements')
                            ->icon('briefcase')
                            ->route('platform.example.advanced'),

                        Menu::make('Text Editors')
                            ->icon('list')
                            ->route('platform.example.editors'),

                      Menu::make('Overview layouts')
                            ->title('Layouts')
                            ->icon('layers')
                            ->route('platform.example.layouts'),
            /*
                        Menu::make('Chart tools')
                            ->icon('bar-chart')
                            ->route('platform.example.charts'),

                        Menu::make('Cards')
                            ->icon('grid')
                            ->route('platform.example.cards')
                            ->divider(),

                        Menu::make('Documentation')
                            ->title('Docs')
                            ->icon('docs')
                            ->url('https://orchid.software/en/docs'),

                        Menu::make('Changelog')
                            ->icon('shuffle')
                            ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
                            ->target('_blank')
                            ->badge(fn () => Dashboard::version(), Color::DARK()),*/

            Menu::make(__('mainMenu.admin.DB Manager'))
                ->icon('database')
                ->route('Capucin.TableList')
                ->permission('platform.systems.DBM')
                ->title(__('*** DB ***')),

            Menu::make(__('mainMenu.admin.Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('mainMenu.admin.Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),

            Menu::make(__('mainMenu.admin.Lang'))
                ->icon('yen')
                ->route('Capucin.LangList')
                ->permission('platform.systems.lang'),

        ];

        $MainMenu[] = $Localization_menu;
        include "../app/Orchid/CpnMenu.php";
        foreach ($cpnMenu as $menu){$MainMenu[] = $menu;}
        foreach ($defaultMenu as $menu){$MainMenu[] = $menu;}

        return $MainMenu;

    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make(__('Profile'))
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return include __DIR__."/registerPermissions.php";
        /*return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users'))
                ->addPermission('platform.systems.lang', __('Lang'))
                ->addPermission('platform.systems.DBM', __('DBM')),
        ];*/
    }
}
