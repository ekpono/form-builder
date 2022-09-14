<?php

namespace Shopceed\FormBuilder\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'form-builder::app';

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => auth()->check() ? $request->user() : null,
            ],
            'path' => config('form-builder.path'),
            'config' => [
                'callback_url' => config('form-builder.callback_url'),
                'logo' => config('form-builder.logo'),
                'company_logo' => config('form-builder.company_logo'),
                'profile_picture' => config('form-builder.profile_picture'),
            ],
            'currentStore' => (auth()->check() ? $request->user()->currentStore()->with('identity')->first() : null),
        ]);
    }
}
