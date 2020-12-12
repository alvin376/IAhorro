<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Validator;
use DB;

class EmployeeController extends Controller
{
    public function getRecords($employee_id) {
    	$current_minutes = self::get_current_minutes();

    	// dd($current_minutes);
    	$employee = Employee::findOrFail($employee_id);
    	$records = $employee->records()
    				->select(
    					'id',
    					'full_name',
    					'email',
    					'phone_number',
    					'income',
    					'requested_amount',
    					'time_slot_start',
    					'time_slot_end',
    					DB::raw('(requested_amount/income)* TIMESTAMPDIFF(HOUR,created_at,CURRENT_TIMESTAMP) as scoring') 
    				)
    				->where([
    					['time_slot_start','<=', $current_minutes],
    					['time_slot_end','>', $current_minutes]
    				])
    				->orderBy('scoring', 'desc')
    				->get();
    	// dd($records);
    	return $records;
    }

    public function get_current_minutes() {

    	$current_time = explode(':', date('H:i'));
    	$minutes = ($current_time[0]*60)+$current_time[1];

    	return $minutes;
    }
}
