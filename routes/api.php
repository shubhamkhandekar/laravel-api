<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\StudentController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post("login",[UserController::class,'index']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post("student-register",[StudentController::class,'create']);
    Route::get('/student/search/{name}', [StudentController::class, 'search']);
    Route::get('/student/searchwithpaginate/{name}', [StudentController::class, 'searchwithpaginate']);
    
});

