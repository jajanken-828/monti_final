<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login - iLearn</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <!-- Inline CSS (same as before) -->
            <style>
                /* ... existing inline CSS ... */
            </style>
        @endif

        <!-- Custom color overrides for blue/yellow theme -->
        <style>
            .bg-blue-theme { background-color: #2563eb; }
            .bg-yellow-theme { background-color: #fbbf24; }
            .text-blue-theme { color: #2563eb; }
            .text-yellow-theme { color: #fbbf24; }
            .border-blue-theme { border-color: #2563eb; }
            .border-yellow-theme { border-color: #fbbf24; }
            .hover\:bg-blue-theme:hover { background-color: #1d4ed8; }
            .hover\:bg-yellow-theme:hover { background-color: #f59e0b; }
            .dark .bg-blue-theme { background-color: #1e40af; }
            .dark .bg-yellow-theme { background-color: #d97706; }
            .dark .text-blue-theme { color: #60a5fa; }
            .dark .text-yellow-theme { color: #fbbf24; }
            .input-field { 
                border: 1px solid #d1d5db;
                border-radius: 0.375rem;
                padding: 0.5rem 0.75rem;
                width: 100%;
                transition: border-color 0.15s ease-in-out;
            }
            .input-field:focus { 
                outline: none;
                border-color: #2563eb;
                box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            }
            .dark .input-field {
                background-color: #374151;
                border-color: #4b5563;
                color: #f9fafb;
            }
            .dark .input-field:focus {
                border-color: #60a5fa;
                box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
            }
        </style>
    </head>
    <body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
            @if (Route::has('login'))
                <nav class="flex items-center justify-between gap-4">
                    <a href="{{ url('/') }}" class="flex items-center gap-2 no-underline">
                        <div class="w-8 h-8 rounded-full bg-blue-theme flex items-center justify-center">
                            <span class="text-white font-bold">i</span>
                        </div>
                        <span class="font-semibold text-blue-theme">Monti Textile</span>
                    </a>
                    
                    <div class="flex items-center gap-4">
                        <span class="text-gray-600 dark:text-gray-400 text-sm">Don't have an account?</span>
                        <a
                            href="{{ route('register') }}"
                            class="inline-block px-4 py-1.5 text-blue-theme border border-blue-theme hover:bg-blue-theme hover:text-white rounded-sm text-sm leading-normal transition-colors">
                            Sign Up
                        </a>
                    </div>
                </nav>
            @endif
        </header>
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-gray-800 shadow-[inset_0px_0px_0px_1px_rgba(37,99,235,0.1)] dark:shadow-[inset_0px_0px_0px_1px_rgba(59,130,246,0.2)] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                    <div class="mb-8">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Welcome Back</h1>
                        <p class="text-gray-600 dark:text-gray-400">Sign in to Monti textile</p>
                    </div>

                    @if(session('status'))
                        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 dark:text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-green-800 dark:text-green-300 font-medium">{{ session('status') }}</span>
                            </div>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-500 dark:text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-red-800 dark:text-red-300 font-medium">Authentication failed</span>
                            </div>
                            <p class="mt-1 text-sm text-red-700 dark:text-red-400">
                                The provided credentials do not match our records.
                            </p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                        @csrf

                        <div class="space-y-4">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Email Address
                                </label>
                                <input 
                                    id="email" 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    autocomplete="email" 
                                    autofocus
                                    class="input-field @error('email') border-red-500 @enderror"
                                    placeholder="Enter your email"
                                >
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Password
                                    </label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-sm text-blue-theme hover:underline">
                                            Forgot password?
                                        </a>
                                    @endif
                                </div>
                                <input 
                                    id="password" 
                                    type="password" 
                                    name="password" 
                                    required 
                                    autocomplete="current-password"
                                    class="input-field @error('password') border-red-500 @enderror"
                                    placeholder="Enter your password"
                                >
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center">
                                <input 
                                    id="remember" 
                                    type="checkbox" 
                                    name="remember"
                                    class="w-4 h-4 text-blue-theme border-gray-300 rounded focus:ring-blue-theme"
                                    {{ old('remember') ? 'checked' : '' }}
                                >
                                <label for="remember" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                    Remember me
                                </label>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <button type="submit" class="w-full bg-blue-theme hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-sm transition-colors focus:outline-none focus:ring-2 focus:ring-blue-theme focus:ring-offset-2">
                                Sign In
                            </button>

                            {{-- <div class="relative my-6">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300 dark:border-gray-700"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white dark:bg-gray-800 text-gray-500">Or continue with</span>
                                </div>
                            </div> --}}

                            {{-- <button type="button" class="w-full flex items-center justify-center gap-2 border border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 font-medium py-2.5 px-4 rounded-sm transition-colors">
                                <svg class="w-5 h-5" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                    <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                </svg>
                                Continue with Google
                            </button> --}}
                        </div>

                        <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="font-medium text-blue-theme hover:underline">
                                Sign up
                            </a>
                        </p>
                    </form>
                </div>
                
                <!-- Right side illustration (same as before) -->
                <div class="bg-gradient-to-br from-blue-50 to-yellow-50 dark:from-blue-950 dark:to-gray-900 relative lg:-ml-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg aspect-[335/376] lg:aspect-auto w-full lg:w-[438px] shrink-0 overflow-hidden">
                    <!-- ... same illustration code ... -->
                </div>
            </main>
        </div>

        <footer class="mt-8 text-center text-gray-500 dark:text-gray-400 text-sm">
            <p>© 2026 Monti Textile ERP. All rights reserved.</p>
            <p class="mt-2">Secure login for your learning journey</p>
        </footer>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>