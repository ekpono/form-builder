<?php

namespace Database\Seeders;

use Shopceed\FormBuilder\Models\Identity;
use App\Models\User;
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
        Identity::create([
            "user_id" => User::first()->id,
            "provider" => "Default Provider",
            "uid" => Uuid::uuid4(),
            "access_token" => null,
            "domain" => "exampledomain.net",
            "data" => '{"fake_attribute": "fake_value"}'
        ]);
    }
}
