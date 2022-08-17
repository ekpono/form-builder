<?php

namespace Shopceed\FormBuilder\Http\Controllers\Pages;

use Shopceed\FormBuilder\Action\CreateForm;
use Shopceed\FormBuilder\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Shopceed\FormBuilder\Models\File;
use Shopceed\FormBuilder\Models\Form;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FormBuilderController extends Controller
{
    /**
     * Replicate default form and redirect to new form builder page
     *
     * @param  Request  $request
     */
    public function index(Request $request)
    {
        if ( ! auth()->check() ) {
            abort(403, 'Unauthorized');
        }

        $type = $request->query('type') ?? 'products';
        $category = $request->query('category') ?? 'review';

        $form = CreateForm::create($type, $category);

        return Redirect::route('form.builder.show', $form->id);
    }

    /**
     * @param  Request  $request
     * @return \Inertia\Response
     */
    public function show(Request $request, Form $form): \Inertia\Response
    {
        $this->authorize('view', $form);

        $fileModel = config('form-builder.file_model');

        return Inertia::render(
            'FormBuilder/Form',
            [
                'formCategories' => Form::getCategories(),
                'form' => $form,
                'forms' => Form::where('user_id', $request->user()->id)
                    ->where('store_id', $form->store_id)
                    ->where('id', '!=', $form->id)
                    ->with('user')
                    ->orderBy('id')
                    ->get(),
                'files' => array_map(function ($file) {
                    return "$file[path].$file[extension]";
                }, $fileModel::where('store_id', '=', $form->store_id)
                    ->where('catalog', 'forms')
                    ->orderByDesc('created_at')
                    ->get()->toArray()),
            ]
        );
    }
}
