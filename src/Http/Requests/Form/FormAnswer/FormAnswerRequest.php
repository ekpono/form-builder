<?php

namespace Shopceed\FormBuilder\Http\Requests\Form\FormAnswer;

use Illuminate\Foundation\Http\FormRequest;

class FormAnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'answers' => ['required', 'array'],
            'order_items' => ['array'],
            'params' => [],
            'finished_at' => ['nullable', 'date'],
        ];
    }
}
