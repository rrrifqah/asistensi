<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MedicineController;

Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('medicines', MedicineController::class);