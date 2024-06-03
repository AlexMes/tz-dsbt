<?php

namespace App\Http\Controllers;

use App\Models\register_events;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function RegisterEvents($register_events_id)
    {
        $register_event = register_events::select(
            'register_events.id as id',
            'structural_unit_from.name as unit_from', 'job_title_from.name as job_title_from', 'employee_from.name as employee_from',
            'structural_unit_to.name as unit_to', 'job_title_to.name as job_title_to', 'employee_to.name as employee_to',
            'register_events.date as date',
            'equipment_list.serial_number as serial_number',
            'equipment_list.inventory_number as inventory_number',
            'equipment_type.name as equipment_name',

        )
            ->leftJoin('employee as employee_from', 'register_events.from', 'employee_from.id')
            ->leftJoin('structural_unit as structural_unit_from', 'structural_unit_from.id', 'employee_from.structural_unit_id')
            ->leftJoin('job_title as job_title_from', 'job_title_from.id', 'employee_from.job_title_id')

            ->leftJoin('employee as employee_to', 'register_events.accepted', 'employee_to.id')
            ->leftJoin('structural_unit as structural_unit_to', 'structural_unit_to.id', 'employee_to.structural_unit_id')
            ->leftJoin('job_title as job_title_to', 'job_title_to.id', 'employee_to.job_title_id')

            ->leftJoin('equipment_list', 'equipment_list.id', 'register_events.equipment_id')
            ->leftJoin('equipment_type', 'equipment_list.equipment_type_id', 'equipment_type.id')

            ->Where('register_events.id', $register_events_id)

            ->get()
            ->toArray()
            ;

        //dd($register_event);

        return view('print.register_event', ['register_event' => $register_event[0]]);

    }
}
