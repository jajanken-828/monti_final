<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\uno\hrm\hrm_manager\DashboardController as HRMManagerDashboardController;
use App\Http\Controllers\uno\hrm\hrm_staff\DashboardController as HRMStaffDashboardController;
use App\Http\Controllers\uno\scm\scm_manager\DashboardController as SCMManagerDashboardController;
use App\Http\Controllers\uno\scm\scm_staff\DashboardController as SCMStaffDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'));

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::controller(AuthController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'showLogin')->name('login');
        Route::post('/login', 'login')->name('login.post');
        Route::get('/register', 'showRegister')->name('register');
        Route::post('/register', 'register')->name('register.post');
    });

    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
});

/*
|--------------------------------------------------------------------------
| HRM MODULE
|--------------------------------------------------------------------------
*/
Route::prefix('hrm')
    ->middleware(['auth', 'role:hrm'])
    ->name('hrm.')
    ->group(function () {

        // Generic HRM Dashboard - redirects based on position
        Route::get('/dashboard', function () {
            return auth()->user()->isManager()
                ? redirect()->route('hrm.manager.dashboard')
                : redirect()->route('hrm.staff.dashboard');
        })->name('dashboard');

        // HRM Manager Routes
        Route::prefix('manager')
            ->middleware('position:manager')
            ->name('manager.')
            ->controller(HRMManagerDashboardController::class)
            ->group(function () {
                Route::get('/dashboard', 'dashboard')->name('dashboard');
                Route::post('/promote/{user}', 'promoteUser')->name('promote');
                Route::get('/onboarding', 'onboarding')->name('onboarding');
                Route::get('/payroll', 'payroll')->name('payroll');
                Route::get('/analytics', 'analytics')->name('analytics');
                Route::get('/settings', 'settings')->name('settings');
            });

        // HRM Staff Routes
        Route::prefix('staff')
            ->middleware('position:staff')
            ->name('staff.')
            ->controller(HRMStaffDashboardController::class)
            ->group(function () {
                Route::get('/dashboard', 'dashboard')->name('dashboard');
                Route::get('/payroll', 'payroll')->name('payroll');
                Route::get('/leave', 'leave')->name('leave');
                Route::get('/attendance', 'attendance')->name('attendance');
                Route::get('/training', 'training')->name('training');
                Route::get('/employee', 'employee')->name('employee');
                Route::get('/application', 'application')->name('application');
                Route::get('/paylist', 'paylist')->name('paylist');
                Route::get('/leave-request', 'leaveRequest')->name('LeaveRequest');
                Route::get('/time', 'time')->name('time');
                Route::get('/shift', 'shift')->name('shift');
                Route::get('/trainee', 'trainee')->name('trainee');

            });
    });

/*
|--------------------------------------------------------------------------
| SCM MODULE
|--------------------------------------------------------------------------
*/
Route::prefix('scm')
    ->middleware(['auth', 'role:scm'])
    ->name('scm.')
    ->group(function () {

        // Generic SCM Dashboard - redirects based on position
        Route::get('/dashboard', function () {
            return auth()->user()->isManager()
                ? redirect()->route('scm.manager.dashboard')
                : redirect()->route('scm.staff.dashboard');
        })->name('dashboard');

        // SCM Manager Routes
        Route::prefix('manager')
            ->middleware('position:manager')
            ->name('manager.')
            ->controller(SCMManagerDashboardController::class)
            ->group(function () {
                Route::get('/dashboard', 'dashboard')->name('dashboard');
                Route::post('/promote/{user}', 'promoteUser')->name('promote');
                Route::get('/onboarding', 'onboarding')->name('onboarding');
                Route::get('/inventory', 'inventory')->name('inventory');
                Route::get('/orders', 'orders')->name('orders');
                Route::get('/settings', 'settings')->name('settings');
            });

        // SCM Staff Routes
        Route::prefix('staff')
            ->middleware('position:staff')
            ->name('staff.')
            ->controller(SCMStaffDashboardController::class)
            ->group(function () {
                Route::get('/dashboard', 'dashboard')->name('dashboard');
                Route::get('/inventory', 'inventory')->name('inventory');
                Route::get('/orders', 'orders')->name('orders');
                Route::get('/suppliers', 'suppliers')->name('suppliers');
                Route::get('/warehouse', 'warehouse')->name('warehouse');
                Route::get('/onboarding', 'onboarding')->name('onboarding');
                Route::get('/settings', 'settings')->name('settings');
            });
    });
