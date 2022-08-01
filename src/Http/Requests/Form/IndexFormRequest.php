<?php

namespace Shopceed\FormBuilder\Http\Requests\Form;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Shopceed\FormBuilder\Models\Form;

class IndexFormRequest extends FormRequest
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
            'current_store_id' => ['required', 'numeric'],
            'type' => ['string', Rule::in(Form::getTypes())],
            'category' => ['string', Rule::in(Form::getCategories())],
        ];
    }
}
