<?php

namespace Shopceed\FormBuilder\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Shopceed\FormBuilder\Models\Form;
use Shopceed\FormBuilder\Models\FormAnswer;
use Shopceed\FormBuilder\Models\Order;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FormRunnerController extends Controller
{
    /**
     * @param  Request  $request
     * @param  string  $formUuid
     * @param  string  $orderUuid
     * @return \Inertia\Response
     */
    public function show(Request $request, string $formUuid, string $orderUuid): \Inertia\Response
    {
        $form = Form::firstWhere('uuid', $formUuid);
        $order = Order::with('store')->firstWhere('uuid', $orderUuid);

        if ($form === null || $order === null) {
            throw new NotFoundHttpException();
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
}
