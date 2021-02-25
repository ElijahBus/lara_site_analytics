<?php

namespace App\Http\View\Composers\Dashboard;

use Illuminate\View\View;
use Dashboard\Facades\Model;

class RolesComposer
{
    public function compose(View $view)
    {
        $view->with([
            'users' => Model::user()::all(),
            'roles' => Model::role()::all(),
        ]);
    }
}
