<?php

namespace Shopceed\FormBuilder\Seeds;

use Shopceed\FormBuilder\Models\Identity;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class IdentitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $identityModel = config('form-builder.identity_model');

        if ( $identityModel::count() > 0 ) return;

        $userModel = config('form-builder.user_model');
        $defaultEmail = config('form-builder.default_email');
        $defaultEmail = $userModel::where('email', $defaultEmail)->first();

        $identityModel::create([
            "user_id" => $defaultEmail->id,
            "provider" => "Default Provider",
            "uid" => Uuid::uuid4(),
            "access_token" => null,
            "domain" => "exampledomain.net",
            "data" => '{"fake_attribute": "fake_value"}'
        ]);
    }
}
