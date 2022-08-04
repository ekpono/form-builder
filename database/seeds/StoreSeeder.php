<?php

namespace Shopceed\FormBuilder\Seeds;

use Shopceed\FormBuilder\Models\Store;
use Shopceed\FormBuilder\Models\Workspace;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workspaceModel = config('form-builder.workerspace_model');
        $storeModel = config('form-builder.store_model');

        if ( $storeModel::count() > 0 ) return;

        $storeModel::create([
            "workspace_id" => $workspaceModel::first()->id,
            "identity_id" => $workspaceModel::first()->id ,
            "domain" => "bovoba-testing.myshopify.com",
            "currency_code" => "USD",
            "has_sms" => false,
            "settings" => '{"unsubscribe_from_all_channels": true}'
        ]);
    }
}
