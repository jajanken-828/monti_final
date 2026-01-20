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
            if ($user->position === 'manager') {
                return redirect()->route('hrm.manager.dashboard');
            } else {
                return redirect()->route('hrm.staff.dashboard');
            }
        } else {
            if ($user->position === 'manager') {
                return redirect()->route('scm.manager.dashboard');
            } else {
                return redirect()->route('scm.staff.dashboard');
            }
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
        // Create the user
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'position' => 'staff', // Default position is staff
            'newsletter_opt_in' => $request->boolean('newsletter', false),
        ]);

        // Log the user in
        auth()->login($user);

        // Redirect based on role AND position
        if ($user->role === 'hrm') {
            if ($user->position === 'manager') {
                return redirect()->route('hrm.manager.dashboard');
            } else {
                return redirect()->route('hrm.staff.dashboard');
            }
        } else {
            if ($user->position === 'manager') {
                return redirect()->route('scm.manager.dashboard');
            } else {
                return redirect()->route('scm.staff.dashboard');
            }
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

            if ($user->position === 'manager') {
                return redirect()->route('hrm.manager.dashboard');
            } else {
                return redirect()->route('hrm.staff.dashboard');
            }
        })->name('dashboard');

        // HRM Staff Dashboard
        Route::get('/staff/dashboard', function () {
            // Check if user is HRM staff
            if (auth()->user()->role !== 'hrm' || auth()->user()->position !== 'staff') {
                // Redirect to appropriate dashboard
                return redirect()->route(auth()->user()->position === 'manager' ? 'hrm.manager.dashboard' : 'login');
            }

            // Get all HRM staff members (if needed)
            $users = User::where('role', 'hrm')
                ->orderBy('first_name')
                ->get();

            return view('uno.hrm.hrm_staff.dashboard', compact('users'));
        })->name('staff.dashboard');

        // HRM Manager Dashboard
        Route::get('/manager/dashboard', function () {
            // Check if user is HRM manager
            if (auth()->user()->role !== 'hrm' || auth()->user()->position !== 'manager') {
                // Redirect to appropriate dashboard
                return redirect()->route(auth()->user()->position === 'staff' ? 'hrm.staff.dashboard' : 'login');
            }

            // Get all HRM staff members for the manager to view
            $staff = User::where('role', 'hrm')
                ->where('position', 'staff')
                ->orderBy('first_name')
                ->get();

            return view('uno.hrm.hrm_manager.dashboard', compact('staff'));
        })->name('manager.dashboard');

        // Promotion endpoint (only for HRM managers)
        Route::post('/promote/{user}', function (Request $request, User $user) {
            // Check if current user is HRM manager
            if (auth()->user()->position !== 'manager' || auth()->user()->role !== 'hrm') {
                return redirect()->route('hrm.staff.dashboard')->with('error', 'Unauthorized');
            }

            // Check if user is HRM staff
            if ($user->role !== 'hrm' || $user->position === 'manager') {
                return back()->with('error', 'Invalid user for promotion');
            }

            // Promote to manager
            $user->position = 'manager';
            $user->save();

            return back()->with('success', 'User promoted to manager successfully!');
        })->name('promote');

        // Other HRM staff routes - Updated to include role checks
        Route::get('/staff/payroll', function () {
            if (auth()->user()->role !== 'hrm' || auth()->user()->position !== 'staff') {
                return redirect()->route(auth()->user()->position === 'manager' ? 'hrm.manager.dashboard' : 'login');
            }

            return view('uno.hrm.hrm_staff.payroll');
        })->name('staff.payroll');

        Route::get('/staff/leave', function () {
            if (auth()->user()->role !== 'hrm' || auth()->user()->position !== 'staff') {
                return redirect()->route(auth()->user()->position === 'manager' ? 'hrm.manager.dashboard' : 'login');
            }

            return view('uno.hrm.hrm_staff.leave');
        })->name('staff.leave');

        Route::get('/staff/attendance', function () {
            if (auth()->user()->role !== 'hrm' || auth()->user()->position !== 'staff') {
                return redirect()->route(auth()->user()->position === 'manager' ? 'hrm.manager.dashboard' : 'login');
            }

            return view('uno.hrm.hrm_staff.attendance');
        })->name('staff.attendance');

        Route::get('/staff/training', function () {
            if (auth()->user()->role !== 'hrm' || auth()->user()->position !== 'staff') {
                return redirect()->route(auth()->user()->position === 'manager' ? 'hrm.manager.dashboard' : 'login');
            }

            return view('uno.hrm.hrm_staff.training');
        })->name('staff.training');
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

            if ($user->position === 'manager') {
                return redirect()->route('scm.manager.dashboard');
            } else {
                return redirect()->route('scm.staff.dashboard');
            }
        })->name('dashboard');

        // SCM Staff Dashboard
        Route::get('/staff/dashboard', function () {
            // Check if user is SCM staff
            if (auth()->user()->role !== 'scm' || auth()->user()->position !== 'staff') {
                // Redirect to appropriate dashboard
                return redirect()->route(auth()->user()->position === 'manager' ? 'scm.manager.dashboard' : 'login');
            }

            // Get SCM data if needed
            $users = User::where('role', 'scm')
                ->orderBy('first_name')
                ->get();

            return view('uno.scm.scm_staff.dashboard', compact('users'));
        })->name('staff.dashboard');

        // SCM Manager Dashboard
        Route::get('/manager/dashboard', function () {
            // Check if user is SCM manager
            if (auth()->user()->role !== 'scm' || auth()->user()->position !== 'manager') {
                // Redirect to appropriate dashboard
                return redirect()->route(auth()->user()->position === 'staff' ? 'scm.staff.dashboard' : 'login');
            }

            // Get all SCM staff members for the manager to view
            $staff = User::where('role', 'scm')
                ->where('position', 'staff')
                ->orderBy('first_name')
                ->get();

            return view('uno.scm.scm_manager.dashboard', compact('staff'));
        })->name('manager.dashboard');

        // SCM Manager Promotion endpoint
        Route::post('/promote/{user}', function (Request $request, User $user) {
            // Check if current user is SCM manager
            if (auth()->user()->position !== 'manager' || auth()->user()->role !== 'scm') {
                return redirect()->route('scm.staff.dashboard')->with('error', 'Unauthorized');
            }

            // Check if user is SCM staff
            if ($user->role !== 'scm' || $user->position === 'manager') {
                return back()->with('error', 'Invalid user for promotion');
            }

            // Promote to manager
            $user->position = 'manager';
            $user->save();

            return back()->with('success', 'User promoted to manager successfully!');
        })->name('promote');
    });
