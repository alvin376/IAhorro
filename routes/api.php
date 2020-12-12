<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\EmployeeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Registros de clientes */
Route::prefix('record')->group(function() {
	Route::post('store', [RecordController::class, 'store'])->name('record.store');
	Route::get('employee_id/{id}', [RecordController::class, 'getRecords'])->name('record.getRecords');
});

/* Expertos hipotecarios */
Route::prefix('employee')->group(function() {
	Route::get('getRecords/{employee_id}', [EmployeeController::class, 'getRecords'])->name('employee.getRecords');
});