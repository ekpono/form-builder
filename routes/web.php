<?php

namespace Shopceed\FormBuilder\HtppControllers;

use Illuminate\Support\Facades\Route;
use Shopceed\FormBuilder\Http\Controllers\Pages\FormBuilderController;
use Shopceed\FormBuilder\Http\Controllers\Pages\FormRunnerController;

Route::get(config('form-builder.path'), [FormBuilderController::class, 'index'])
    ->name('form.builder')
    ->middleware(config('form-builder.default_middleware'));
Route::get(config('form-builder.path').'/{form}', [FormBuilderController::class, 'show'])
    ->name('form.builder.show')
    ->middleware(config('form-builder.default_middleware'));

Route::get(config('form-builder.path').'/form/{formUuid}/{orderUuid}', [FormRunnerController::class, 'show'])
    ->name('form.show')

    ->middleware(config('form-builder.default_middleware'));

