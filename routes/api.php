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
Route::prefix('records')->group(function() {
	Route::post('/', [RecordController::class, 'store'])->name('records.store');
});

/* Expertos hipotecarios */
Route::prefix('employees')->group(function() {
	Route::get('{employee_id}/records', [EmployeeController::class, 'getRecords'])->name('employees.records');
});