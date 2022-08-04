<?php

namespace Shopceed\FormBuilder\Seeds;

use App\Models\User;
use Shopceed\FormBuilder\Models\Workspace;
use Illuminate\Database\Seeder;

class WorkspaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Workspace::count() > 0 ) return;

        Workspace::create([
            "user_id" => User::first()->id,
            "name" => Workspace::DEFAULT_NAME
        ]);
    }
}
