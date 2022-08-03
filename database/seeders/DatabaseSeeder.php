<?php

namespace Shopceed\FormBuilder\Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
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