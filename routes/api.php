<?php

use Shopceed\FormBuilder\Http\Controllers\Api\FormAnswerController;
use Illuminate\Support\Facades\Route;
use Shopceed\FormBuilder\Http\Controllers as RamarooControllers;

// Files
 Route::post('/files', [RamarooControllers\Api\FileController::class, 'store'])->name('files.store');

// API Resources
Route::apiResource('forms', RamarooControllers\Api\FormController::class);
