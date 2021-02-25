<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Dashboard\Facades\Model;
use Dashboard\Traits\ModelsDefinition;
use Dashboard\Http\Controllers\Controller;

class HomeController extends Controller
{
    use ModelsDefinition;

    /**
     * Display the list of resources of the dashbard's welcome page
     *
     * @return void
     */
    public function index()
    {
        // dd(Model::user() instanceof User);
        return view('dashboard::assets.home');
    }
}
