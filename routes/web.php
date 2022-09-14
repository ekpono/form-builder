<?php

namespace Shopceed\FormBuilder\HtppControllers;

use Illuminate\Support\Facades\Route;
use Shopceed\FormBuilder\Http\Controllers\Pages\FormBuilderController;
use Shopceed\FormBuilder\Http\Controllers\Pages\FormRunnerController;

Route::middleware(config('form-builder.default_middleware'))->group(function () {
    Route::get(config('form-builder.path'), [FormBuilderController::class, 'index'])->name('form.builder');
    Route::get(config('form-builder.path').'/{form}', [FormBuilderController::class, 'show'])->name('form.builder.show');
    Route::get(config('form-builder.path').'/form/{formUuid}/{orderUuid}', [FormRunnerController::class, 'show'])->name('form.show');
});

