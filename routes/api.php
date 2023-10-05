<?php

use App\Http\Controllers\EmployeesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::resource('employees', App\Http\Controllers\EmployeesController::class)->only(['index', 'store', 'show', 'update', 'destroy']);

Route::get('/get-employees', [EmployeesController::class, 'getEmployees']);
Route::get('/get-employee/{id}', [EmployeesController::class, 'show_employee']);
Route::post('/create-employee', [EmployeesController::class, 'storeEmployee']);
Route::put('/update-employee/{id}', [EmployeesController::class, 'update']);
Route::delete('/delete-employee/{id}', [EmployeesController::class, 'destroy']);
