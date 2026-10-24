<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::post('/registerUser', [AuthController::class, 'registerUser']);
Route::middleware('auth:api')->group(function () {

});
