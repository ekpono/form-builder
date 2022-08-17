<?php

namespace Shopceed\FormBuilder\Action;

use Ramsey\Uuid\Uuid;

class CreateForm
{
    public static function create($type, $category)
    {
        $formModel = config('form-builder.form_model');

        $dataColumn = file_get_contents(__DIR__ . "/../../database/seeds/data/form_data_column.json");
        $snapShotColumn = file_get_contents(__DIR__ . "/../../database/seeds/data/form_snapshot_column.json");

        return $formModel::create([
            "store_id" => auth()->user()->current_store_id,
            "user_id" => auth()->id(),
            "name" => "Form Builder -" . rand(10,100) ,
            "type" => $type,
            "category" => $category,
            "data" => json_decode($dataColumn, true),
            "uuid" => Uuid::uuid4(),
            "snapshot" => json_decode($snapShotColumn, true)
        ]);
    }
}