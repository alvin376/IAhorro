<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use App\Models\Employee;
use Validator;

class RecordController extends Controller
{
    /*
	 * Almacenamiento de Leads
	 * Encargado de guardar en BD los clientes que solicitan hipoteca
     */
    public function store(Request $request) {
    	$x ="asd";
    	$validateData = Validator::make($request->all(), [
            'full_name' => 'required|max:255',
    		'email' => 'required|email|max:255|unique:records',
    		'phone_number' => 'required|max:255',
    		'income' => 'required|Integer',
    		'requested_amount' => 'required|Integer',
    		'time_slot_start' => [
    			'required', 
    			'max:5', 
    			'regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/'
    		],
    		'time_slot_end' => ['required', 'max:5', 'regex:/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/']
        ]);

    	$validateData->after(function ($validator) use ($request){

    		$time_slot_start_minutes = self::time_to_minutes($request->time_slot_start);
    		$time_slot_end_minutes = self::time_to_minutes($request->time_slot_end);

    		if ( $time_slot_start_minutes > $time_slot_end_minutes ) {

		        $validator->errors()->add('time_slot_start', 'time_slot_start is greater than time_slot_end');
		    }elseif ( $time_slot_end_minutes - $time_slot_start_minutes < 60 ) {

		        $validator->errors()->add('Time slot', 'This time slot is lower than 1 hour');
		    }elseif ( $time_slot_end_minutes - $time_slot_start_minutes >= 480 ) {

		        $validator->errors()->add('Time slot', 'This time slot is greater than 8 hour');
		    }
		}); 

        if ($validateData->fails()) {
            return ['result' => false, 'status' => 'error_validate', 'description' => $validateData->errors()];
        }

    	$record = new Record();
    	$record->full_name = $request->full_name;
    	$record->email = $request->email;
    	$record->phone_number = $request->phone_number;
    	$record->income = $request->income;
    	$record->requested_amount = $request->requested_amount;
    	$record->employee_id = Employee::all()->random()->id;
    	$record->time_slot_start = self::time_to_minutes($request->time_slot_start);
    	$record->time_slot_end = self::time_to_minutes($request->time_slot_end);
    	$record->save();

    	return ['result' => true, 'status' => 'success'];
    }

    public function time_to_minutes($time) {

    	$time_array = explode(':',$time);
    	$minutes = ($time_array[0]*60)+$time_array[1];

    	return $minutes;
    }

    /* Calculo de Scoring 
	 * ( Cantidad solicitada / Ingresos Netos ) * Horas que lleva en el sistema "fecha y hora de registro a fecha hora actual".
     */
    public function scoring($record) {
		dd($record);
		$formula = $record->requested_amount;   	
    }


}
