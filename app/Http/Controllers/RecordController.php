<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use App\Models\Employee;
use Validator;
use App\Helpers\Util;
class RecordController extends Controller
{
    /*
	 * Almacenamiento de Leads
	 * Encargado de guardar en BD los clientes que solicitan hipoteca
     */
    public function store(Request $request) {

    	$record = new Record();
    	$record->full_name = $request->full_name;
    	$record->email = $request->email;
    	$record->phone_number = $request->phone_number;
    	$record->income = $request->income;
    	$record->requested_amount = $request->requested_amount;
    	$record->employee_id = Employee::all()->random()->id;
    	$record->time_slot_start = Util::time_to_minutes($request->time_slot_start);
    	$record->time_slot_end = Util::time_to_minutes($request->time_slot_end);
    	$record->save();

    	return ['result' => true, 'status' => 'success'];
    }
}
