<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Validator;
use DB;
use App\Helpers\Util;

class EmployeeController extends Controller
{
    public function getRecords($employee_id) {
    	$current_minutes = Util::time_to_minutes(date('H:i'));
    	
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

    	return $records;
    }
}
