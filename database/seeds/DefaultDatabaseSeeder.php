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
        $this->call(IdentitySeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(WorkspaceSeeder::class);
    }
}