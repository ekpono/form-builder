<?php

namespace Shopceed\FormBuilder\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'extension' => ['string', 'required', 'min:2'],
            'contentType' => ['string', 'required'],
            'path' => ['required', 'string', 'min:1'],
            'catalog' => ['required', 'string', 'min:1'],
        ];
    }
}
