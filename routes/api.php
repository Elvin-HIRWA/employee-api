<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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


Route::get('/employee', [EmployeeController::class, 'index']);
Route::post('/employee',[EmployeeController::class, 'store']);
Route::put('/employee/{id}',[EmployeeController::class, 'update']);
Route::delete('/employee/{id}',[EmployeeController::class, 'destroy']);
Route::get('/employee/{id}',[EmployeeController::class, 'show']);
Route::get('/employee/search/{name}',[EmployeeController::class, 'search']);


  Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});