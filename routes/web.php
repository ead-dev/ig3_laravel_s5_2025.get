<?php

use App\Orchid\Screens\TaskScreen;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\MenuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[TestController::class,'index']);

Route::get('/repas',[TestController::class,'getRepas']);

Route::get('/menu',[MenuController::class,'index']);

Route::get('/menu/create',[MenuController::class,'create']);
Route::get('/menu/{id}',[MenuController::class,'show']);
Route::get('/menu/disable/{id}',[MenuController::class,'disable']);
Route::get('/menu/enable/{id}',[MenuController::class,'enable']);

Route::post('/menu/{id}/update',[MenuController::class,'update']);

Route::get('/menu/edit/{id}',[MenuController::class,'edit']);

Route::post('/menu',[MenuController::class,'store']);



