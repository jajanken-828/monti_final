<?php

namespace App\Http\Controllers\uno\scm\scm_staff;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('uno.scm.scm_staff.dashboard');
    }
}
