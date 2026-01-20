<?php

namespace App\Http\Controllers\uno\hrm\hrm_staff;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('uno.hrm.dashboard');
    }
}
