<?php

namespace App\Http\View\Composers\Dashboard;

use Illuminate\View\View;
use Dashboard\Facades\Model;

class PermissionsComposer
{
    public function compose(View $view)
    {
        $view->with([
            'users' => Model::user()::all(),
            'permissions' => Model::permission()::all(),
        ]);
    }

}
