<?php

namespace Shopceed\FormBuilder\Http\Controllers\Api;

use Ramsey\Uuid\Uuid;
use Shopceed\FormBuilder\Http\Controllers\Controller;
use Shopceed\FormBuilder\Http\Requests\Form\FormAnswer\FormAnswerRequest;
use Shopceed\FormBuilder\Http\Resources\FormAnswerResource;
use Shopceed\FormBuilder\Models\Form;
use Shopceed\FormBuilder\Models\FormAnswer;
use Illuminate\Foundation\Http\FormRequest;

class FormAnswerController extends Controller
{
    public function store(FormAnswerRequest $request, string $formUuid, string $orderUuid): FormAnswerResource
    {
        $data = $request->validated();

        $response = FormAnswer::updateOrCreate(
            ['form_uuid' => $formUuid, 'order_uuid' => $orderUuid],
            ['answers' => $data['answers'], 'order_items' => $data['order_items'], 'params' => 'params']
        );

        return new FormAnswerResource($response);
    }

    /**
     * TODO remove on prod it's just for testing
     *
     * @param  FormRequest  $request
     * @param  Form  $form
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAll(Form $form)
    {
        FormAnswer::where('form_uuid', $form->uuid)->delete();

        return response()->json('OK');
    }
}
