<?php

namespace App\Http\Controllers\uno\hrm\hrm_staff;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('uno.hrm.hrm_staff.dashboard');
    }

    public function payroll()
    {
        return view('uno.hrm.hrm_staff.payroll');
    }

    public function leave()
    {
        return view('uno.hrm.hrm_staff.leave');
    }

    public function attendance()
    {
        return view('uno.hrm.hrm_staff.attendance');
    }

    public function training()
    {
        return view('uno.hrm.hrm_staff.training');
    }

    public function employee()
    {
        return view('uno.hrm.hrm_staff.employee');
    }

    public function application()
    {
        return view('uno.hrm.hrm_staff.application');
    }
}
