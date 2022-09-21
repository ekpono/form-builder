<?php

namespace Shopceed\FormBuilder\Http\Controllers\Api;

use App\Models\Invitation;
use App\Models\Order;
use Shopceed\FormBuilder\Http\Controllers\Controller;
use Shopceed\FormBuilder\Http\Requests\Form\FormAnswer\FormAnswerRequest;
use Shopceed\FormBuilder\Http\Resources\FormAnswerResource;
use Shopceed\FormBuilder\Models\FormAnswer;

class FormAnswerController extends Controller
{
    public function store(FormAnswerRequest $request, string $formUuid, string $orderUuid): FormAnswerResource
    {
        $data = $request->validated();

        $this->updateHasEngagedStatus($data, $orderUuid);

        $response = FormAnswer::updateOrCreate(
            ['form_uuid' => $formUuid, 'order_uuid' => $orderUuid],
            ['answers' => $data['answers'], 'order_items' => $data['order_items'], 'params' => 'params', 'finished_at' => isset($data['finished_at']) ? $data['finished_at'] : null]
        );

        return new FormAnswerResource($response);
    }

    /**
     * If this is the first time an api call is made on the form
     * update the has_engaged column 😊
     *
     * @param $data
     * @param $orderUuid
     */
    public function updateHasEngagedStatus($data, $orderUuid)
    {
        if ($this->isFirstAnswer($data)) {
            $order = Order::where('uuid', $orderUuid)->first();

            $invitation = Invitation::where('order_id', $order->id)->first();

            if ($invitation) {
                $invitation->update([
                    'has_engaged' => true
                ]);
            }
        }
    }

    /**
     * @param $data
     * @return bool
     */
    protected function isFirstAnswer($data): bool
    {
        return isset($data['answers']) && count($data['answers']) === 1;
    }
}
