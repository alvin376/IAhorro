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
    	
    	dd("asd");
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
