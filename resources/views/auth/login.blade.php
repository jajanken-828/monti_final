<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Monti Textile - Employee Login Portal">
    <title>Employee Login - Monti Textile</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #2563EB;
            --secondary: #F59E0B;
            --accent: #60A5FA;
            --accent2: #FBBF24;
            --light: #FFFFFF;
            --light-gray: #F8FAFC;
            --dark: #1E293B;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background-color: var(--light);
            color: var(--dark);
        }
        
        h1, h2, h3, h4, .logo {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
        }
        
        /* Enhanced Preloader */
        #preloader {
            transition: opacity 0.8s ease-in-out, visibility 0.8s ease-in-out;
        }
        
        .loader-circle {
            animation: loader-rotate 2s linear infinite;
        }
        
        @keyframes loader-rotate {
            0% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(180deg) scale(1.1); }
            100% { transform: rotate(360deg) scale(1); }
        }
        
        .loader-pulse {
            animation: loader-pulse 1.5s ease-in-out infinite;
        }
        
        @keyframes loader-pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.95); }
        }
        
        /* Custom Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-25px) rotate(8deg); }
            66% { transform: translateY(15px) rotate(-8deg); }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(60px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        @keyframes pulse-glow {
            0%, 100% { 
                box-shadow: 0 0 15px rgba(37, 99, 235, 0.6),
                           0 0 30px rgba(37, 99, 235, 0.3),
                           inset 0 0 20px rgba(245, 158, 11, 0.2); 
            }
            50% { 
                box-shadow: 0 0 25px rgba(37, 99, 235, 0.9),
                           0 0 50px rgba(37, 99, 235, 0.5),
                           inset 0 0 30px rgba(245, 158, 11, 0.4); 
            }
        }
        
        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        @keyframes morph {
            0%, 100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
            33% { border-radius: 40% 60% 70% 30% / 40% 70% 30% 60%; }
            66% { border-radius: 70% 30% 50% 50% / 30% 50% 50% 70%; }
        }
        
        @keyframes bounce-smooth {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Animation Classes */
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 3s infinite;
        }
        
        .animate-gradient-shift {
            background-size: 200% 200%;
            animation: gradient-shift 5s ease infinite;
        }
        
        .animate-morph {
            animation: morph 8s ease-in-out infinite;
        }
        
        .animate-bounce-smooth {
            animation: bounce-smooth 2s ease-in-out infinite;
        }
        
        /* Enhanced Styling */
        .glass-effect {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }
        
        .blue-yellow-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        }
        
        .blue-yellow-gradient-reverse {
            background: linear-gradient(135deg, var(--secondary) 0%, var(--primary) 100%);
        }
        
        .blue-gradient {
            background: linear-gradient(135deg, #1D4ED8 0%, #3B82F6 50%, #60A5FA 100%);
        }
        
        .yellow-gradient {
            background: linear-gradient(135deg, #F59E0B 0%, #FBBF24 50%, #FCD34D 100%);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Enhanced 3D Card Effect */
        .card-3d {
            transform-style: preserve-3d;
            perspective: 1500px;
            transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275),
                        box-shadow 0.4s ease;
        }
        
        .card-3d:hover {
            transform: translateY(-25px) rotateX(5deg) rotateY(5deg) scale(1.02);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        }
        
        /* Enhanced Button Hover Effects */
        .btn-hover-effect {
            position: relative;
            overflow: hidden;
        }
        
        .btn-hover-effect::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .btn-hover-effect:hover::before {
            width: 300px;
            height: 300px;
        }
        
        /* Form Input Styling */
        .form-input {
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            width: 100%;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            transform: translateY(-2px);
        }
        
        .form-input.error {
            border-color: #EF4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark);
            font-size: 0.95rem;
        }
        
        .checkbox-container {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .checkbox-input {
            width: 18px;
            height: 18px;
            border: 2px solid #D1D5DB;
            border-radius: 4px;
            margin-right: 10px;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .checkbox-input.checked {
            background: var(--primary);
            border-color: var(--primary);
        }
        
        .checkbox-input.checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
            font-weight: bold;
        }
        
        /* Loading Spinner */
        .spinner {
            width: 24px;
            height: 24px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 0.8s linear infinite;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .spinner.active {
            opacity: 1;
        }
        
        /* Loading Overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.95);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }
        
        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        /* Fabric Pattern Overlays */
        .fabric-overlay {
            position: relative;
            overflow: hidden;
        }
        
        .fabric-overlay::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%232563eb' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.5;
            pointer-events: none;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .login-container {
                padding: 2rem 1rem;
            }
            
            .login-card {
                padding: 2rem !important;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-yellow-50 min-h-screen overflow-x-hidden">
    <!-- Enhanced Preloader -->
    <div id="preloader" class="fixed inset-0 bg-gradient-to-br from-blue-50 via-white to-yellow-50 z-50 flex items-center justify-center">
        <div class="text-center">
            <div class="relative">
                <div class="w-32 h-32 blue-yellow-gradient rounded-full animate-morph flex items-center justify-center loader-circle">
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center loader-pulse">
                        <i class="fas fa-lock text-4xl text-gradient"></i>
                    </div>
                </div>
                <div class="absolute inset-0 blue-yellow-gradient rounded-full opacity-30 animate-ping"></div>
            </div>
            <div class="mt-8 text-xl font-bold text-blue-600 animate-pulse">
                Securing Access...
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="text-center">
            <div class="relative">
                <div class="w-20 h-20 blue-yellow-gradient rounded-full flex items-center justify-center loader-circle">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                        <i class="fas fa-user-check text-2xl text-gradient"></i>
                    </div>
                </div>
            </div>
            <p class="mt-6 text-lg font-semibold text-gray-700">Signing you in...</p>
            <p class="mt-2 text-gray-600">Please wait a moment</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="fixed w-full z-40 glass-effect py-4 transition-all duration-300">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <a href="{{ url('/') }}" class="logo text-2xl font-bold text-dark flex items-center hover:opacity-80 transition-opacity duration-300">
                    <div class="w-10 h-10 blue-gradient rounded-full flex items-center justify-center mr-3 animate-pulse-glow">
                        <i class="fas fa-tshirt text-white text-lg"></i>
                    </div>
                    <span>MONTI<span class="text-gradient">TEXTILE</span></span>
                </a>
                
                <a href="{{ url('/') }}" class="text-dark hover:text-gradient font-medium transition-all duration-300 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Home
                </a>
            </div>
        </div>
    </nav>

    <!-- Login Section -->
    <section class="min-h-screen pt-24 pb-12 relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 fabric-overlay"></div>
        
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center justify-center gap-12">
                <!-- Left Side - Illustration -->
                <div class="lg:w-1/2 flex justify-center animate-fade-in-up">
                    <div class="relative">
                        <!-- Main floating element -->
                        <div class="w-80 h-80 blue-yellow-gradient animate-gradient-shift rounded-full animate-float relative overflow-hidden shadow-2xl">
                            <div class="absolute inset-8 bg-white rounded-full"></div>
                            <div class="absolute inset-16 bg-gradient-to-br from-blue-50 to-yellow-50 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-lock text-gradient text-7xl"></i>
                            </div>
                        </div>
                        
                        <!-- Floating security elements -->
                        <div class="absolute top-0 -left-4 w-24 h-24 bg-blue-500/20 rounded-2xl -rotate-12 animate-bounce-smooth shadow-lg"></div>
                        <div class="absolute bottom-10 -right-4 w-32 h-32 bg-yellow-500/20 rounded-3xl rotate-12 animate-bounce-smooth shadow-lg" style="animation-delay: 0.5s;"></div>
                        
                        <!-- Ripple effects -->
                        <div class="absolute inset-0 border-4 border-blue-500/30 rounded-full animate-ping"></div>
                    </div>
                </div>
                
                <!-- Right Side - Login Form -->
                <div class="lg:w-1/2 max-w-md animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="card-3d bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                        <div class="blue-gradient p-8 text-center">
                            <h1 class="text-3xl font-bold text-white mb-2">Employee Portal</h1>
                            <p class="text-blue-100">Secure access to Monti Textile systems</p>
                        </div>
                        
                        <div class="p-8">
                            @if(session('status'))
                                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-check text-green-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-green-800">{{ session('status') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-red-800">Authentication failed</p>
                                            <p class="text-sm text-red-600 mt-1">
                                                @foreach($errors->all() as $error)
                                                    {{ $error }}<br>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login.post') }}" id="loginForm" class="space-y-6">
                                @csrf

                                <div>
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope text-blue-500 mr-2"></i>Email Address
                                    </label>
                                    <input 
                                        id="email" 
                                        type="email" 
                                        name="email" 
                                        value="{{ old('email') }}" 
                                        required 
                                        autocomplete="email" 
                                        autofocus
                                        class="form-input @error('email') error @enderror"
                                        placeholder="Enter your company email"
                                    >
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <div class="flex justify-between items-center mb-2">
                                        <label for="password" class="form-label">
                                            <i class="fas fa-lock text-blue-500 mr-2"></i>Password
                                        </label>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800 transition-colors duration-300">
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
                                        class="form-input @error('password') error @enderror"
                                        placeholder="Enter your password"
                                    >
                                    @error('password')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="checkbox-container" onclick="toggleRemember()">
                                        <div id="rememberCheckbox" class="checkbox-input {{ old('remember') ? 'checked' : '' }}"></div>
                                        <input 
                                            id="remember" 
                                            type="checkbox" 
                                            name="remember"
                                            class="hidden"
                                            {{ old('remember') ? 'checked' : '' }}
                                        >
                                        <label for="remember" class="text-gray-700 cursor-pointer select-none">
                                            Remember me
                                        </label>
                                    </div>
                                    
                                    <div class="text-sm text-gray-600">
                                        <i class="fas fa-shield-alt text-green-500 mr-2"></i>Secure Login
                                    </div>
                                </div>

                                <button 
                                    type="submit" 
                                    id="loginBtn" 
                                    class="btn-hover-effect w-full blue-gradient text-white py-3 rounded-xl font-bold text-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-center"
                                >
                                    <span id="btnText" class="flex items-center">
                                        <i class="fas fa-sign-in-alt mr-3"></i>Sign In
                                    </span>
                                    <div id="loginSpinner" class="spinner ml-3"></div>
                                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-yellow-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                                </button>

                                <div class="text-center pt-6 border-t border-gray-100">
                                    <p class="text-gray-600">
                                        Don't have an account? 
                                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-300 ml-1">
                                            Contact HR
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Security Info -->
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                        <div class="bg-white/50 backdrop-blur-sm p-4 rounded-xl border border-gray-100">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <i class="fas fa-shield-alt text-blue-600"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">SSL Encrypted</p>
                        </div>
                        <div class="bg-white/50 backdrop-blur-sm p-4 rounded-xl border border-gray-100">
                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <i class="fas fa-clock text-yellow-600"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">24/7 Access</p>
                        </div>
                        <div class="bg-white/50 backdrop-blur-sm p-4 rounded-xl border border-gray-100">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                <i class="fas fa-user-check text-green-600"></i>
                            </div>
                            <p class="text-sm font-medium text-gray-700">Role-Based</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 relative">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <div class="logo text-xl font-bold text-white flex items-center">
                        <div class="w-8 h-8 blue-gradient rounded-full flex items-center justify-center mr-2">
                            <i class="fas fa-tshirt text-white text-sm"></i>
                        </div>
                        <span>MONTI<span class="text-blue-400">TEXTILE</span></span>
                    </div>
                    <p class="text-gray-400 text-sm mt-2">© {{ date('Y') }} Monti Textile. All rights reserved.</p>
                </div>
                
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i class="fas fa-question-circle"></i>
                        <span class="ml-2">Help</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i class="fas fa-file-contract"></i>
                        <span class="ml-2">Privacy</span>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-300">
                        <i class="fas fa-headset"></i>
                        <span class="ml-2">Support</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Enhanced Preloader
        window.addEventListener('load', function() {
            setTimeout(() => {
                const preloader = document.getElementById('preloader');
                preloader.style.opacity = '0';
                preloader.style.visibility = 'hidden';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 800);
            }, 1500); // 1.5 seconds delay
        });

        // Toggle remember me checkbox
        function toggleRemember() {
            const checkbox = document.getElementById('remember');
            const checkboxDiv = document.getElementById('rememberCheckbox');
            checkbox.checked = !checkbox.checked;
            if (checkbox.checked) {
                checkboxDiv.classList.add('checked');
            } else {
                checkboxDiv.classList.remove('checked');
            }
        }

        // Form submission handler
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form elements
            const submitBtn = document.getElementById('loginBtn');
            const btnText = document.getElementById('btnText');
            const spinner = document.getElementById('loginSpinner');
            const loadingOverlay = document.getElementById('loadingOverlay');
            
            // Validate form first
            const emailField = document.getElementById('email');
            const passwordField = document.getElementById('password');
            
            let isValid = true;
            
            // Email validation
            const email = emailField.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email || !emailRegex.test(email)) {
                emailField.classList.add('error');
                isValid = false;
            } else {
                emailField.classList.remove('error');
            }
            
            // Password validation
            const password = passwordField.value.trim();
            if (!password || password.length < 6) {
                passwordField.classList.add('error');
                isValid = false;
            } else {
                passwordField.classList.remove('error');
            }
            
            if (!isValid) {
                // Show error message
                alert('Please correct the errors in the form before submitting.');
                return false;
            }
            
            // Show loading state only now (after validation passes)
            submitBtn.disabled = true;
            btnText.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>Signing in...';
            spinner.classList.add('active');
            
            // Show loading overlay
            loadingOverlay.classList.add('active');
            
            // Submit the form after a short delay to show loading animation
            setTimeout(() => {
                // Actually submit the form
                this.submit();
            }, 800);
            
            return false;
        });
        
        // Real-time validation on blur
        document.addEventListener('DOMContentLoaded', function() {
            // Email validation
            const emailField = document.getElementById('email');
            if (emailField) {
                emailField.addEventListener('blur', function() {
                    const email = this.value.trim();
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    
                    if (email === '') {
                        this.classList.remove('error');
                    } else if (!emailRegex.test(email)) {
                        this.classList.add('error');
                    } else {
                        this.classList.remove('error');
                    }
                });
            }
            
            // Password validation
            const passwordField = document.getElementById('password');
            if (passwordField) {
                passwordField.addEventListener('blur', function() {
                    const password = this.value.trim();
                    
                    if (password === '') {
                        this.classList.remove('error');
                    } else if (password.length < 6) {
                        this.classList.add('error');
                    } else {
                        this.classList.remove('error');
                    }
                });
            }
            
            // Clear validation errors when user starts typing
            if (emailField) {
                emailField.addEventListener('input', function() {
                    this.classList.remove('error');
                });
            }
            
            if (passwordField) {
                passwordField.addEventListener('input', function() {
                    this.classList.remove('error');
                });
            }
        });
        
        // Parallax effect for background elements
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const floatingElements = document.querySelectorAll('.animate-bounce-smooth');
            
            floatingElements.forEach((el, index) => {
                const speed = 0.3 + (index * 0.1);
                el.style.transform = `translateY(${scrolled * speed}px) rotate(${index * 12}deg)`;
            });
        });
        
        // Handle Enter key press in form
        document.getElementById('loginForm').addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.target.matches('button, a')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>