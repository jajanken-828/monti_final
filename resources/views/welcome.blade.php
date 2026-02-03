<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Monti Textile - Premium Textile Solutions with modern designs and quality materials">
    <title>Monti Textile | Modern Textile Solutions</title>
    
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
        
        /* Particle Background */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
        }
        
        .particle {
            position: absolute;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            animation: float-particle 20s infinite linear;
            filter: blur(2px);
        }
        
        /* Custom Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-25px) rotate(8deg); }
            66% { transform: translateY(15px) rotate(-8deg); }
        }
        
        @keyframes float-particle {
            0% { transform: translateY(0) translateX(0); opacity: 0; }
            10% { opacity: 0.8; }
            90% { opacity: 0.8; }
            100% { transform: translateY(-100vh) translateX(100px); opacity: 0; }
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
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-120px) skewX(10deg);
            }
            to {
                opacity: 1;
                transform: translateX(0) skewX(0);
            }
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(120px) skewX(-10deg);
            }
            to {
                opacity: 1;
                transform: translateX(0) skewX(0);
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
        
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        @keyframes wave {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-20px) rotate(8deg); }
            75% { transform: translateY(15px) rotate(-8deg); }
        }
        
        @keyframes neon-glow {
            0%, 100% { 
                text-shadow: 0 0 10px rgba(37, 99, 235, 0.8),
                           0 0 20px rgba(37, 99, 235, 0.6),
                           0 0 30px rgba(245, 158, 11, 0.4);
            }
            50% { 
                text-shadow: 0 0 20px rgba(37, 99, 235, 1),
                           0 0 30px rgba(37, 99, 235, 0.8),
                           0 0 40px rgba(245, 158, 11, 0.6);
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
        
        @keyframes ripple {
            0% { transform: scale(0); opacity: 1; }
            100% { transform: scale(4); opacity: 0; }
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
        
        .animate-slide-left {
            animation: slideInLeft 1s ease-out forwards;
        }
        
        .animate-slide-right {
            animation: slideInRight 1s ease-out forwards;
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 3s infinite;
        }
        
        .animate-shimmer {
            background: linear-gradient(90deg, 
                transparent, 
                rgba(255,255,255,0.9), 
                transparent);
            background-size: 1000px 100%;
            animation: shimmer 3s infinite;
        }
        
        .animate-spin-slow {
            animation: spin-slow 25s linear infinite;
        }
        
        .animate-wave {
            animation: wave 4s ease-in-out infinite;
        }
        
        .animate-neon-glow {
            animation: neon-glow 2s infinite;
        }
        
        .animate-gradient-shift {
            background-size: 200% 200%;
            animation: gradient-shift 5s ease infinite;
        }
        
        .animate-morph {
            animation: morph 8s ease-in-out infinite;
        }
        
        .animate-ripple {
            animation: ripple 1.5s linear infinite;
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
        
        .card-3d-inner {
            transform: translateZ(30px);
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
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.15' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.3;
            pointer-events: none;
        }
        
        /* Scroll Animation Classes */
        .fade-on-scroll {
            opacity: 0;
            transform: translateY(60px) scale(0.95);
            transition: all 1s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .fade-on-scroll.visible {
            opacity: 1;
            transform: translateY(0) scale(1);
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
        
        /* Navbar Shadow on Scroll */
        .navbar-scrolled {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.95);
        }
        
        /* Enhanced Loading Text */
        .loading-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2563EB;
            margin-top: 2rem;
            animation: loading-pulse 1.5s ease-in-out infinite;
        }
        
        @keyframes loading-pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .parallax-bg {
                background-attachment: scroll;
            }
            
            h1 {
                font-size: 2.5rem !important;
            }
            
            h2 {
                font-size: 2rem !important;
            }
        }
    </style>
