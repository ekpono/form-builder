<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'path' => env('FORM_BUILDER_URL', 'form-builder'),
    'callback_url' => env('FORM_BUILDER_CALLBACK', env('APP_URL', 'http://localhost')),
    'user_model' => \App\Models\User::class,
    'store_model' => Shopceed\FormBuilder\Models\Store::class,
    'order_model' => Shopceed\FormBuilder\Models\Order::class,
    'file_model' => Shopceed\FormBuilder\Models\File::class,
    'workerspace_model' => Shopceed\FormBuilder\Models\Workspace::class,
    'identity_model' => Shopceed\FormBuilder\Models\Identity::class,
    'form_model' => Shopceed\FormBuilder\Models\Form::class,
    'middleware' => [
        'web',
        'auth',
        \Shopceed\FormBuilder\Http\Middleware\HandleInertiaRequests::class,
    ],
    'policies' => [
        \Shopceed\FormBuilder\Models\Form::class => \Shopceed\FormBuilder\Policies\FormPolicy::class,
    ],
    'default_email' => env('FORM_BUILDER_DEFAULT_EMAIL', 'example@example.com')
];
