<?php

namespace Database\Seeders;

use App\Models\User;
use Shopceed\FormBuilder\Models\Workspace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Workspace::create([
            "user_id" => User::first()->id,
            "name" => Workspace::DEFAULT_NAME
        ]);
    }
}
