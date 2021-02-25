<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Dashboard\Http\Controllers\Controller as ControllersController;

class ReportController extends ControllersController
{
    public function index()
    {
        return view('dashboard::assets.reports');
    }
}
