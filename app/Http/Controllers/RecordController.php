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
    	
    	$validateData = Validator::make($request->all(), [
            'full_name' => 'required|max:255',
    		'email' => 'required|email|max:255',
    		'phone_number' => 'required|max:255',
    		'income' => 'required|Integer',
    		'requested_amount' => 'required|Integer',
    		'time_slot_start' => 'required|max:255',
    		'time_slot_end' => 'required|max:255'
        ]);

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
    	$record->time_slot_start = $request->time_slot_start;
    	$record->time_slot_end = $request->time_slot_end;
    	$record->save();

    	return ['result' => true, 'status' => 'success'];
    }

    /* Calculo de Scoring 
	 * ( Cantidad solicitada / Ingresos Netos ) * Horas que lleva en el sistema "fecha y hora de registro a fecha hora actual".
     */
    public function scoring($record) {
		dd($record);
		$formula = $record->requested_amount;   	
    }


}
