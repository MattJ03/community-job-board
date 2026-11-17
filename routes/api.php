<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ListingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndustryController;

Route::post('/registerUser', [AuthController::class, 'registerUser']);
Route::post('/loginUser', [AuthController::class, 'loginUser']);
Route::post('/registerCompany', [CompanyController::class, 'registerCompany']);
Route::post('/loginCompany', [CompanyController::class, 'loginCompany']);
Route::post('/storeCompanyLogo', [CompanyController::class, 'storeCompanyLogo']);
Route::get('/me', [AuthController::class, 'me']);
Route::get('/allIndustries', [IndustryController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/listingsIndex', [ListingController::class, 'availableListings']);
    Route::get('showListing/{listing}', [ListingController::class, 'showListing']);
    Route::post('/storeListing', [ListingController::class, 'storeListing']);
    Route::put('/updateListing/{listing}', [ListingController::class, 'updateListing']);
    Route::post('/logoutUser', [AuthController::class, 'logout']);
    Route::delete('/deleteListing/{listing}', [ListingController::class, 'deleteListing']);
    Route::put('/storePreferredIndustries', [IndustryController::class, 'storePreferredIndustries']);
Route::delete('/deleteUser', [AuthController::class, 'deleteUser']);
});
