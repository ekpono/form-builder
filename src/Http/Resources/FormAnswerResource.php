<?php

namespace Shopceed\FormBuilder\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FormAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
