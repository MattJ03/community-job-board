<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::post('/registerUser', [AuthController::class, 'registerUser']);
Route::post('/loginUser', [AuthController::class, 'loginUser']);
Route::post('/registerCompany', [CompanyController::class, 'registerCompany']);
Route::post('/loginCompany', [CompanyController::class, 'loginCompany']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/listingsIndex', [ListingController::class, 'availableListings']);
Route::delete('/deleteUser', [AuthController::class, 'deleteUser']);
});
