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
        $userModel = config('form-builder.user_model');
        $userId = $userModel::where('email', config('form-builder.default_email'));

        if ($workspaceModel::count() > 0 ) return;

        $workspaceModel::create([
            "user_id" => $userId,
            "name" => $workspaceModel::DEFAULT_NAME
        ]);
    }
}
