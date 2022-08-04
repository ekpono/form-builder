<?php

namespace Shopceed\FormBuilder\Seeds;

use Illuminate\Database\Seeder;

class DefaultDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $defaultEmail = config('form-builder.default_email');
        $userModel = config('form-builder.user_model');

        if ( ! $userModel::where('email', $defaultEmail)->exist() ) {
            $this->call(UserSeeder::class);
        }

        $this->call(IdentitySeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(WorkspaceSeeder::class);
    }
}