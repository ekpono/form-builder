<?php

namespace Shopceed\FormBuilder\Seeds;

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

        $formModel::create([
            "store_id" => $store->id,
            "user_id" => $user->id,
            "name" => "Default",
            "type" => "products",
            "category" => "pre_review",
            "data" => '{"typs":[{"id":"42ebd73a-3cb3-401d-a76b-3376c62a90f9","title":"Thank you for your feedback","properties":[]}],"logic":[],"kick_offs":[{"id":"39e69fff-d1d3-4623-a690-b5876b00f011","type":"yes_no","title":"Are you ready to review your recent purchases?","properties":{"choices":[{"id":"d4848a88-b266-4f59-9fc2-84d89c0c3da6","label":"Yes"},{"id":"8f7b5064-b1d2-49eb-b24d-a288c1d57799","label":"No"}]}}],"follow_ups":[{"id":"cb8e4907-53fe-4bc4-83e2-da1754b0ea9e","type":"open","title":"Are you satisfied with your purchase?","properties":{"placeholder":"Staring problem"}}],"allow_users_files":false}',
            "uuid" => Uuid::uuid4(),
            "snapshot" => '{"typs": [{"id": "42ebd73a-3cb3-401d-a76b-3376c62a90f9", "title": "Thank you for your feedback", "properties": []}], "logic": [], "kick_offs": [{"id": "39e69fff-d1d3-4623-a690-b5876b00f011", "type": "yes_no", "title": "Are you ready to review your recent purchases?", "properties": {"choices": [{"id": "d4848a88-b266-4f59-9fc2-84d89c0c3da6", "label": "Yes"}, {"id": "8f7b5064-b1d2-49eb-b24d-a288c1d57799", "label": "No"}]}}], "follow_ups": [{"id": "cb8e4907-53fe-4bc4-83e2-da1754b0ea9e", "type": "open", "title": "Are you satisfied with your purchase?", "properties": {"placeholder": "Staring problem"}}], "allow_users_files": false}'
        ]);
    }
}
