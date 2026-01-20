<?php

namespace App\Http\Controllers\uno\scm\scm_manager;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is SCM manager
        if (auth()->user()->role !== 'scm' || auth()->user()->position !== 'manager') {
            return redirect()->route(auth()->user()->position === 'staff' ? 'scm.staff.dashboard' : 'login');
        }

        // Get all SCM staff members
        $staff = User::where('role', 'scm')
            ->where('position', 'staff')
            ->orderBy('first_name')
            ->get();

        return view('uno.scm.scm_manager.dashboard', compact('staff'));
    }
}