</head>
<body class="bg-white overflow-x-hidden">
    <!-- Enhanced Preloader with 3 Second Duration -->
    <div id="preloader" class="fixed inset-0 bg-gradient-to-br from-blue-50 via-white to-yellow-50 z-50 flex items-center justify-center">
        <div class="text-center">
            <div class="relative">
                <div class="w-40 h-40 blue-yellow-gradient rounded-full animate-morph flex items-center justify-center loader-circle">
                    <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center loader-pulse">
                        <i class="fas fa-tshirt text-5xl text-gradient"></i>
                    </div>
                </div>
                <div class="absolute inset-0 blue-yellow-gradient rounded-full opacity-30 animate-ping"></div>
                <div class="absolute inset-0 blue-yellow-gradient-reverse rounded-full opacity-20 animate-ping" style="animation-delay: 0.5s;"></div>
            </div>
            <div class="loading-text mt-8">
                Loading Excellence...
            </div>
            <div class="mt-4 flex justify-center space-x-2">
                <div class="w-3 h-3 bg-blue-500 rounded-full animate-bounce"></div>
                <div class="w-3 h-3 bg-blue-500 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                <div class="w-3 h-3 bg-yellow-500 rounded-full animate-bounce" style="animation-delay: 0.4s;"></div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav id="navbar" class="fixed w-full z-40 glass-effect py-4 transition-all duration-300">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <a href="#" class="logo text-2xl font-bold text-dark flex items-center">
                    <div class="w-12 h-12 blue-gradient rounded-full flex items-center justify-center mr-3 animate-pulse-glow">
                        <i class="fas fa-tshirt text-white text-xl"></i>
                    </div>
                    <span>MONTI<span class="text-gradient">TEXTILE</span></span>
                </a>
                
                <div class="hidden md:flex space-x-10">
                    <a href="#home" class="nav-link text-dark hover:text-gradient font-medium transition-all duration-300 relative group">
                        <span class="relative z-10">Home</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-yellow-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#about" class="nav-link text-dark hover:text-gradient font-medium transition-all duration-300 relative group">
                        <span class="relative z-10">About</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-yellow-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#fabrics" class="nav-link text-dark hover:text-gradient font-medium transition-all duration-300 relative group">
                        <span class="relative z-10">Fabrics</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-yellow-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#collections" class="nav-link text-dark hover:text-gradient font-medium transition-all duration-300 relative group">
                        <span class="relative z-10">Collections</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-yellow-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#sustainability" class="nav-link text-dark hover:text-gradient font-medium transition-all duration-300 relative group">
                        <span class="relative z-10">Sustainability</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-yellow-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="#contact" class="nav-link text-dark hover:text-gradient font-medium transition-all duration-300 relative group">
                        <span class="relative z-10">Contact</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-yellow-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('apply') }}" class="btn-hover-effect relative overflow-hidden blue-gradient text-white px-8 py-3 rounded-full font-medium hover:shadow-2xl transition-all duration-300 group transform hover:scale-105">
                        <span class="relative z-10">Apply Now</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-yellow-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                    </a>
                    <button id="mobile-menu-button" class="md:hidden text-dark">
                        <div class="w-10 h-10 rounded-full blue-gradient flex items-center justify-center">
                            <i class="fas fa-bars text-white"></i>
                        </div>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden mt-4 hidden">
                <div class="flex flex-col space-y-4 bg-white p-6 rounded-2xl shadow-2xl">
                    <a href="#home" class="mobile-link text-dark hover:text-gradient font-medium py-2 border-b border-gray-100 transition-all duration-300">Home</a>
                    <a href="#about" class="mobile-link text-dark hover:text-gradient font-medium py-2 border-b border-gray-100 transition-all duration-300">About</a>
                    <a href="#fabrics" class="mobile-link text-dark hover:text-gradient font-medium py-2 border-b border-gray-100 transition-all duration-300">Fabrics</a>
                    <a href="#collections" class="mobile-link text-dark hover:text-gradient font-medium py-2 border-b border-gray-100 transition-all duration-300">Collections</a>
                    <a href="#sustainability" class="mobile-link text-dark hover:text-gradient font-medium py-2 border-b border-gray-100 transition-all duration-300">Sustainability</a>
                    <a href="#contact" class="mobile-link text-dark hover:text-gradient font-medium py-2 transition-all duration-300">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen pt-24 pb-20 md:pt-32 md:pb-28 relative overflow-hidden">
        <!-- Animated Background -->
        <div class="particles" id="particles-js"></div>
        
        <div class="absolute inset-0 blue-gradient opacity-5"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="lg:w-1/2 mb-16 lg:mb-0">
                    <div class="fade-on-scroll">
                        <h1 class="text-3xl md:text-7xl lg:text-8xl font-bold mb-8 leading-tight">
                            WEAVING THE FUTURE OF TEXTILES
                        </h1>
                        <p class="text-xl text-gray-600 mb-10 max-w-2xl leading-relaxed">
                            Monti Textile revolutionizes the textile industry with innovative fabrics that blend cutting-edge technology, sustainable practices, and breathtaking design.
                        </p>
                        
                        <div class="flex flex-wrap gap-6 mb-16">
                            <a href="#collections" class="btn-hover-effect group relative overflow-hidden blue-gradient text-white px-10 py-4 rounded-full font-bold text-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                                <span class="relative z-10 flex items-center">
                                    <i class="fas fa-gem mr-3"></i> Explore Collections
                                    <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform duration-300"></i>
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-yellow-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                            </a>
                            
                            <a href="#about" class="btn-hover-effect group relative overflow-hidden border-2 border-blue-500 text-blue-600 px-10 py-4 rounded-full font-bold text-lg hover:text-white transition-all duration-300 transform hover:scale-105">
                                <span class="relative z-10 flex items-center">
                                    <i class="fas fa-play-circle mr-3"></i> Our Story
                                </span>
                                <div class="absolute inset-0 bg-blue-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                                <div class="w-16 h-16 blue-gradient rounded-full flex items-center justify-center mb-4 mx-auto animate-pulse-glow">
                                    <i class="fas fa-leaf text-white text-2xl"></i>
                                </div>
                                <h3 class="font-bold text-center text-gray-800">Eco-Friendly</h3>
                                <p class="text-sm text-center text-gray-600">Sustainable materials</p>
                            </div>
                            
                            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                                <div class="w-16 h-16 yellow-gradient rounded-full flex items-center justify-center mb-4 mx-auto animate-pulse-glow">
                                    <i class="fas fa-award text-white text-2xl"></i>
                                </div>
                                <h3 class="font-bold text-center text-gray-800">Premium Quality</h3>
                                <p class="text-sm text-center text-gray-600">Award-winning fabrics</p>
                            </div>
                            
                            <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                                <div class="w-16 h-16 blue-gradient rounded-full flex items-center justify-center mb-4 mx-auto animate-pulse-glow">
                                    <i class="fas fa-shipping-fast text-white text-2xl"></i>
                                </div>
                                <h3 class="font-bold text-center text-gray-800">Global Shipping</h3>
                                <p class="text-sm text-center text-gray-600">Fast delivery worldwide</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/2 flex justify-center relative">
                    <div class="relative">
                        <!-- Main floating element -->
                        <div class="w-96 h-96 blue-yellow-gradient animate-gradient-shift rounded-full animate-float relative overflow-hidden shadow-2xl">
                            <div class="absolute inset-8 bg-white rounded-full"></div>
                            <div class="absolute inset-16 bg-gradient-to-br from-blue-50 to-yellow-50 rounded-full flex items-center justify-center">
                                <i class="fas fa-tshirt text-gradient text-9xl animate-spin-slow"></i>
                            </div>
                        </div>
                        
                        <!-- Floating fabric elements -->
                        <div class="absolute top-0 left-0 w-32 h-32 bg-blue-500/20 rounded-2xl -rotate-12 animate-wave shadow-lg"></div>
                        <div class="absolute bottom-10 -right-10 w-40 h-40 bg-yellow-500/20 rounded-3xl rotate-12 animate-wave shadow-lg" style="animation-delay: 1s;"></div>
                        <div class="absolute top-1/2 -left-16 w-24 h-24 bg-blue-500/30 rounded-xl -rotate-45 animate-wave shadow-lg" style="animation-delay: 2s;"></div>
                        <div class="absolute bottom-20 left-20 w-20 h-20 bg-yellow-500/30 rounded-full rotate-45 animate-wave shadow-lg" style="animation-delay: 3s;"></div>
                        
                        <!-- Ripple effects -->
                        <div class="absolute inset-0 border-4 border-blue-500/30 rounded-full animate-ping"></div>
                        <div class="absolute inset-8 border-4 border-yellow-500/30 rounded-full animate-ping" style="animation-delay: 0.5s;"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2">
            <div class="w-10 h-16 border-2 border-blue-500 rounded-full flex justify-center">
                <div class="w-1 h-3 bg-gradient-to-b from-blue-500 to-yellow-500 rounded-full mt-2 animate-bounce-smooth"></div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-gradient-to-b from-white to-blue-50 relative overflow-hidden">
        <!-- Background pattern -->
        <div class="absolute inset-0 opacity-5 fabric-overlay"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-20 fade-on-scroll">
                <h2 class="text-5xl md:text-6xl font-bold mb-6">
                    <span class="text-dark">Crafting</span> 
                    <span class="text-gradient">Excellence</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    For over two decades, Monti Textile has been pioneering textile innovation, blending artisanal craftsmanship with cutting-edge technology.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="fade-on-scroll">
                    <div class="grid grid-cols-2 gap-8 mb-12">
                        <div class="card-3d bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl">
                            <div class="text-5xl text-gradient mb-6">
                                <i class="fas fa-palette"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-4">Color Innovation</h3>
                            <p class="text-gray-600">Revolutionary dyeing techniques that deliver vibrant, long-lasting colors.</p>
                        </div>
                        
                        <div class="card-3d bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl">
                            <div class="text-5xl text-gradient mb-6">
                                <i class="fas fa-industry"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-4">Smart Weaving</h3>
                            <p class="text-gray-600">AI-powered looms for unprecedented precision and pattern complexity.</p>
                        </div>
                        
                        <div class="card-3d bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl">
                            <div class="text-5xl text-gradient mb-6">
                                <i class="fas fa-microscope"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-4">Nano Technology</h3>
                            <p class="text-gray-600">Advanced fabric treatments for stain resistance and enhanced durability.</p>
                        </div>
                        
                        <div class="card-3d bg-white p-8 rounded-3xl shadow-xl hover:shadow-2xl">
                            <div class="text-5xl text-gradient mb-6">
                                <i class="fas fa-recycle"></i>
                            </div>
                            <h3 class="text-2xl font-bold mb-4">Circular Design</h3>
                            <p class="text-gray-600">Closed-loop systems ensuring zero waste in our production process.</p>
                        </div>
                    </div>
                </div>
                
                <div class="fade-on-scroll" style="animation-delay: 0.3s;">
                    <div class="relative">
                        <div class="bg-gradient-to-br from-blue-500 to-yellow-500 p-1 rounded-3xl">
                            <div class="bg-white p-8 rounded-3xl">
                                <div class="grid grid-cols-3 gap-8 text-center">
                                    <div>
                                        <div class="text-5xl font-bold text-gradient mb-2 counter" data-target="22">0</div>
                                        <div class="text-gray-600 text-sm">Years Experience</div>
                                    </div>
                                    <div>
                                        <div class="text-5xl font-bold text-gradient mb-2 counter" data-target="500">0</div>
                                        <div class="text-gray-600 text-sm">Fabric Varieties</div>
                                    </div>
                                    <div>
                                        <div class="text-5xl font-bold text-gradient mb-2 counter" data-target="10000">0</div>
                                        <div class="text-gray-600 text-sm">Happy Clients</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-12 bg-white p-8 rounded-3xl shadow-xl transform hover:-translate-y-2 transition-all duration-300">
                            <h3 class="text-2xl font-bold mb-6 text-gradient">Our Mission</h3>
                            <p class="text-gray-600 mb-6 leading-relaxed">
                                To redefine textile manufacturing through sustainable innovation, creating fabrics that inspire designers while preserving our planet.
                            </p>
                            <div class="flex items-center">
                                <div class="w-12 h-12 blue-gradient rounded-full flex items-center justify-center mr-4 animate-pulse-glow">
                                    <i class="fas fa-bullseye text-white"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold">Vision 2030</h4>
                                    <p class="text-sm text-gray-600">100% renewable energy & zero-waste production</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fabric Showcase -->
    <section id="fabrics" class="py-24 bg-gradient-to-b from-blue-50 to-white relative overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="text-center mb-20 fade-on-scroll">
                <h2 class="text-5xl md:text-6xl font-bold mb-6">
                    <span class="text-gradient">Signature</span> 
                    <span class="text-dark">Fabrics</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Experience our revolutionary fabric collection, where innovation meets unparalleled quality and sustainability.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <div class="card-3d group bg-white rounded-3xl shadow-xl overflow-hidden fade-on-scroll">
                    <div class="h-64 relative overflow-hidden">
                        <div class="absolute inset-0 blue-gradient animate-gradient-shift flex items-center justify-center">
                            <i class="fas fa-water text-white text-8xl opacity-30"></i>
                        </div>
                        <div class="absolute inset-0 animate-shimmer"></div>
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full">
                            <span class="text-gradient font-bold">Best Seller</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold mb-3 group-hover:text-gradient transition-colors duration-300">AquaWeave™ Cotton</h3>
                        <p class="text-gray-600 mb-6">Self-cleaning nanotechnology with enhanced breathability and UV protection.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-gradient">$29.99/yd</span>
                            <button class="btn-hover-effect group relative overflow-hidden blue-gradient text-white px-6 py-3 rounded-full font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                <span class="relative z-10">View Details</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-yellow-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="card-3d group bg-white rounded-3xl shadow-xl overflow-hidden fade-on-scroll" style="animation-delay: 0.2s;">
                    <div class="h-64 relative overflow-hidden">
                        <div class="absolute inset-0 yellow-gradient animate-gradient-shift flex items-center justify-center">
                            <i class="fas fa-gem text-white text-8xl opacity-30"></i>
                        </div>
                        <div class="absolute inset-0 animate-shimmer"></div>
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full">
                            <span class="text-gradient font-bold">Luxury</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold mb-3 group-hover:text-gradient transition-colors duration-300">SolarSilk™ Blend</h3>
                        <p class="text-gray-600 mb-6">Temperature-regulating smart fabric with built-in solar-reactive pigments.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-gradient">$59.99/yd</span>
                            <button class="btn-hover-effect group relative overflow-hidden blue-gradient text-white px-6 py-3 rounded-full font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                <span class="relative z-10">View Details</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-yellow-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="card-3d group bg-white rounded-3xl shadow-xl overflow-hidden fade-on-scroll" style="animation-delay: 0.4s;">
                    <div class="h-64 relative overflow-hidden">
                        <div class="absolute inset-0 blue-gradient animate-gradient-shift flex items-center justify-center">
                            <i class="fas fa-leaf text-white text-8xl opacity-30"></i>
                        </div>
                        <div class="absolute inset-0 animate-shimmer"></div>
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full">
                            <span class="text-gradient font-bold">Eco-Friendly</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold mb-3 group-hover:text-gradient transition-colors duration-300">BioLinen™ Pro</h3>
                        <p class="text-gray-600 mb-6">100% biodegradable performance linen with natural antimicrobial properties.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-gradient">$39.99/yd</span>
                            <button class="btn-hover-effect group relative overflow-hidden blue-gradient text-white px-6 py-3 rounded-full font-medium hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                <span class="relative z-10">View Details</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-yellow-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Collections Section -->
    <section id="collections" class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 blue-gradient opacity-10"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-20 fade-on-scroll">
                <h2 class="text-5xl md:text-6xl font-bold mb-6">
                    <span class="text-dark">2023</span> 
                    <span class="text-gradient animate-neon-glow">Collections</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Discover our limited edition collections that push the boundaries of textile design and innovation.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
                <div class="fade-on-scroll">
                    <div class="relative">
                        <div class="bg-gradient-to-br from-blue-500 to-yellow-500 p-1 rounded-3xl">
                            <div class="bg-white p-2 rounded-3xl">
                                <div class="h-96 rounded-2xl bg-gradient-to-br from-blue-100 to-yellow-100 flex items-center justify-center overflow-hidden">
                                    <i class="fas fa-tshirt text-gradient text-9xl animate-float"></i>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-gradient-to-br from-yellow-500 to-blue-500 rounded-full opacity-20 animate-pulse"></div>
                    </div>
                </div>
                
                <div class="fade-on-scroll" style="animation-delay: 0.3s;">
                    <h3 class="text-4xl font-bold mb-6">
                        <span class="text-gradient">Nebula</span> 
                        <span class="text-dark">Collection</span>
                    </h3>
                    <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                        Inspired by cosmic phenomena, this collection features fabrics that change color with temperature and light exposure. Each piece tells a unique story through its dynamic patterns.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-center transform hover:translate-x-2 transition-transform duration-300">
                            <div class="w-12 h-12 blue-gradient rounded-full flex items-center justify-center mr-4 animate-pulse-glow">
                                <i class="fas fa-palette text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Chromatic Shift Technology</h4>
                                <p class="text-gray-600">Colors transform with environmental changes</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center transform hover:translate-x-2 transition-transform duration-300">
                            <div class="w-12 h-12 yellow-gradient rounded-full flex items-center justify-center mr-4 animate-pulse-glow">
                                <i class="fas fa-microchip text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Smart Fiber Integration</h4>
                                <p class="text-gray-600">Embedded micro-technology for enhanced functionality</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center transform hover:translate-x-2 transition-transform duration-300">
                            <div class="w-12 h-12 blue-gradient rounded-full flex items-center justify-center mr-4 animate-pulse-glow">
                                <i class="fas fa-recycle text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg">Zero Waste Production</h4>
                                <p class="text-gray-600">100% sustainable manufacturing process</p>
                            </div>
                        </div>
                    </div>
                    
                    <button class="btn-hover-effect group mt-10 relative overflow-hidden blue-gradient text-white px-10 py-4 rounded-full font-bold text-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                        <span class="relative z-10 flex items-center">
                            Explore Collection
                            <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform duration-300"></i>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-yellow-500 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Sustainability Section -->
    <section id="sustainability" class="py-24 bg-gradient-to-b from-white to-blue-50 relative overflow-hidden">
        <div class="absolute inset-0 fabric-overlay"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="text-center mb-20 fade-on-scroll">
                <h2 class="text-5xl md:text-6xl font-bold mb-6">
                    <span class="text-gradient">Sustainable</span> 
                    <span class="text-dark">Innovation</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    We're committed to revolutionizing the textile industry through eco-conscious practices and groundbreaking sustainability initiatives.
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mb-16">
                <div class="fade-on-scroll">
                    <div class="bg-white rounded-3xl p-8 shadow-xl h-full transform hover:-translate-y-3 transition-all duration-300">
                        <div class="w-20 h-20 blue-gradient rounded-full flex items-center justify-center mb-6 animate-pulse-glow">
                            <i class="fas fa-tint text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Water Conservation</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Our closed-loop system recycles 95% of water used in production, saving millions of gallons annually.</p>
                        <div class="text-4xl font-bold text-gradient">92%</div>
                        <div class="text-gray-600">Water recycled</div>
                    </div>
                </div>
                
                <div class="fade-on-scroll" style="animation-delay: 0.2s;">
                    <div class="bg-white rounded-3xl p-8 shadow-xl h-full transform hover:-translate-y-3 transition-all duration-300">
                        <div class="w-20 h-20 yellow-gradient rounded-full flex items-center justify-center mb-6 animate-pulse-glow">
                            <i class="fas fa-solar-panel text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Renewable Energy</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Our factories are powered by 100% renewable energy sources, significantly reducing carbon emissions.</p>
                        <div class="text-4xl font-bold text-gradient">100%</div>
                        <div class="text-gray-600">Renewable energy</div>
                    </div>
                </div>
                
                <div class="fade-on-scroll" style="animation-delay: 0.4s;">
                    <div class="bg-white rounded-3xl p-8 shadow-xl h-full transform hover:-translate-y-3 transition-all duration-300">
                        <div class="w-20 h-20 blue-gradient rounded-full flex items-center justify-center mb-6 animate-pulse-glow">
                            <i class="fas fa-recycle text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Circular Economy</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">We've implemented a zero-waste production model that repurposes all textile waste into new materials.</p>
                        <div class="text-4xl font-bold text-gradient">78%</div>
                        <div class="text-gray-600">Waste reduction</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section id="contact" class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 blue-gradient opacity-90"></div>
        <div class="particles" id="contact-particles"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-4xl mx-auto text-center fade-on-scroll">
                <h2 class="text-5xl md:text-6xl font-bold text-white mb-8">
                    Ready to <span class="text-yellow-300">Transform</span> Your Vision?
                </h2>
                <p class="text-xl text-white/90 mb-12 max-w-2xl mx-auto leading-relaxed">
                    Connect with our team of textile experts. Let's create something extraordinary together.
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    <div class="bg-white/10 backdrop-blur-sm p-8 rounded-3xl border border-white/20 transform hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-6 mx-auto">
                            <i class="fas fa-phone text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Call Us</h3>
                        <p class="text-white/80 mb-4">Speak directly with our textile specialists</p>
                        <a href="tel:+15551234567" class="text-2xl font-bold text-white hover:text-yellow-300 transition-colors duration-300">+1 (555) 123-4567</a>
                    </div>
                    
                    <div class="bg-white/10 backdrop-blur-sm p-8 rounded-3xl border border-white/20 transform hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mb-6 mx-auto">
                            <i class="fas fa-envelope text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Email Us</h3>
                        <p class="text-white/80 mb-4">Get a response within 24 hours</p>
                        <a href="mailto:info@montitextile.com" class="text-2xl font-bold text-white hover:text-yellow-300 transition-colors duration-300">info@montitextile.com</a>
                    </div>
                </div>
                
                <div class="bg-white/10 backdrop-blur-sm p-8 rounded-3xl border border-white/20 max-w-2xl mx-auto transform hover:-translate-y-2 transition-all duration-300">
                    <h3 class="text-2xl font-bold text-white mb-6">Request a Sample Kit</h3>
                    <p class="text-white/80 mb-6">Experience our fabrics firsthand with our premium sample kit.</p>
                    <button class="btn-hover-effect group relative overflow-hidden bg-white text-blue-600 px-10 py-4 rounded-full font-bold text-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                        <span class="relative z-10 flex items-center justify-center">
                            <i class="fas fa-box-open mr-3"></i> Get Free Samples
                        </span>
                        <div class="absolute inset-0 bg-yellow-300 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5 fabric-overlay"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <div>
                    <a href="#" class="logo text-2xl font-bold text-white flex items-center mb-6">
                        <div class="w-12 h-12 blue-gradient rounded-full flex items-center justify-center mr-3 animate-pulse-glow">
                            <i class="fas fa-tshirt text-white text-xl"></i>
                        </div>
                        <span>MONTI<span class="text-blue-400">TEXTILE</span></span>
                    </a>
                    <p class="text-gray-400 mb-6">Weaving innovation into every thread since 2001.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-600 transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-pink-600 transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-400 transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-blue-700 transition-all duration-300 transform hover:scale-110">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-xl font-bold mb-6 text-white">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Employee Login</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">About Us</a></li>
                        <li><a href="#fabrics" class="text-gray-400 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Fabrics</a></li>
                        <li><a href="#collections" class="text-gray-400 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Collections</a></li>
                        <li><a href="#sustainability" class="text-gray-400 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Sustainability</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-xl font-bold mb-6 text-white">Services</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Custom Fabric Design</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Bulk Orders</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Sample Kits</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Consultation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Technical Support</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-xl font-bold mb-6 text-white">Contact Info</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt text-blue-400 mt-1 mr-3"></i>
                            <span class="text-gray-400">123 Innovation Drive, Textile City, TC 10101</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone text-blue-400 mr-3"></i>
                            <span class="text-gray-400">+1 (555) 123-4567</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-blue-400 mr-3"></i>
                            <span class="text-gray-400">info@montitextile.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 text-center">
                <p class="text-gray-500">&copy; 2023 Monti Textile. All rights reserved. | <a href="#" class="hover:text-white transition-colors duration-300">Privacy Policy</a> | <a href="#" class="hover:text-white transition-colors duration-300">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 w-14 h-14 blue-gradient text-white rounded-full shadow-2xl hover:shadow-xl transition-all duration-300 opacity-0 transform translate-y-10 z-40 group">
        <i class="fas fa-arrow-up text-xl group-hover:-translate-y-1 transition-transform duration-300"></i>
    </button>

    <!-- Ripple Effect Container -->
    <div id="ripple-container" class="fixed inset-0 pointer-events-none z-30"></div>

    <script>
        // Enhanced Preloader with 3 Second Duration
        window.addEventListener('load', function() {
            setTimeout(() => {
                const preloader = document.getElementById('preloader');
                preloader.style.opacity = '0';
                preloader.style.visibility = 'hidden';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 800);
            }, 3000); // 3 seconds delay
        });

        // Particle System
        function createParticles(containerId, count = 30) {
            const container = document.getElementById(containerId);
            if (!container) return;
            
            for (let i = 0; i < count; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Random properties
                const size = Math.random() * 20 + 5;
                const left = Math.random() * 100;
                const delay = Math.random() * 20;
                const duration = Math.random() * 10 + 15;
                
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${left}%`;
                particle.style.animationDelay = `${delay}s`;
                particle.style.animationDuration = `${duration}s`;
                
                // Random gradient
                const colors = [
                    'linear-gradient(135deg, #2563EB, #60A5FA)',
                    'linear-gradient(135deg, #F59E0B, #FBBF24)',
                    'linear-gradient(135deg, #2563EB, #F59E0B)'
                ];
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                
                container.appendChild(particle);
            }
        }

        // Navbar Scroll Effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
            this.querySelector('i').classList.toggle('fa-bars');
            this.querySelector('i').classList.toggle('fa-times');
        });

        // Back to top button
        const backToTopButton = document.getElementById('back-to-top');
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopButton.classList.remove('opacity-0', 'translate-y-10');
                backToTopButton.classList.add('opacity-100', 'translate-y-0');
            } else {
                backToTopButton.classList.remove('opacity-100', 'translate-y-0');
                backToTopButton.classList.add('opacity-0', 'translate-y-10');
            }
        });

        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    // Close mobile menu if open
                    document.getElementById('mobile-menu').classList.add('hidden');
                    document.getElementById('mobile-menu-button').querySelector('i').classList.add('fa-bars');
                    document.getElementById('mobile-menu-button').querySelector('i').classList.remove('fa-times');
                    
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Scroll animation for elements
        const fadeElements = document.querySelectorAll('.fade-on-scroll');
        
        const fadeInOnScroll = function() {
            fadeElements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < window.innerHeight - elementVisible) {
                    element.classList.add('visible');
                }
            });
        };

        // Check on load and scroll
        window.addEventListener('load', fadeInOnScroll);
        window.addEventListener('scroll', fadeInOnScroll);

        // Counter animation
        const counters = document.querySelectorAll('.counter');
        const speed = 200;
        let counterStarted = false;

        const startCounter = () => {
            if (counterStarted) return;
            counterStarted = true;
            
            counters.forEach(counter => {
                const updateCount = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText.replace(/,/g, '');
                    
                    const inc = target / speed;
                    
                    if (count < target) {
                        counter.innerText = Math.ceil(count + inc).toLocaleString();
                        setTimeout(updateCount, 10);
                    } else {
                        counter.innerText = target.toLocaleString();
                    }
                };
                updateCount();
            });
        };

        // Start counter when in view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !counterStarted) {
                    startCounter();
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => {
            observer.observe(counter);
        });

        // Ripple effect
        document.addEventListener('click', function(e) {
            if (e.target.closest('button, a')) {
                const rippleContainer = document.getElementById('ripple-container');
                const ripple = document.createElement('div');
                
                ripple.className = 'absolute rounded-full bg-gradient-to-r from-blue-500/30 to-yellow-500/30 animate-ripple';
                ripple.style.left = `${e.clientX}px`;
                ripple.style.top = `${e.clientY}px`;
                ripple.style.width = '10px';
                ripple.style.height = '10px';
                
                rippleContainer.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 1500);
            }
        });

        // Enhanced hover effect for cards
        const cards = document.querySelectorAll('.card-3d');
        cards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateY = ((x - centerX) / centerX) * 8;
                const rotateX = ((centerY - y) / centerY) * 8;
                
                card.style.transform = `perspective(1500px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(15px)`;
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1500px) rotateX(0) rotateY(0) translateZ(0)';
            });
        });

        // Create particles after DOM loads
        document.addEventListener('DOMContentLoaded', () => {
            createParticles('particles-js', 40);
            createParticles('contact-particles', 25);
        });

        // Parallax effect for hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('#home');
            if (hero && scrolled < window.innerHeight) {
                hero.style.transform = `translateY(${scrolled * 0.4}px)`;
                hero.style.opacity = 1 - (scrolled / window.innerHeight) * 0.3;
            }
        });

        // Enhanced active navigation highlighting
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.nav-link');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= sectionTop - 100) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('text-gradient');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('text-gradient');
                }
            });
        });
    </script>
</body>
</html>