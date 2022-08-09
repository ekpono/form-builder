<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Uri
    |--------------------------------------------------------------------------
    |
    | This value is the name of your uri application. This is absolute
    | configurable as the path using your base url.
    | The default is form-builder e.g http://localhost/form-builder
    |
    */

    'path' => env('FORM_BUILDER_URL', 'form-builder'),

    /*
    |--------------------------------------------------------------------------
    | Default Callback Url
    |--------------------------------------------------------------------------
    |
    | This value takes the base url you would like to redirect to after
    | form builder page is exited. The url can be your base url or a total.
    | redirect to another application. Feel free to adjust!
    |
    */

    'callback_url' => env('FORM_BUILDER_CALLBACK', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | This package rely on your application's user model.
    | You can swap it to whatever model suites your needs.
    | However, the user model must be linked to an active table
    |
    */

    'user_model' => \App\Models\User::class,

    /*
    |--------------------------------------------------------------------------
    | Store Model
    |--------------------------------------------------------------------------
    |
    | The package relies on store model to exist with default fields
    | To get hold of the default fields, dig into the application default database
    | In future this will not be case
    |
    */

    'store_model' => Shopceed\FormBuilder\Models\Store::class,

    /*
    |--------------------------------------------------------------------------
    | Order Model
    |--------------------------------------------------------------------------
    |
    | The package relies on order model to exist with default fields
    | To get hold of the default fields, dig into the application default database
    | In future this will not be case
    |
    */

    'order_model' => Shopceed\FormBuilder\Models\Order::class,

    /*
    |--------------------------------------------------------------------------
    | File Model
    |--------------------------------------------------------------------------
    |
    | This file model is where you specify your model directory
    | In case you already have your internal file model, it is advised
    | to dig in to the default file migration to get a sense of what field you might add
    |
    */
    'file_model' => Shopceed\FormBuilder\Models\File::class,

    /*
    |--------------------------------------------------------------------------
    | Workspace Model
    |--------------------------------------------------------------------------
    |
    | For the purpose of extensibility, you can have different
    | workspace for your form builder. This helps create uniqueness.
    | You don't have to do anything as the defaults works.
    |
    */

    'workerspace_model' => Shopceed\FormBuilder\Models\Workspace::class,

    /*
    |--------------------------------------------------------------------------
    | Identity Model
    |--------------------------------------------------------------------------
    |
    | This model handles your store data e.g shopify, woocommerce
    | We understand this is a customer behavour so the default will serve your needs
    | If you don't have a store, the default works fine
    |
    */
    'identity_model' => Shopceed\FormBuilder\Models\Identity::class,


    /*
    |--------------------------------------------------------------------------
    | Form Model
    |--------------------------------------------------------------------------
    |
    | Form model holds your form data. The default that comes with the migrations
    | will likely serve your purpose but in case you want to change
    | to any other model.
    |
    |
    */
    'form_model' => Shopceed\FormBuilder\Models\Form::class,

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Here we register middlewares to use. Since the package relies on
    | Inertiajs (https://inertiajs.com/). We have the default
    | web, auth and Inertia request middleware added
    |
    */
    'middleware' => [
        'web',
        'auth',
        \Shopceed\FormBuilder\Http\Middleware\HandleInertiaRequests::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define default authentication guard for the package.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    */

    'default_middleware' => 'web',

    /*
    |--------------------------------------------------------------------------
    | Policy Guards
    |--------------------------------------------------------------------------
    |
    | Policies are great for organizing authorization logic around a model.
    | Feel free to write your policy class to control who has access
    | to what.
    |
    */

    'policies' => [
        \Shopceed\FormBuilder\Models\Form::class => \Shopceed\FormBuilder\Policies\FormPolicy::class,
    ],

    /*
     |--------------------------------------------------------------------------
     | Default User Email
     |--------------------------------------------------------------------------
     |
     | This is the admin user email that is used to seed the default data
     | that the application depend on.
     | Override the default email on different environments as it suites your needs
     |
     */
    'default_email' => env('FORM_BUILDER_DEFAULT_EMAIL', 'example@example.com'),

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the package. The "s3" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'file' => [
        'disk' => env('FILESYSTEM_DISK', 's3')
    ],

    'logo' => '/vendor/form-builder/images/logo.png',

    'company_logo' => '/vendor/form-builder/images/company-logo.png',

    'profile_picture' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
];
