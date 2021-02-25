<?php

namespace App\Http\View\Composers\Dashboard;

use Illuminate\View\View;
use Dashboard\Facades\Model;

class TosComposer
{
    public function compose(View $view)
    {
        $view->with([
            'toss' => Model::tos()::all(),
        ]);
    }
}
