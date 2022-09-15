<?php

namespace Shopceed\FormBuilder\Http\Controllers\Pages;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Shopceed\FormBuilder\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Shopceed\FormBuilder\Models\Form;
use Shopceed\FormBuilder\Models\FormAnswer;
use Shopceed\FormBuilder\Models\Order;

class FormRunnerController extends Controller
{
    /**
     * @param  Request  $request
     * @param  string  $formUuid
     * @param  string  $orderUuid
     */
    public function show(Request $request, string $formUuid, string $orderUuid)
    {
        // Redirect to preview mode
        if ($orderUuid === "{{current_order_id}}") {
            return $this->redirectToPreviewMode($formUuid);
        }

        $form = Form::firstWhere('uuid', $formUuid);
        $order = Order::with('store')->firstWhere('uuid', $orderUuid);

        if ($form === null || $order === null) {
            throw new ModelNotFoundException();
        }

        return Inertia::render(
            'FormRunner/Form',
            [
                'formCategories' => Form::getCategories(),
                'form' => $form,
                'order' => $order,
                'formsIdUuidMap' => Form::where('store_id', $form->store_id)
                    ->where('id', '!=', $form->id)
                    ->orderBy('id')
                    ->get(['id', 'uuid'])
                    ->groupBy('id')
                    ->map(function ($row) {
                        return $row->toArray()[0]['uuid'];
                    }),
                'formAnswers' => FormAnswer::where('form_uuid', $formUuid)
                    ->where('order_uuid', $orderUuid)
                    ->first(),
            ]
        );
    }

    private function redirectToPreviewMode($formUuid)
    {
        $form = Form::where('uuid', $formUuid)->first();

        return redirect(config('form-builder.path').'/'.$form->id .'?mode=preview');
    }
}
