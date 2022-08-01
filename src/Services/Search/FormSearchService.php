<?php

namespace Shopceed\FormBuilder\Services\Search;

use Shopceed\FormBuilder\Models\Form;

class FormSearchService
{
    protected $query;

    protected $data;

    public function __construct()
    {
        $this->query = Form::query();
    }

    public function search(array $data): \Illuminate\Database\Eloquent\Builder
    {
        $this->data = $data;

        // Required fields
        $this->query->where('store_id', $data['current_store_id']);

        if (isset($this->data['type'])) {
            $this->filterType();
        }

        if (isset($this->data['category'])) {
            $this->filterCategory();
        }

        return $this->query;
    }

    private function filterType()
    {
        $this->query->where('type', $this->data['type']);
    }

    private function filterCategory()
    {
        $this->query->where('category', $this->data['category']);
    }
}
