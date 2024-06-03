<?php

use Orchid\Screen\Actions\Menu;

return $cpnMenu = [

    Menu::make(__('structuralunit.list.title'))
        ->icon('note')
        ->route('platform.structural_unit')
        ->permission('platform.structural_unit'),
        //->title('Navigation')
        //->badge(fn () => 6),

    Menu::make(__('equipmenttype.list.title'))
        ->icon('note')
        ->route('platform.equipment_type')
        ->permission('platform.equipment_type'),
        //->title('Navigation')
        //->badge(fn () => 6),

    Menu::make(__('equipmentlist.list.title'))
        ->icon('note')
        ->route('platform.equipment_list')
        ->permission('platform.equipment_list'),
        //->title('Navigation')
        //->badge(fn () => 6),

    Menu::make(__('jobtitle.list.title'))
        ->icon('note')
        ->route('platform.job_title')
        ->permission('platform.job_title'),
        //->title('Navigation')
        //->badge(fn () => 6),

    Menu::make(__('employee.list.title'))
        ->icon('note')
        ->route('platform.employee')
        ->permission('platform.employee'),
        //->title('Navigation')
        //->badge(fn () => 6),

    Menu::make(__('registerevents.list.title'))
        ->icon('note')
        ->route('platform.register_events')
        ->permission('platform.register_events'),
        //->title('Navigation')
        //->badge(fn () => 6),

];
