<?php

namespace Shopceed\FormBuilder\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormAnswer\FormAnswerRequest;
use App\Http\Resources\FormAnswerResource;
use App\Models\Form;
use App\Models\FormAnswer;
use Illuminate\Foundation\Http\FormRequest;

class FormAnswerController extends Controller
{
    public function store(FormAnswerRequest $request, string $formUuid, string $orderUuid): FormAnswerResource
    {
        $data = $request->validated();

        $fa = FormAnswer::where('form_uuid', $formUuid)
            ->where('order_uuid', $orderUuid)
            ->first();

        if ($fa === null) {
            return new FormAnswerResource(FormAnswer::create(array_merge(
                ['form_uuid' => $formUuid, 'order_uuid' => $orderUuid],
                $data
            )));
        }

        $fa->update($data);

        return new FormAnswerResource($fa);
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