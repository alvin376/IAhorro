<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\EmployeeHelper;

class EmployeeController extends Controller
{
    public function getRecords($employee_id) {
    	return EmployeeHelper::getRecords($employee_id);
    }
}
