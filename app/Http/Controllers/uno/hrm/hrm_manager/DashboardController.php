<?php

namespace App\Http\Controllers\uno\hrm\hrm_staff;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('uno.hrm.hrm_manager.dashboard');
    }

    public function onboarding()
    {
        return view('uno.hrm.hrm_manager.onboarding');
    }

    public function payroll()
    {
        return view('uno.hrm.hrm_manager.payroll');
    }

    public function analytics()
    {
        return view('uno.hrm.hrm_manager.analytics');
    }
}
