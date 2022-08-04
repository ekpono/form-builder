<?php

namespace Shopceed\FormBuilder\Seeds;

use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $storeModel = config('form-builder.store_model');
        $userModel = config('form-builder.user_model');
        $user = $userModel::where('email', config('form-builder.default_email'))->first();
        $store = $storeModel::first();
        $formModel = config('form-builder.form_model');

        if ($formModel::count() > 0 ) return;

        $dataColumn = file_get_contents(__DIR__ . "/data/form_data_column.json");
        $snapShotColumn = file_get_contents(__DIR__ . "/data/form_snapshot_column.json");

        $formModel::create([
            "store_id" => $store->id,
            "user_id" => $user->id,
            "name" => "Default",
            "type" => "products",
            "category" => "pre_review",
            "data" => json_encode($dataColumn),
            "uuid" => Uuid::uuid4(),
            "snapshot" => json_encode($snapShotColumn)
        ]);
    }
}
