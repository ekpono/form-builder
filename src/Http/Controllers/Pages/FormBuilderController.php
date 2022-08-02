<?php

namespace Shopceed\FormBuilder\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Shopceed\FormBuilder\Models\File;
use Shopceed\FormBuilder\Models\Form;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FormBuilderController extends Controller
{
    /**
     * Replicate default form and redirect to new form builder page
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function index(Request $request)//: \Inertia\Response
    {
        $defaultForm = Form::first();
        $form = $defaultForm->replicate(['id']);
        $form->save();

        return Redirect::route('form.builder.show', $form->id);
    }

    /**
     * @param  Request  $request
     * @return \Inertia\Response
     */
    public function show(Request $request, Form $form): \Inertia\Response
    {
        $this->authorize('view', $form);

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
                }, File::where('store_id', '=', $form->store_id)
                    ->where('catalog', 'forms')
                    ->orderByDesc('created_at')
                    ->get()->toArray()),
            ]
        );
    }
}
