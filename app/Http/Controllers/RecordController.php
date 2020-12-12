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
    		'num_phone' => 'required|max:255',
    		'net_income' => 'required|Integer',
    		'requested_amount' => 'required|Integer'
        ]);

        if ($validateData->fails()) {
            return ['result' => false, 'status' => 'error_validate', 'description' => $validateData->errors()];
        }

    	$record = new Record();
    	$record->full_name = $request->full_name;
    	$record->email = $request->email;
    	$record->num_phone = $request->num_phone;
    	$record->net_income = $request->net_income;
    	$record->requested_amount = $request->requested_amount;
    	$record->employee_id = Employee::all()->random()->id;
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
