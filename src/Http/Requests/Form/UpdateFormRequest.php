<?php

namespace Shopceed\FormBuilder\Http\Requests\Form;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Shopceed\FormBuilder\Models\Form;

class UpdateFormRequest extends FormRequest
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
            'name' => ['string', 'min:1'],
            'type' => ['string', Rule::in(Form::getTypes())],
            'category' => ['string', Rule::in(Form::getCategories())],
            'data' => ['array'], // todo: improve validation --> accepted variables
            'snapshot' => ['array'],
        ];
    }
}
