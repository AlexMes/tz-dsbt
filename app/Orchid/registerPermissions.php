<?php

        use Orchid\Platform\ItemPermission;

         return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users'))
                ->addPermission('platform.systems.lang', __('Lang'))
                ->addPermission('platform.systems.DBM', __('DBManager'))
                ->addPermission('platform.structural_unit', __('structuralunit.list.title'))
            ->addPermission('platform.equipment_type', __('equipmenttype.list.title'))
            ->addPermission('platform.equipment_list', __('equipmentlist.list.title'))
            ->addPermission('platform.job_title', __('jobtitle.list.title'))
            ->addPermission('platform.employee', __('employee.list.title'))
            ->addPermission('platform.register_events', __('registerevents.list.title'))
            ,
];
