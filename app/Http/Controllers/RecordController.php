<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\RecordHelper;

class RecordController extends Controller
{
    
    public function store(Request $request) {
    	return RecordHelper::store($request);
    }
}
