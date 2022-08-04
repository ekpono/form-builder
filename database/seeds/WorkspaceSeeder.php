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
        $workspaceModel = config('form-builder.workerspace_model');

        if ($workspaceModel::count() > 0 ) return;

        $workspaceModel::create([
            "user_id" => User::first()->id,
            "name" => $workspaceModel::DEFAULT_NAME
        ]);
    }
}
