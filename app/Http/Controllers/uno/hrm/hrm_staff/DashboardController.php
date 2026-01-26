<?php

namespace App\Http\Controllers\uno\hrm\hrm_staff;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Show the HRM Staff Dashboard.
     */
    public function dashboard()
    {
        $users = User::hrm()->orderByName()->get();

        return view('uno.hrm.hrm_staff.dashboard', compact('users'));
    }

    /**
     * Show HRM Staff Payroll.
     */
    public function payroll()
    {
        return $this->view('payroll');
    }

    /**
     * Show HRM Staff Leave.
     */
    public function leave()
    {
        return $this->view('leave');
    }

    /**
     * Show HRM Staff Attendance.
     */
    public function attendance()
    {
        return $this->view('attendance');
    }

    /**
     * Show HRM Staff Training.
     */
    public function training()
    {
        return $this->view('training');
    }

    /**
     * Show HRM Staff Employee.
     */
    public function employee()
    {
        return $this->view('employee');
    }

    /**
     * Show HRM Staff Application.
     */
    public function application()
    {
        return $this->view('application');
    }

    /**
     * Show HRM Staff Paylist.
     */
    public function paylist()
    {
        return $this->view('paylist');
    }

    /**
     * Show HRM Staff Leave Request.
     */
    public function leaveRequest()
    {
        return $this->view('LeaveRequest');
    }

    /**
     * Show HRM Staff Time.
     */
    public function time()
    {
        return $this->view('time');
    }

    /**
     * Show HRM Staff Shift.
     */
    public function shift()
    {
        return $this->view('shift');
    }

    /**
     * Show HRM Staff Trainee.
     */
    public function trainee()
    {
        return $this->view('trainee');
    }

    /**
     * Helper method to render views consistently.
     */
    private function view(string $page)
    {
        return view("uno.hrm.hrm_staff.{$page}");
    }
}
