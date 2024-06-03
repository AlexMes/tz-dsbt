<?php

use Tabuna\Breadcrumbs\Trail;



//----------------------------------------------------------------------------------------------------------------------
/* */
// Platform > structural_unit
Route::screen('structural_unit/{structural_unit}/edit', App\Orchid\Screens\structural_unit\structural_unitEditScreen::class)
    ->name('platform.structural_unit.edit')
    ->breadcrumbs(fn (Trail $trail, $structural_unit) => $trail
        ->parent('platform.structural_unit')
        ->push(__('structuralunit.list.title'), route('platform.structural_unit.edit', $structural_unit)));

// Platform > structural_unit > Create
Route::screen('structural_unit/create', App\Orchid\Screens\structural_unit\structural_unitEditScreen::class)
    ->name('platform.structural_unit.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.structural_unit')
        ->push(__('Create'), route('platform.structural_unit.create')));


// Platform > structural_unit > structural_unit
Route::screen('structural_unit', App\Orchid\Screens\structural_unit\structural_unitListScreen::class)
    ->name('platform.structural_unit')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('structuralunit.list.title'), route('platform.structural_unit')));


//----------------------------------------------------------------------------------------------------------------------
/* */
// Platform > equipment_type
Route::screen('equipment_type/{equipment_type}/edit', App\Orchid\Screens\equipment_type\equipment_typeEditScreen::class)
    ->name('platform.equipment_type.edit')
    ->breadcrumbs(fn (Trail $trail, $equipment_type) => $trail
        ->parent('platform.equipment_type')
        ->push(__('equipmenttype.list.title'), route('platform.equipment_type.edit', $equipment_type)));

// Platform > equipment_type > Create
Route::screen('equipment_type/create', App\Orchid\Screens\equipment_type\equipment_typeEditScreen::class)
    ->name('platform.equipment_type.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.equipment_type')
        ->push(__('Create'), route('platform.equipment_type.create')));


// Platform > equipment_type > equipment_type
Route::screen('equipment_type', App\Orchid\Screens\equipment_type\equipment_typeListScreen::class)
    ->name('platform.equipment_type')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('equipmenttype.list.title'), route('platform.equipment_type')));


//----------------------------------------------------------------------------------------------------------------------
/* */
// Platform > equipment_list
Route::screen('equipment_list/{equipment_list}/edit', App\Orchid\Screens\equipment_list\equipment_listEditScreen::class)
    ->name('platform.equipment_list.edit')
    ->breadcrumbs(fn (Trail $trail, $equipment_list) => $trail
        ->parent('platform.equipment_list')
        ->push(__('equipmentlist.list.title'), route('platform.equipment_list.edit', $equipment_list)));

// Platform > equipment_list > Create
Route::screen('equipment_list/create', App\Orchid\Screens\equipment_list\equipment_listEditScreen::class)
    ->name('platform.equipment_list.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.equipment_list')
        ->push(__('Create'), route('platform.equipment_list.create')));


// Platform > equipment_list > equipment_list
Route::screen('equipment_list', App\Orchid\Screens\equipment_list\equipment_listListScreen::class)
    ->name('platform.equipment_list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('equipmentlist.list.title'), route('platform.equipment_list')));


//----------------------------------------------------------------------------------------------------------------------
/* */
// Platform > equipment_list
Route::screen('equipment_list/{equipment_list}/edit', App\Orchid\Screens\equipment_list\equipment_listEditScreen::class)
    ->name('platform.equipment_list.edit')
    ->breadcrumbs(fn (Trail $trail, $equipment_list) => $trail
        ->parent('platform.equipment_list')
        ->push(__('equipmentlist.list.title'), route('platform.equipment_list.edit', $equipment_list)));

// Platform > equipment_list > Create
Route::screen('equipment_list/create', App\Orchid\Screens\equipment_list\equipment_listEditScreen::class)
    ->name('platform.equipment_list.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.equipment_list')
        ->push(__('Create'), route('platform.equipment_list.create')));


// Platform > equipment_list > equipment_list
Route::screen('equipment_list', App\Orchid\Screens\equipment_list\equipment_listListScreen::class)
    ->name('platform.equipment_list')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('equipmentlist.list.title'), route('platform.equipment_list')));


//----------------------------------------------------------------------------------------------------------------------
/* */
// Platform > job_title
Route::screen('job_title/{job_title}/edit', App\Orchid\Screens\job_title\job_titleEditScreen::class)
    ->name('platform.job_title.edit')
    ->breadcrumbs(fn (Trail $trail, $job_title) => $trail
        ->parent('platform.job_title')
        ->push(__('jobtitle.list.title'), route('platform.job_title.edit', $job_title)));

// Platform > job_title > Create
Route::screen('job_title/create', App\Orchid\Screens\job_title\job_titleEditScreen::class)
    ->name('platform.job_title.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.job_title')
        ->push(__('Create'), route('platform.job_title.create')));


// Platform > job_title > job_title
Route::screen('job_title', App\Orchid\Screens\job_title\job_titleListScreen::class)
    ->name('platform.job_title')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('jobtitle.list.title'), route('platform.job_title')));


//----------------------------------------------------------------------------------------------------------------------
/* */
// Platform > employee
Route::screen('employee/{employee}/edit', App\Orchid\Screens\employee\employeeEditScreen::class)
    ->name('platform.employee.edit')
    ->breadcrumbs(fn (Trail $trail, $employee) => $trail
        ->parent('platform.employee')
        ->push(__('employee.list.title'), route('platform.employee.edit', $employee)));

// Platform > employee > Create
Route::screen('employee/create', App\Orchid\Screens\employee\employeeEditScreen::class)
    ->name('platform.employee.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.employee')
        ->push(__('Create'), route('platform.employee.create')));


// Platform > employee > employee
Route::screen('employee', App\Orchid\Screens\employee\employeeListScreen::class)
    ->name('platform.employee')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('employee.list.title'), route('platform.employee')));


//----------------------------------------------------------------------------------------------------------------------
/* */
// Platform > employee
Route::screen('employee/{employee}/edit', App\Orchid\Screens\employee\employeeEditScreen::class)
    ->name('platform.employee.edit')
    ->breadcrumbs(fn (Trail $trail, $employee) => $trail
        ->parent('platform.employee')
        ->push(__('employee.list.title'), route('platform.employee.edit', $employee)));

// Platform > employee > Create
Route::screen('employee/create', App\Orchid\Screens\employee\employeeEditScreen::class)
    ->name('platform.employee.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.employee')
        ->push(__('Create'), route('platform.employee.create')));


// Platform > employee > employee
Route::screen('employee', App\Orchid\Screens\employee\employeeListScreen::class)
    ->name('platform.employee')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('employee.list.title'), route('platform.employee')));


//----------------------------------------------------------------------------------------------------------------------
/* */
// Platform > register_events
Route::screen('register_events/{register_events}/edit', App\Orchid\Screens\register_events\register_eventsEditScreen::class)
    ->name('platform.register_events.edit')
    ->breadcrumbs(fn (Trail $trail, $register_events) => $trail
        ->parent('platform.register_events')
        ->push(__('registerevents.list.title'), route('platform.register_events.edit', $register_events)));

// Platform > register_events > Create
Route::screen('register_events/create', App\Orchid\Screens\register_events\register_eventsEditScreen::class)
    ->name('platform.register_events.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.register_events')
        ->push(__('Create'), route('platform.register_events.create')));


// Platform > register_events > register_events
Route::screen('register_events', App\Orchid\Screens\register_events\register_eventsListScreen::class)
    ->name('platform.register_events')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('registerevents.list.title'), route('platform.register_events')));

