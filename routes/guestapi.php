<?php

use Illuminate\Support\Facades\Route;
use Shopceed\FormBuilder\Http\Controllers\Api\FormAnswerController;

Route::post('form-answers/{formUuid}/{orderUuid}', [FormAnswerController::class, 'store'])
    ->name('form-answers.store');