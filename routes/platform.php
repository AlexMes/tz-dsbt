<?php

declare(strict_types=1);

use App\Models\CpcnTables;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Tabuna\Breadcrumbs\Trail;
use App\Orchid\Screens\Capucin\TableListScreen;
use App\Orchid\Screens\Capucin\TableEditScreen;
use App\Orchid\Screens\Capucin\FieldEditScreen;
use App\Orchid\Screens\Capucin\LangListScreen;
use App\Orchid\Screens\Capucin\LangEditScreen;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Localization
Route::get(
    'locale/{lang}',function ($lang) {Session::put('locale', $lang);return redirect()->back();})->name('locale');
// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push(__('User'), route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Role'), route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example screen'));

Route::screen('example-fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('example-layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('example-charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('example-editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('example-cards', ExampleCardsScreen::class)->name('platform.example.cards');
Route::screen('example-advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');

//Route::screen('idea', Idea::class, 'platform.screens.idea');
//Capucin    ********************************************************************************************************
//Capucin > Table List
Route::screen('DBManager', TableListScreen::class)
    ->name('Capucin.TableList')
    ->breadcrumbs(fn (Trail $trail) => $trail
        //->parent('DBManager')
        ->push(__('DBManager'), route('Capucin.TableList')));

// Capucin > Table List > Create
Route::screen('DBManager/table/create', TableEditScreen::class)
    ->name('Capucin.TableList.table.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('Capucin.TableList')
        ->push(__('Create Table'), route('Capucin.TableList')));

// Capucin > Table List > Table > Edit
Route::screen('DBManager/table/{table}/edit', TableEditScreen::class)
    ->name('Capucin.TableList.table.edit')
    ->breadcrumbs(fn (Trail $trail, $table) => $trail
        ->parent('Capucin.TableList')
        ->push(__('Table'), route('Capucin.TableList.table.edit', ['table' => $table]) ) );

// Capucin > Table List > Table >  Edit > Field > Create
Route::screen('DBManager/table/{table}/field/create', FieldEditScreen::class)
    ->name('Capucin.TableList.table.field.create')
    ->breadcrumbs(fn (Trail $trail, $table) => $trail
        ->parent('Capucin.TableList.table.edit', $table)
        ->push(__('Create Field'), route('Capucin.TableList.table.field.create', ['table' => $table])));

// Capucin > Table List > Table >  Edit > Field > Edit
Route::screen('DBManager/table/{table}/field/{field}/edit', FieldEditScreen::class)
    ->name('Capucin.TableList.table.field.edit')
    ->breadcrumbs(fn (Trail $trail, $table, $field) => $trail
        ->parent('Capucin.TableList.table.edit', $table)
        ->push(__('Field'), route('Capucin.TableList.table.field.edit', ['table' => $table, 'field' => $field])));


//  Langs  ********************************************************************************************************
//Capucin > Langs List
Route::screen('Lang', LangListScreen::class)
    ->name('Capucin.LangList')
    ->breadcrumbs(fn (Trail $trail) => $trail
        //->parent('DBManager')
        ->push(__('LangList'), route('Capucin.LangList')));

// Capucin > Langs List > Create
Route::screen('Lang/create', LangEditScreen::class)
    ->name('Capucin.LangList.lang.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('Capucin.LangList')
        ->push(__('Create'), route('Capucin.LangList')));

// Capucin > Langs List > Table
Route::screen('Lang/{lang}/edit', LangEditScreen::class)
    ->name('Capucin.LangList.lang.edit')
    ->breadcrumbs(fn (Trail $trail, $lang) => $trail
        ->parent('Capucin.LangList')
        ->push(__('Edit'), route('Capucin.LangList', $lang)));

//  Content  ********************************************************************************************************

include __DIR__."/cpn.php";

/*Route::screen('table1/{user}/edit', Table1EditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.table1')
        ->push(__('User'), route('platform.systems.table1.edit', $user)));*/

// Platform > System > Users > Create
/*Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));*/


// --- Next route ---


