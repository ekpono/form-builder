<?php

namespace Shopceed\FormBuilder\Http\Controllers\Pages;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Shopceed\FormBuilder\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Shopceed\FormBuilder\Models\Form;
use Shopceed\FormBuilder\Models\FormAnswer;
use Shopceed\FormBuilder\Models\Order;
use Shopceed\FormBuilder\Models\Product;

class FormRunnerController extends Controller
{
    private $order;

    private $form;

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

        $form->data = $this->assignMergeTags($form, $order);

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

    private function assignMergeTags($form, $order)
    {
        $this->order = $order;
        $this->form = $form;

        $m = new \Mustache_Engine(['entity_flags' => ENT_QUOTES]);

        $context = [
            'customer' => [
                'first_name' => $this->getVariableValue('customer.first_name'),
                'last_name' => $this->getVariableValue('customer.last_name'),
                'full_name' => $this->getVariableValue('customer.full_name'),
                'email' => $this->getVariableValue('customer.email'),
            ],
            'order' => [
                'total_price' => $this->getVariableValue('total_price'),
                'number' => $this->getVariableValue('number'),
                'line_items_count' => $this->getVariableValue('line_items_count'),
            ],
            'products' => [
                'name' => $this->productName(),
            ],
        ];

        $data = $m->render(json_encode($form->data), $context);

        return json_decode($data, true);
    }

    private function getVariableValue($variableName)
    {
        // Retrieve a single product from line_items
        if (Str::startsWith($variableName, 'product.')) {
            $key = 'line_items.0.'.str_replace('product.', '', $variableName);

            return Arr::get($this->order->data, $key);
        }

        return Arr::get(json_decode($this->order->data, true), $variableName);
    }

    private function productName()
    {
        $productNames = Arr::pluck($this->getProducts(), 'name');

        if (empty($productNames)) {
            return 'No product';
        }

        $totalProductCount = count($this->getProducts());

        if ($totalProductCount === 1) {
            return $productNames[0];
        }

        if ($totalProductCount === 2) {
            return $productNames[0].' and '.$productNames[1];
        }

        return $productNames[0].'and'.$totalProductCount.'others';
    }

    private function getProducts(): array
    {
        $lineItems = $this->getVariableValue('line_items');
        $externalIds = collect($lineItems)->pluck('external_product_id')->all();

        return Product::select('name', 'data->image as image')
            ->where('store_id', $this->order->store_id)
            ->whereIn('external_id', $externalIds)
            ->get()
            ->toArray();
    }
}