<?php

namespace App\Http\Controllers\uno\scm;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('uno.scm.dashboard');
    }
}
