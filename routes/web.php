<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\uno\hrm\hrm_manager\DashboardController as HRMManagerDashboardController;
use App\Http\Controllers\uno\hrm\hrm_manager\OnboardingController; // Added this line
use App\Http\Controllers\uno\hrm\hrm_staff\ApplicantController;
use App\Http\Controllers\uno\hrm\hrm_staff\DashboardController as HRMStaffDashboardController;
use App\Http\Controllers\uno\hrm\hrm_staff\InterviewController;
use App\Http\Controllers\uno\scm\scm_manager\DashboardController as SCMManagerDashboardController;
use App\Http\Controllers\uno\scm\scm_staff\DashboardController as SCMStaffDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'))->name('home');

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
        // Use AuthController for showing the application form
        Route::get('/apply', 'showApply')->name('apply');
    });

    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
});

// Public application submission route - use ApplicantController for storing applications
Route::post('/apply', [ApplicantController::class, 'store'])->name('apply.store');

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
            ->group(function () {
                // Dashboard Controller Routes
                Route::controller(HRMManagerDashboardController::class)->group(function () {
                    Route::get('/dashboard', 'dashboard')->name('dashboard');
                    Route::post('/promote/{user}', 'promoteUser')->name('promote');
                    Route::get('/payroll', 'payroll')->name('payroll');
                    Route::get('/analytics', 'analytics')->name('analytics');
                    Route::get('/settings', 'settings')->name('settings');
                });

                // Onboarding Controller Routes
                Route::controller(OnboardingController::class)->group(function () {
                    Route::get('/onboarding', 'index')->name('onboarding');
                    Route::post('/applicants', 'store')->name('applicants.store');
                    Route::get('/applicants/{id}', 'show')->name('applicants.show');
                    Route::post('/applicants/{id}/update-status', 'updateStatus')->name('applicants.update-status');
                    Route::get('/upcoming-interviews', 'getUpcomingInterviews')->name('upcoming-interviews');
                    Route::get('/statistics', 'getStatistics')->name('statistics');
                    Route::get('/export-csv', 'exportCsv')->name('export-csv');
                });
            });

        // HRM Staff Routes
        Route::prefix('staff')
            ->middleware('position:staff')
            ->name('staff.')
            ->group(function () {

                // Dashboard Controller Routes
                Route::controller(HRMStaffDashboardController::class)->group(function () {
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
                    // Note: interview route has been moved to InterviewController
                });

                // Application Management Routes (ApplicantController)
                Route::prefix('application')
                    ->name('application.')
                    ->controller(ApplicantController::class)
                    ->group(function () {
                        Route::get('/', 'index')->name('index'); // This will be the main application page
                        Route::get('/{id}', 'show')->name('show'); // View single applicant
                        Route::post('/', 'store')->name('store');
                        Route::put('/{id}', 'update')->name('update');
                        Route::delete('/{id}', 'destroy')->name('destroy');
                        Route::post('/{id}/schedule-interview', 'scheduleInterview')->name('schedule-interview');
                        Route::put('/{id}/status', 'updateStatus')->name('update-status');
                        Route::get('/statistics', 'getStatistics')->name('statistics');
                        // ADD THE MISSING ROUTE HERE
                        Route::get('/{id}/interview-schedules', 'getInterviewSchedules')->name('interview-schedules');
                    });

                // Interview Management Routes (InterviewController)
                Route::controller(InterviewController::class)->group(function () {
                    // Main interview page (GET /hrm/staff/interview)
                    Route::get('/interview', 'interviews')->name('interview');

                    // API routes for interview operations - FIXED ROUTE ORDER AND NAMES
                    // Get single interview details
                    Route::get('/interviews/{id}', 'getInterview')->name('interviews.show');

                    // Start interview now
                    Route::post('/interviews/{id}/start-now', 'startInterviewNow')->name('interviews.start-now');

                    // Complete interview
                    Route::post('/interviews/{id}/complete', 'completeInterview')->name('interviews.complete');

                    // Reschedule interview
                    Route::post('/interviews/{id}/reschedule', 'rescheduleInterview')->name('interviews.reschedule');

                    // Cancel interview
                    Route::post('/interviews/{id}/cancel', 'cancelInterview')->name('interviews.cancel');
                });

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
