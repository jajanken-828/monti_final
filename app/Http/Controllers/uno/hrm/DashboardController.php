<?php

namespace App\Http\Controllers\uno\hrm;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('uno.hrm.dashboard');
    }

    public function payroll()
    {
        return view('uno.hrm.payroll');
    }

    public function leave()
    {
        return view('uno.hrm.leave');
    }

    public function attendance()
    {
        return view('uno.hrm.attendance');
    }

    public function training()
    {
        return view('uno.hrm.training');
    }
}
