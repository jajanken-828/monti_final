<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

// Login Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if (auth()->attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        $user = auth()->user();

        // Redirect based on role AND position
        if ($user->role === 'hrm') {
            return $user->position === 'manager'
                ? redirect()->route('hrm.manager.dashboard')
                : redirect()->route('hrm.staff.dashboard');
        } else {
            return $user->position === 'manager'
                ? redirect()->route('scm.manager.dashboard')
                : redirect()->route('scm.staff.dashboard');
        }
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
})->name('login.post');

// Register Routes
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:hrm,scm',
        'terms' => 'required|accepted',
        'newsletter' => 'nullable|boolean',
    ]);

    try {
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'position' => 'staff',
            'newsletter_opt_in' => $request->boolean('newsletter', false),
        ]);

        auth()->login($user);

        // Redirect based on role AND position
        if ($user->role === 'hrm') {
            return redirect()->route('hrm.staff.dashboard');
        } else {
            return redirect()->route('scm.staff.dashboard');
        }
    } catch (\Exception $e) {
        \Log::error('Registration failed: '.$e->getMessage());

        return back()->withErrors([
            'error' => 'Registration failed. Please try again.',
        ])->withInput();
    }
})->name('register.post');

// Logout Route
Route::post('/logout', function (Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

// Helper function to check user access
function checkAccess($requiredRole, $requiredPosition = null)
{
    $user = auth()->user();

    if ($user->role !== $requiredRole) {
        return redirect()->route('login');
    }

    if ($requiredPosition && $user->position !== $requiredPosition) {
        return redirect()->route("{$requiredRole}.dashboard");
    }

    return null;
}

/*
|--------------------------------------------------------------------------
| HRM MODULE
|--------------------------------------------------------------------------
*/

Route::prefix('hrm')
    ->middleware(['auth'])
    ->name('hrm.')
    ->group(function () {

        // Generic HRM Dashboard - redirects based on position
        Route::get('/dashboard', function () {
            $user = auth()->user();

            if ($user->role !== 'hrm') {
                return redirect()->route('login');
            }

            return $user->position === 'manager'
                ? redirect()->route('hrm.manager.dashboard')
                : redirect()->route('hrm.staff.dashboard');
        })->name('dashboard');

        // HRM Staff Dashboard
        Route::get('/staff/dashboard', function () {
            if ($redirect = checkAccess('hrm', 'staff')) {
                return $redirect;
            }

            $users = User::where('role', 'hrm')
                ->orderBy('first_name')
                ->get();

            return view('uno.hrm.hrm_staff.dashboard', compact('users'));
        })->name('staff.dashboard');

        // HRM Manager Dashboard
        Route::get('/manager/dashboard', function () {
            if ($redirect = checkAccess('hrm', 'manager')) {
                return $redirect;
            }

            $staff = User::where('role', 'hrm')
                ->where('position', 'staff')
                ->orderBy('first_name')
                ->get();

            return view('uno.hrm.hrm_manager.dashboard', compact('staff'));
        })->name('manager.dashboard');

        // HRM Manager Onboarding
        Route::get('/manager/onboarding', function () {
            if ($redirect = checkAccess('hrm', 'manager')) {
                return $redirect;
            }

            return view('uno.hrm.hrm_manager.onboarding');
        })->name('manager.onboarding');

        // HRM Manager payroll
        Route::get('/manager/payroll', function () {
            if ($redirect = checkAccess('hrm', 'manager')) {
                return $redirect;
            }

            return view('uno.hrm.hrm_manager.payroll');
        })->name('manager.payroll');

        // HRM Manager analytics
        Route::get('/manager/analytics', function () {
            if ($redirect = checkAccess('hrm', 'manager')) {
                return $redirect;
            }

            return view('uno.hrm.hrm_manager.analytics');
        })->name('manager.analytics');

        // HRM Manager Settings
        Route::get('/manager/settings', function () {
            if ($redirect = checkAccess('hrm', 'manager')) {
                return $redirect;
            }

            return view('uno.hrm.hrm_manager.settings');
        })->name('manager.settings');

        // Promotion endpoint
        Route::post('/promote/{user}', function (Request $request, User $user) {
            if (auth()->user()->position !== 'manager' || auth()->user()->role !== 'hrm') {
                return redirect()->route('hrm.staff.dashboard')->with('error', 'Unauthorized');
            }

            if ($user->role !== 'hrm' || $user->position === 'manager') {
                return back()->with('error', 'Invalid user for promotion');
            }

            $user->position = 'manager';
            $user->save();

            return back()->with('success', 'User promoted to manager successfully!');
        })->name('promote');

        // HRM Staff Pages
        Route::prefix('staff')->name('staff.')->group(function () {
            Route::get('/payroll', function () {
                if ($redirect = checkAccess('hrm', 'staff')) {
                    return $redirect;
                }

                return view('uno.hrm.hrm_staff.payroll');
            })->name('payroll');

            Route::get('/leave', function () {
                if ($redirect = checkAccess('hrm', 'staff')) {
                    return $redirect;
                }

                return view('uno.hrm.hrm_staff.leave');
            })->name('leave');

            Route::get('/attendance', function () {
                if ($redirect = checkAccess('hrm', 'staff')) {
                    return $redirect;
                }

                return view('uno.hrm.hrm_staff.attendance');
            })->name('attendance');

            Route::get('/training', function () {
                if ($redirect = checkAccess('hrm', 'staff')) {
                    return $redirect;
                }

                return view('uno.hrm.hrm_staff.training');
            })->name('training');

            Route::get('/onboarding', function () {
                if ($redirect = checkAccess('hrm', 'staff')) {
                    return $redirect;
                }

                return view('uno.hrm.hrm_staff.onboarding');
            })->name('onboarding');

            Route::get('/recruitment', function () {
                if ($redirect = checkAccess('hrm', 'staff')) {
                    return $redirect;
                }

                return view('uno.hrm.hrm_staff.recruitment');
            })->name('recruitment');

            Route::get('/performance', function () {
                if ($redirect = checkAccess('hrm', 'staff')) {
                    return $redirect;
                }

                return view('uno.hrm.hrm_staff.performance');
            })->name('performance');

            Route::get('/settings', function () {
                if ($redirect = checkAccess('hrm', 'staff')) {
                    return $redirect;
                }

                return view('uno.hrm.hrm_staff.settings');
            })->name('settings');
        });
    });

/*
|--------------------------------------------------------------------------
| SCM MODULE
|--------------------------------------------------------------------------
*/

Route::prefix('scm')
    ->middleware(['auth'])
    ->name('scm.')
    ->group(function () {

        // Generic SCM Dashboard - redirects based on position
        Route::get('/dashboard', function () {
            $user = auth()->user();

            if ($user->role !== 'scm') {
                return redirect()->route('login');
            }

            return $user->position === 'manager'
                ? redirect()->route('scm.manager.dashboard')
                : redirect()->route('scm.staff.dashboard');
        })->name('dashboard');

        // SCM Staff Dashboard
        Route::get('/staff/dashboard', function () {
            if ($redirect = checkAccess('scm', 'staff')) {
                return $redirect;
            }

            $users = User::where('role', 'scm')
                ->orderBy('first_name')
                ->get();

            return view('uno.scm.scm_staff.dashboard', compact('users'));
        })->name('staff.dashboard');

        // SCM Manager Dashboard
        Route::get('/manager/dashboard', function () {
            if ($redirect = checkAccess('scm', 'manager')) {
                return $redirect;
            }

            $staff = User::where('role', 'scm')
                ->where('position', 'staff')
                ->orderBy('first_name')
                ->get();

            return view('uno.scm.scm_manager.dashboard', compact('staff'));
        })->name('manager.dashboard');

        // SCM Manager Onboarding
        Route::get('/manager/onboarding', function () {
            if ($redirect = checkAccess('scm', 'manager')) {
                return $redirect;
            }

            return view('uno.scm.scm_manager.onboarding');
        })->name('manager.onboarding');

        // SCM Manager Inventory
        Route::get('/manager/inventory', function () {
            if ($redirect = checkAccess('scm', 'manager')) {
                return $redirect;
            }

            return view('uno.scm.scm_manager.inventory');
        })->name('manager.inventory');

        // SCM Manager Orders
        Route::get('/manager/orders', function () {
            if ($redirect = checkAccess('scm', 'manager')) {
                return $redirect;
            }

            return view('uno.scm.scm_manager.orders');
        })->name('manager.orders');

        // SCM Manager Settings
        Route::get('/manager/settings', function () {
            if ($redirect = checkAccess('scm', 'manager')) {
                return $redirect;
            }

            return view('uno.scm.scm_manager.settings');
        })->name('manager.settings');

        // Promotion endpoint
        Route::post('/promote/{user}', function (Request $request, User $user) {
            if (auth()->user()->position !== 'manager' || auth()->user()->role !== 'scm') {
                return redirect()->route('scm.staff.dashboard')->with('error', 'Unauthorized');
            }

            if ($user->role !== 'scm' || $user->position === 'manager') {
                return back()->with('error', 'Invalid user for promotion');
            }

            $user->position = 'manager';
            $user->save();

            return back()->with('success', 'User promoted to manager successfully!');
        })->name('promote');

        // SCM Staff Pages
        Route::prefix('staff')->name('staff.')->group(function () {
            Route::get('/inventory', function () {
                if ($redirect = checkAccess('scm', 'staff')) {
                    return $redirect;
                }

                return view('uno.scm.scm_staff.inventory');
            })->name('inventory');

            Route::get('/orders', function () {
                if ($redirect = checkAccess('scm', 'staff')) {
                    return $redirect;
                }

                return view('uno.scm.scm_staff.orders');
            })->name('orders');

            Route::get('/suppliers', function () {
                if ($redirect = checkAccess('scm', 'staff')) {
                    return $redirect;
                }

                return view('uno.scm.scm_staff.suppliers');
            })->name('suppliers');

            Route::get('/warehouse', function () {
                if ($redirect = checkAccess('scm', 'staff')) {
                    return $redirect;
                }

                return view('uno.scm.scm_staff.warehouse');
            })->name('warehouse');

            Route::get('/onboarding', function () {
                if ($redirect = checkAccess('scm', 'staff')) {
                    return $redirect;
                }

                return view('uno.scm.scm_staff.onboarding');
            })->name('onboarding');

            Route::get('/settings', function () {
                if ($redirect = checkAccess('scm', 'staff')) {
                    return $redirect;
                }

                return view('uno.scm.scm_staff.settings');
            })->name('settings');
        });
    });
