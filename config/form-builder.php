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
    'middleware' => [
        'web',
        'auth',
        \Shopceed\FormBuilder\Http\Middleware\HandleInertiaRequests::class,
    ],
    'policies' => [
        \Shopceed\FormBuilder\Models\Form::class => \Shopceed\FormBuilder\Policies\FormPolicy::class,
        \Shopceed\FormBuilder\Models\Template::class => \Shopceed\FormBuilder\Policies\TemplatePolicy::class,
    ],
];
