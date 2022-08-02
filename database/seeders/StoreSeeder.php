<?php

namespace Database\Seeders;

use App\Models\Store;
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
        Store::create([
            "workspace_id" => Workspace::first()->id,
            "identity_id" => Workspace::first()->id ,
            "domain" => "bovoba-testing.myshopify.com",
            "currency_code" => "USD",
            "has_sms" => false,
            "settings" => '{"unsubscribe_from_all_channels": true}'
        ]);
    }
}
