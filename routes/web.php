<?php

use App\Http\Controllers\uno\hrm\DashboardController as hrmDashboard;
use App\Http\Controllers\uno\scm\DashboardController as scmDashboard;
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

        // Redirect based on role
        if (auth()->user()->role === 'hrm') {
            return redirect()->route('hrm.dashboard');
        } else {
            return redirect()->route('scm.dashboard');
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
            'newsletter_opt_in' => $request->boolean('newsletter', false),
        ]);

        // Log the user in
        auth()->login($user);

        // Redirect based on role
        if ($user->role === 'hrm') {
            return redirect()->route('hrm.dashboard');
        } else {
            return redirect()->route('scm.dashboard');
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

        // HRM Dashboard with role check
        Route::get('/dashboard', function () {
            // Check if user has HRM role
            if (auth()->user()->role !== 'hrm') {
                // Redirect to appropriate dashboard
                return redirect()->route(auth()->user()->role === 'scm' ? 'scm.dashboard' : 'login');
            }

            // If user is HRM, show the dashboard using the controller
            $controller = new hrmDashboard;

            return $controller->index();
        })->name('dashboard');

        Route::get('/payroll', [hrmDashboard::class, 'payroll'])
            ->name('payroll');

        Route::get('/leave', [hrmDashboard::class, 'leave'])
            ->name('leave');

        Route::get('/attendance', [hrmDashboard::class, 'attendance'])
            ->name('attendance');

        Route::get('/training', [hrmDashboard::class, 'training'])
            ->name('training');
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

        // SCM Dashboard with role check
        Route::get('/dashboard', function () {
            // Check if user has SCM role
            if (auth()->user()->role !== 'scm') {
                // Redirect to appropriate dashboard
                return redirect()->route(auth()->user()->role === 'hrm' ? 'hrm.dashboard' : 'login');
            }

            // If user is SCM, show the dashboard using the controller
            $controller = new scmDashboard;

            return $controller->index();
        })->name('dashboard');

    });
