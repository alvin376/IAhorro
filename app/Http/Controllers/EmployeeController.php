<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Validator;
use DB;

class EmployeeController extends Controller
{
    public function getRecords($employee_id) {
    	
    	$employee = Employee::find($employee_id);
    	$records = $employee->records()
    				->select('id', 'full_name', 'email', 'num_phone', 'net_income', 'requested_amount', DB::raw('(requested_amount/net_income)* TIMESTAMPDIFF(HOUR,created_at,CURRENT_TIMESTAMP) as scoring') )->orderBy('scoring', 'desc')->get();

    	return $records;
    }
}
