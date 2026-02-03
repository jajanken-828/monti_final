<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Monti Textile - Join Our Team. Be part of a leading textile innovation company.">
    <title>Join Our Team - Monti Textile</title>
    
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
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-25px) rotate(8deg); }
            66% { transform: translateY(15px) rotate(-8deg); }
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
        
        @keyframes bounce-smooth {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
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
        
        .form-section {
            background: rgba(59, 130, 246, 0.05);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(59, 130, 246, 0.1);
            transition: all 0.3s ease;
        }
        
        .form-section:hover {
            border-color: rgba(59, 130, 246, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }
        
        /* File Upload Styling */
        .file-upload-area {
            border: 2px dashed #CBD5E1;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.5);
        }
        
        .file-upload-area:hover {
            border-color: var(--primary);
            background: rgba(59, 130, 246, 0.05);
        }
        
        .file-upload-area.dragover {
            border-color: var(--primary);
            background: rgba(59, 130, 246, 0.1);
            transform: scale(1.02);
        }
        
        .file-label {
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        .file-preview {
            margin-top: 1rem;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            border: 1px solid #E5E7EB;
            display: none;
        }
        
        .file-preview.show {
            display: block;
        }
        
        /* Success Message */
        .success-message {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: none;
            max-width: 500px;
            width: 90%;
            text-align: center;
        }
        
        .success-message.show {
            display: block;
            animation: fadeInUp 0.5s ease-out;
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
        
        /* Benefits Grid */
        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .benefit-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        
        .benefit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }
        
        /* Error Alert */
        .error-alert {
            position: fixed;
            top: 100px;
            right: 20px;
            background: #FEF2F2;
            border: 1px solid #FECACA;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            z-index: 1001;
            display: none;
            max-width: 400px;
            width: 90%;
            animation: slideInRight 0.3s ease-out;
        }
        
        .error-alert.show {
            display: block;
        }
        
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-section {
                padding: 1.5rem;
            }
            
            .hero-title {
                font-size: 2.5rem !important;
            }
            
            .error-alert {
                top: 80px;
                left: 20px;
                right: 20px;
                max-width: none;
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
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center">
                        <i class="fas fa-user-plus text-4xl text-gradient"></i>
                    </div>
                </div>
                <div class="absolute inset-0 blue-yellow-gradient rounded-full opacity-30 animate-ping"></div>
            </div>
            <div class="mt-8 text-xl font-bold text-blue-600 animate-pulse">
                Weaving Opportunities...
            </div>
        </div>
    </div>

    <!-- Error Alert -->
    <div id="errorAlert" class="error-alert">
        <div class="flex items-start">
            <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <div>
                <h4 class="font-bold text-red-800 mb-1" id="errorTitle">Form Submission Error</h4>
                <p class="text-red-600 text-sm" id="errorMessage">Please fix the errors in the form and try again.</p>
            </div>
            <button onclick="hideErrorAlert()" class="ml-auto text-red-400 hover:text-red-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="loading-overlay">
        <div class="text-center">
            <div class="relative">
                <div class="w-20 h-20 blue-yellow-gradient rounded-full flex items-center justify-center loader-circle">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center">
                        <i class="fas fa-paper-plane text-2xl text-gradient"></i>
                    </div>
                </div>
            </div>
            <p class="mt-6 text-lg font-semibold text-gray-700">Submitting Application...</p>
            <p class="mt-2 text-gray-600">Please wait a moment</p>
        </div>
    </div>

    <!-- Success Message -->
    <div id="successMessage" class="success-message">
        <div class="mb-6">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check text-green-600 text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Application Submitted!</h3>
            <p class="text-gray-600">Thank you for applying to join Monti Textile. We'll review your application and contact you soon.</p>
        </div>
        <button onclick="window.location.href='{{ route('home') }}'" class="btn-hover-effect w-full blue-gradient text-white py-3 rounded-xl font-bold text-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
    Done
</button>
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
                
                <div class="flex items-center space-x-6">
                    <a href="{{ url('/') }}" class="text-dark hover:text-gradient font-medium transition-all duration-300 hidden md:flex">
                        Back to Home
                    </a>
                    {{-- <a href="#application-form" class="btn-hover-effect relative overflow-hidden blue-gradient text-white px-6 py-2.5 rounded-full font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                        <span class="relative z-10">Apply Now</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-yellow-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                    </a> --}}
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-24 pb-16 relative overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 fabric-overlay"></div>
        
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="animate-fade-in-up">
                    <h1 class="hero-title text-5xl md:text-6xl font-bold mb-6 leading-tight">
                        <span class="text-dark">Be Part of</span> 
                        <span class="text-gradient animate-gradient-shift">Monti Textile</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        Join our innovative team and help shape the future of textile manufacturing. We're looking for passionate individuals ready to make a difference.
                    </p>
                    
                    <div class="flex flex-wrap gap-4">
                        <a href="#application-form" class="btn-hover-effect group relative overflow-hidden blue-gradient text-white px-8 py-4 rounded-full font-bold text-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <span class="relative z-10 flex items-center">
                                <i class="fas fa-paper-plane mr-3"></i> Start Application
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-yellow-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                        </a>
                        
                        <a href="#benefits" class="btn-hover-effect group relative overflow-hidden border-2 border-blue-500 text-blue-600 px-8 py-4 rounded-full font-bold text-lg hover:text-white transition-all duration-300 transform hover:scale-105">
                            <span class="relative z-10 flex items-center">
                                <i class="fas fa-gem mr-3"></i> View Benefits
                            </span>
                            <div class="absolute inset-0 bg-blue-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                        </a>
                    </div>
                </div>
                
                <div class="relative animate-fade-in-up" style="animation-delay: 0.2s;">
                    <div class="relative">
                        <!-- Main floating element -->
                        <div class="w-80 h-80 blue-yellow-gradient animate-gradient-shift rounded-full animate-float relative overflow-hidden shadow-2xl">
                            <div class="absolute inset-8 bg-white rounded-full"></div>
                            <div class="absolute inset-16 bg-gradient-to-br from-blue-50 to-yellow-50 rounded-full flex items-center justify-center">
                                <i class="fas fa-users text-gradient text-7xl"></i>
                            </div>
                        </div>
                        
                        <!-- Floating elements -->
                        <div class="absolute top-4 -left-4 w-16 h-16 bg-blue-500/20 rounded-2xl -rotate-12 animate-bounce-smooth shadow-lg"></div>
                        <div class="absolute bottom-12 -right-4 w-20 h-20 bg-yellow-500/20 rounded-3xl rotate-12 animate-bounce-smooth shadow-lg" style="animation-delay: 0.5s;"></div>
                        <div class="absolute top-1/2 left-0 w-12 h-12 bg-blue-500/30 rounded-xl -rotate-45 animate-bounce-smooth shadow-lg" style="animation-delay: 1s;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="benefits" class="py-16 bg-gradient-to-b from-white to-blue-50 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    <span class="text-gradient">Why Join</span> 
                    <span class="text-dark">Our Team?</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    At Monti Textile, we invest in our people and provide opportunities for growth and development.
                </p>
            </div>
            
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="w-16 h-16 blue-gradient rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse-glow">
                        <i class="fas fa-dollar-sign text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Competitive Salary</h3>
                    <p class="text-gray-600">Industry-leading compensation packages with performance bonuses</p>
                </div>
                
                <div class="benefit-card">
                    <div class="w-16 h-16 yellow-gradient rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse-glow">
                        <i class="fas fa-heartbeat text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Health Benefits</h3>
                    <p class="text-gray-600">Comprehensive medical, dental, and vision insurance coverage</p>
                </div>
                
                <div class="benefit-card">
                    <div class="w-16 h-16 blue-gradient rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse-glow">
                        <i class="fas fa-graduation-cap text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Career Growth</h3>
                    <p class="text-gray-600">Training programs and clear promotion pathways</p>
                </div>
                
                <div class="benefit-card">
                    <div class="w-16 h-16 yellow-gradient rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse-glow">
                        <i class="fas fa-balance-scale text-white text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Work-Life Balance</h3>
                    <p class="text-gray-600">Flexible schedules and generous paid time off</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Application Form Section -->
    <section id="application-form" class="py-16 relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    <span class="text-dark">Application</span> 
                    <span class="text-gradient">Form</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Complete the form below to apply for a position at Monti Textile. Fields marked with * are required.
                </p>
            </div>
            
            <div class="max-w-6xl mx-auto">
                <form id="applicant-form" action="{{ route('apply.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    
                    <!-- Full Name Section -->
                    <div class="form-section animate-fade-in-up">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 blue-gradient rounded-full flex items-center justify-center mr-4 animate-pulse-glow">
                                <i class="fas fa-user text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">Full Name</h3>
                                <p class="text-gray-600">Please enter your complete name as it appears on official documents</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="form-label">First Name *</label>
                                <input type="text" name="first_name" class="form-input" placeholder="First Name" required>
                                <div class="text-red-500 text-sm mt-2 error-message" id="error-first_name"></div>
                            </div>
                            <div>
                                <label class="form-label">Middle Name</label>
                                <input type="text" name="middle_name" class="form-input" placeholder="Middle Name">
                            </div>
                            <div>
                                <label class="form-label">Last Name *</label>
                                <input type="text" name="last_name" class="form-input" placeholder="Last Name" required>
                                <div class="text-red-500 text-sm mt-2 error-message" id="error-last_name"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Birth Date Section -->
                    <div class="form-section animate-fade-in-up" style="animation-delay: 0.1s;">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 yellow-gradient rounded-full flex items-center justify-center mr-4 animate-pulse-glow">
                                <i class="fas fa-calendar text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">Birth Date *</h3>
                                <p class="text-gray-600">Your date of birth for verification purposes</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="form-label">Month *</label>
                                <select name="birth_month" class="form-input" required>
                                    <option value="">Select Month</option>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                    @endfor
                                </select>
                                <div class="text-red-500 text-sm mt-2 error-message" id="error-birth_month"></div>
                            </div>
                            <div>
                                <label class="form-label">Day *</label>
                                <select name="birth_day" class="form-input" required>
                                    <option value="">Select Day</option>
                                    @for($i = 1; $i <= 31; $i++)
                                        <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <div class="text-red-500 text-sm mt-2 error-message" id="error-birth_day"></div>
                            </div>
                            <div>
                                <label class="form-label">Year *</label>
                                <select name="birth_year" class="form-input" required>
                                    <option value="">Select Year</option>
                                    @for($i = date('Y'); $i >= 1960; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <div class="text-red-500 text-sm mt-2 error-message" id="error-birth_year"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Current Address Section -->
                    <div class="form-section animate-fade-in-up" style="animation-delay: 0.2s;">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 blue-gradient rounded-full flex items-center justify-center mr-4 animate-pulse-glow">
                                <i class="fas fa-home text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">Current Address</h3>
                                <p class="text-gray-600">Your current residential address</p>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div>
                                <label class="form-label">Street Address *</label>
                                <input type="text" name="street_address" class="form-input" placeholder="Street Address" required>
                                <div class="text-red-500 text-sm mt-2 error-message" id="error-street_address"></div>
                            </div>
                            <div>
                                <label class="form-label">Street Address Line 2</label>
                                <input type="text" name="street_address_line2" class="form-input" placeholder="Apartment, Suite, Unit, etc.">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="form-label">City *</label>
                                    <input type="text" name="city" class="form-input" placeholder="City" required>
                                    <div class="text-red-500 text-sm mt-2 error-message" id="error-city"></div>
                                </div>
                                <div>
                                    <label class="form-label">State / Province *</label>
                                    <input type="text" name="state_province" class="form-input" placeholder="State / Province" required>
                                    <div class="text-red-500 text-sm mt-2 error-message" id="error-state_province"></div>
                                </div>
                                <div>
                                    <label class="form-label">Postal / Zip Code *</label>
                                    <input type="text" name="postal_zip_code" class="form-input" placeholder="Postal / Zip Code" required>
                                    <div class="text-red-500 text-sm mt-2 error-message" id="error-postal_zip_code"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="form-section animate-fade-in-up" style="animation-delay: 0.3s;">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 yellow-gradient rounded-full flex items-center justify-center mr-4 animate-pulse-glow">
                                <i class="fas fa-phone text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">Contact Information</h3>
                                <p class="text-gray-600">How we can contact you regarding your application</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="form-label">Email Address *</label>
                                <input type="email" name="email" class="form-input" placeholder="myname@example.com" required>
                                <div class="text-red-500 text-sm mt-2 error-message" id="error-email"></div>
                            </div>
                            <div>
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" name="phone_number" class="form-input" placeholder="000 800-0600" required>
                                <div class="text-red-500 text-sm mt-2 error-message" id="error-phone_number"></div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <label class="form-label">LinkedIn Profile (Optional)</label>
                            <input type="url" name="linkedin_profile" class="form-input" placeholder="https://linkedin.com/in/username">
                        </div>
                    </div>

                    <!-- Position Information -->
                    <div class="form-section animate-fade-in-up" style="animation-delay: 0.4s;">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 blue-gradient rounded-full flex items-center justify-center mr-4 animate-pulse-glow">
                                <i class="fas fa-briefcase text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">Position Information</h3>
                                <p class="text-gray-600">Details about the position you're applying for</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="form-label">Position Applied For *</label>
                                <select name="position_applied" class="form-input" required>
                                    <option value="">Please Select</option>
                                    <option value="production_supervisor">Production Supervisor</option>
                                    <option value="quality_inspector">Quality Control Inspector</option>
                                    <option value="maintenance_tech">Maintenance Technician</option>
                                    <option value="hr_assistant">HR Assistant</option>
                                    <option value="warehouse_staff">Warehouse Staff</option>
                                    <option value="textile_designer">Textile Designer</option>
                                    <option value="machine_operator">Machine Operator</option>
                                </select>
                                <div class="text-red-500 text-sm mt-2 error-message" id="error-position_applied"></div>
                            </div>
                            <div>
                                <label class="form-label">How did you hear about us? *</label>
                                <select name="referral_source" class="form-input" required>
                                    <option value="">Please Select</option>
                                    <option value="linkedin">LinkedIn</option>
                                    <option value="job_portal">Job Portal</option>
                                    <option value="referral">Employee Referral</option>
                                    <option value="social_media">Social Media</option>
                                    <option value="company_website">Company Website</option>
                                    <option value="career_fair">Career Fair</option>
                                </select>
                                <div class="text-red-500 text-sm mt-2 error-message" id="error-referral_source"></div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <label class="form-label">Available Start Date *</label>
                            <input type="date" name="available_start_date" class="form-input" required>
                            <div class="text-red-500 text-sm mt-2 error-message" id="error-available_start_date"></div>
                        </div>
                    </div>

                    <!-- Government Documents Section -->
                    <div class="form-section animate-fade-in-up" style="animation-delay: 0.5s;">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 yellow-gradient rounded-full flex items-center justify-center mr-4 animate-pulse-glow">
                                <i class="fas fa-file-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">Government Documents</h3>
                                <p class="text-gray-600">Upload copies of your government IDs (Optional during initial application)</p>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div>
                                <label class="form-label">SSS ID/Number</label>
                                <div class="file-upload-area" id="sss-upload-area">
                                    <input type="file" name="sss_file" class="file-input" id="sss-file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                    <label for="sss-file" class="file-label">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-blue-400 mb-3"></i>
                                        <p class="text-gray-600 mb-3 font-medium">Upload SSS ID or Number Document</p>
                                        <button type="button" class="bg-white border border-blue-500 text-blue-600 hover:bg-blue-50 px-6 py-2 rounded-xl font-medium transition-colors duration-200">
                                            <i class="fas fa-folder-open mr-2"></i> Choose File
                                        </button>
                                        <p class="text-gray-400 text-sm mt-3">PDF, JPG, PNG, DOC up to 5MB</p>
                                    </label>
                                    <div class="file-preview" id="sss-preview"></div>
                                </div>
                            </div>
                            <div>
                                <label class="form-label">PhilHealth ID/Number</label>
                                <div class="file-upload-area" id="philhealth-upload-area">
                                    <input type="file" name="philhealth_file" class="file-input" id="philhealth-file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                    <label for="philhealth-file" class="file-label">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-blue-400 mb-3"></i>
                                        <p class="text-gray-600 mb-3 font-medium">Upload PhilHealth ID or Number Document</p>
                                        <button type="button" class="bg-white border border-blue-500 text-blue-600 hover:bg-blue-50 px-6 py-2 rounded-xl font-medium transition-colors duration-200">
                                            <i class="fas fa-folder-open mr-2"></i> Choose File
                                        </button>
                                        <p class="text-gray-400 text-sm mt-3">PDF, JPG, PNG, DOC up to 5MB</p>
                                    </label>
                                    <div class="file-preview" id="philhealth-preview"></div>
                                </div>
                            </div>
                            <div>
                                <label class="form-label">Pag-IBIG ID/Number</label>
                                <div class="file-upload-area" id="pagibig-upload-area">
                                    <input type="file" name="pagibig_file" class="file-input" id="pagibig-file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                    <label for="pagibig-file" class="file-label">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-blue-400 mb-3"></i>
                                        <p class="text-gray-600 mb-3 font-medium">Upload Pag-IBIG ID or Number Document</p>
                                        <button type="button" class="bg-white border border-blue-500 text-blue-600 hover:bg-blue-50 px-6 py-2 rounded-xl font-medium transition-colors duration-200">
                                            <i class="fas fa-folder-open mr-2"></i> Choose File
                                        </button>
                                        <p class="text-gray-400 text-sm mt-3">PDF, JPG, PNG, DOC up to 5MB</p>
                                    </label>
                                    <div class="file-preview" id="pagibig-preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information Section -->
                    <div class="form-section animate-fade-in-up" style="animation-delay: 0.6s;">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 blue-gradient rounded-full flex items-center justify-center mr-4 animate-pulse-glow">
                                <i class="fas fa-info-circle text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">Additional Information</h3>
                                <p class="text-gray-600">Help us understand your background better</p>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div>
                                <label class="form-label">Expected Salary (per month)</label>
                                <input type="text" name="expected_salary" class="form-input" placeholder="e.g., ₱25,000 - ₱30,000">
                            </div>
                            <div>
                                <label class="form-label">Notice Period (if currently employed)</label>
                                <select name="notice_period" class="form-input">
                                    <option value="">Select Notice Period</option>
                                    <option value="immediate">Immediate</option>
                                    <option value="1_week">1 Week</option>
                                    <option value="2_weeks">2 Weeks</option>
                                    <option value="1_month">1 Month</option>
                                    <option value="2_months">2 Months</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label mb-4">Do you have textile industry experience?</label>
                                <div class="flex space-x-6">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="textile_experience" value="yes" class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                                        <span class="ml-3 text-gray-700 font-medium">Yes</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="textile_experience" value="no" class="w-5 h-5 text-blue-600 focus:ring-blue-500" checked>
                                        <span class="ml-3 text-gray-700 font-medium">No</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col lg:flex-row justify-between items-center pt-8 border-t border-gray-200 space-y-6 lg:space-y-0 animate-fade-in-up" style="animation-delay: 0.7s;">
                        <div class="text-sm text-gray-500 flex items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-shield-alt text-green-600"></i>
                            </div>
                            Your information is secure and confidential
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                            <button type="button" onclick="window.location.href='{{ route('home') }}'" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-8 py-3 rounded-xl font-medium transition-colors duration-200 hover:shadow-lg">
                                Cancel
                            </button>
                            <button type="submit" class="btn-hover-effect blue-gradient text-white px-8 py-3 rounded-xl font-bold text-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-3"></i> Submit Application
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-yellow-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 relative">
        <div class="absolute inset-0 fabric-overlay opacity-10"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div>
                    <div class="logo text-2xl font-bold text-white flex items-center mb-6">
                        <div class="w-10 h-10 blue-gradient rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-tshirt text-white text-lg"></i>
                        </div>
                        <span>MONTI<span class="text-blue-400">TEXTILE</span></span>
                    </div>
                    <p class="text-gray-400 mb-6">Innovating textiles since 2001. Join our journey of excellence and innovation.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-400 transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-pink-600 transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-xl font-bold mb-6 text-white">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Home</a></li>
                        <li><a href="#application-form" class="text-gray-400 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Apply Now</a></li>
                        <li><a href="#benefits" class="text-gray-400 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Benefits</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Employee Login</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-xl font-bold mb-6 text-white">Contact HR</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-envelope text-blue-400 mt-1 mr-3"></i>
                            <span class="text-gray-400">careers@montitextile.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-blue-400 mr-3"></i>
                            <span class="text-gray-400">+1 (555) 123-4567 Ext. 2</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-clock text-blue-400 mt-1 mr-3"></i>
                            <span class="text-gray-400">Mon-Fri, 9:00 AM - 5:00 PM</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 mt-8 text-center">
                <p class="text-gray-500">&copy; {{ date('Y') }} Monti Textile. All rights reserved.</p>
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
            }, 1500);
        });

        // File Upload Functionality
        function setupFileUpload(uploadAreaId, previewId) {
            const uploadArea = document.getElementById(uploadAreaId);
            const fileInput = uploadArea.querySelector('input[type="file"]');
            const preview = document.getElementById(previewId);
            const fileLabel = uploadArea.querySelector('.file-label');

            // Click on label triggers file input
            fileLabel.addEventListener('click', function(e) {
                if (e.target.tagName !== 'BUTTON') {
                    fileInput.click();
                }
            });

            // File input change event
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    showFilePreview(file, preview, uploadArea);
                }
            });

            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                uploadArea.classList.add('dragover');
            }

            function unhighlight() {
                uploadArea.classList.remove('dragover');
            }

            uploadArea.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const file = dt.files[0];
                fileInput.files = dt.files;
                
                if (file) {
                    showFilePreview(file, preview, uploadArea);
                }
            });
        }

        function showFilePreview(file, previewElement, uploadArea) {
            // Hide the upload label
            const fileLabel = uploadArea.querySelector('.file-label');
            fileLabel.style.display = 'none';
            
            // Show preview
            previewElement.innerHTML = `
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                        <div>
                            <p class="font-medium text-gray-800">${file.name}</p>
                            <p class="text-sm text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                        </div>
                    </div>
                    <button type="button" class="text-red-500 hover:text-red-700" onclick="removeFilePreview(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            previewElement.classList.add('show');
        }

        function removeFilePreview(button) {
            const preview = button.closest('.file-preview');
            const uploadArea = preview.closest('.file-upload-area');
            const fileInput = uploadArea.querySelector('input[type="file"]');
            const fileLabel = uploadArea.querySelector('.file-label');
            
            // Reset file input
            fileInput.value = '';
            
            // Hide preview and show label
            preview.classList.remove('show');
            preview.innerHTML = '';
            fileLabel.style.display = 'flex';
        }

        // Error Alert Functions
        function showErrorAlert(title, message) {
            document.getElementById('errorTitle').textContent = title;
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('errorAlert').classList.add('show');
            
            // Auto hide after 10 seconds
            setTimeout(hideErrorAlert, 10000);
        }

        function hideErrorAlert() {
            document.getElementById('errorAlert').classList.remove('show');
        }

        // Initialize file uploads
        document.addEventListener('DOMContentLoaded', function() {
            setupFileUpload('sss-upload-area', 'sss-preview');
            setupFileUpload('philhealth-upload-area', 'philhealth-preview');
            setupFileUpload('pagibig-upload-area', 'pagibig-preview');
            
            // Set minimum date for available start date
            const today = new Date().toISOString().split('T')[0];
            const startDateInput = document.querySelector('input[name="available_start_date"]');
            if (startDateInput) {
                startDateInput.min = today;
                // Set default to 2 weeks from now
                const twoWeeksLater = new Date();
                twoWeeksLater.setDate(twoWeeksLater.getDate() + 14);
                startDateInput.value = twoWeeksLater.toISOString().split('T')[0];
            }
        });

        // Form Validation
        function validateForm() {
            let isValid = true;
            const requiredFields = document.querySelectorAll('[required]');
            
            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
            document.querySelectorAll('.form-input').forEach(el => el.classList.remove('error'));
            
            // Validate each required field
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                    const errorId = `error-${field.name}`;
                    const errorElement = document.getElementById(errorId);
                    if (errorElement) {
                        errorElement.textContent = 'This field is required';
                    }
                }
                
                // Email validation
                if (field.type === 'email' && field.value.trim()) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(field.value)) {
                        isValid = false;
                        field.classList.add('error');
                        const errorId = `error-${field.name}`;
                        const errorElement = document.getElementById(errorId);
                        if (errorElement) {
                            errorElement.textContent = 'Please enter a valid email address';
                        }
                    }
                }
                
                // Phone validation
                if (field.name === 'phone_number' && field.value.trim()) {
                    const phoneRegex = /^[\d\s\-\(\)\+]+$/;
                    if (!phoneRegex.test(field.value)) {
                        isValid = false;
                        field.classList.add('error');
                        const errorId = `error-${field.name}`;
                        const errorElement = document.getElementById(errorId);
                        if (errorElement) {
                            errorElement.textContent = 'Please enter a valid phone number';
                        }
                    }
                }
            });
            
            return isValid;
        }

        // Form Submission
        document.getElementById('applicant-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (!validateForm()) {
                showErrorAlert('Validation Error', 'Please fill in all required fields correctly.');
                return;
            }
            
            // Show loading overlay
            const loadingOverlay = document.getElementById('loadingOverlay');
            loadingOverlay.classList.add('active');
            
            try {
                const formData = new FormData(this);
                
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    // Success
                    loadingOverlay.classList.remove('active');
                    
                    // Show success message
                    const successMessage = document.getElementById('successMessage');
                    successMessage.classList.add('show');
                    
                    // Reset form
                    this.reset();
                    
                    // Scroll to success message
                    successMessage.scrollIntoView({ behavior: 'smooth' });
                    
                    // Reset file previews
                    document.querySelectorAll('.file-preview').forEach(preview => {
                        preview.classList.remove('show');
                        preview.innerHTML = '';
                    });
                    document.querySelectorAll('.file-label').forEach(label => {
                        label.style.display = 'flex';
                    });
                    
                } else {
                    // Handle validation errors
                    loadingOverlay.classList.remove('active');
                    
                    if (data.errors) {
                        // Clear previous errors
                        document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
                        document.querySelectorAll('.form-input').forEach(el => el.classList.remove('error'));
                        
                        // Display new errors
                        Object.keys(data.errors).forEach(key => {
                            const errorElement = document.getElementById(`error-${key}`);
                            if (errorElement) {
                                errorElement.textContent = data.errors[key][0];
                            }
                            const input = document.querySelector(`[name="${key}"]`);
                            if (input) {
                                input.classList.add('error');
                            }
                        });
                        
                        showErrorAlert('Form Validation Error', 'Please fix the errors highlighted in red.');
                        
                        // Scroll to first error
                        const firstError = document.querySelector('.form-input.error');
                        if (firstError) {
                            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    } else {
                        showErrorAlert('Submission Error', data.message || 'There was an error submitting your application. Please try again.');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                loadingOverlay.classList.remove('active');
                showErrorAlert('Network Error', 'There was a problem connecting to the server. Please check your internet connection and try again.');
            }
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe animated elements
        document.querySelectorAll('.animate-fade-in-up').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>