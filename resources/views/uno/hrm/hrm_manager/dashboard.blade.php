<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HR Manager Dashboard - Monti Textile HRM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        @include('uno.hrm.hrm_manager.style')
    @endif

    <!-- Custom color overrides for gold/blue theme -->
    <style>
        .bg-blue-theme { background-color: #2563eb; }
        .bg-gold-theme { background-color: #d4af37; }
        .bg-emerald-theme { background-color: #059669; }
        .text-blue-theme { color: #2563eb; }
        .text-gold-theme { color: #d4af37; }
        .text-emerald-theme { color: #059669; }
        .border-blue-theme { border-color: #2563eb; }
        .border-gold-theme { border-color: #d4af37; }
        .border-emerald-theme { border-color: #059669; }
        .hover\:bg-blue-theme:hover { background-color: #1d4ed8; }
        .hover\:bg-gold-theme:hover { background-color: #b8860b; }
        .hover\:bg-emerald-theme:hover { background-color: #047857; }
        .dark .bg-blue-theme { background-color: #1e40af; }
        .dark .bg-gold-theme { background-color: #92400e; }
        .dark .bg-emerald-theme { background-color: #065f46; }
        .dark .text-blue-theme { color: #60a5fa; }
        .dark .text-gold-theme { color: #fbbf24; }
        .dark .text-emerald-theme { color: #34d399; }
        
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
        
        .sidebar {
            width: 260px;
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .sidebar.collapsed {
            width: 80px;
        }
        
        .sidebar.collapsed .sidebar-text {
            display: none;
        }
        
        .sidebar-item {
            position: relative;
            transition: all 0.2s ease;
            border-radius: 0.5rem;
        }
        
        .sidebar-item:hover::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            height: 24px;
            width: 4px;
            background: linear-gradient(to bottom, #3b82f6, #60a5fa);
            border-radius: 0 4px 4px 0;
        }
        
        .sidebar-item.active {
            background-color: rgba(59, 130, 246, 0.1);
        }
        
        .sidebar-item.active .sidebar-icon {
            color: #3b82f6;
        }
        
        .main-content {
            transition: margin-left 0.3s ease;
        }
        
        .card {
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            background: white;
        }
        
        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .course-progress {
            height: 8px;
            border-radius: 4px;
            overflow: hidden;
            background-color: #e5e7eb;
        }
        
        .course-progress-fill {
            height: 100%;
            border-radius: 4px;
            background: linear-gradient(to right, #3b82f6, #60a5fa);
            transition: width 1s ease;
        }
        
        .notification-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: linear-gradient(to bottom right, #ef4444, #f87171);
            color: white;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }
        
        .profile-image {
            border: 4px solid #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .nav-tab {
            position: relative;
            padding: 12px 16px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .nav-tab:hover {
            background-color: #f3f4f6;
        }
        
        .nav-tab.active {
            color: #3b82f6;
            font-weight: 500;
        }
        
        .nav-tab.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, #3b82f6, #60a5fa);
            border-radius: 3px 3px 0 0;
        }
        
        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
        }
        
        .status-online {
            background-color: #10b981;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.3);
        }
        
        .status-offline {
            background-color: #94a3b8;
            box-shadow: 0 0 0 2px rgba(148, 163, 184, 0.3);
        }
        
        .search-input:focus {
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
        }
        
        .featured-banner {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            border-radius: 1rem;
            overflow: hidden;
            position: relative;
        }
        
        .staff-status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .staff-status-active {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .staff-status-probation {
            background-color: #fef9c3;
            color: #854d0e;
        }
        
        .staff-status-pending {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .staff-status-inactive {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .promotion-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            margin-right: 8px;
        }
        
        .promotion-eligible {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .promotion-pending {
            background-color: #fef9c3;
            color: #854d0e;
        }
        
        .promotion-not-eligible {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f3f4f6;
            border-radius: 3px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 3px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
        
        /* Mobile Sidebar */
        .mobile-sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        
        .mobile-sidebar-overlay.active {
            display: block;
        }
        
        /* Dark mode adjustments */
        .dark .card {
            background-color: #374151;
            border-color: #4b5563;
        }
        
        .dark .sidebar {
            background-color: #1f2937;
            border-color: #374151;
        }
        
        .dark .sidebar-item:hover {
            background-color: #374151;
        }
        
        .dark .sidebar-item.active {
            background-color: rgba(59, 130, 246, 0.2);
        }
        
        .dark .featured-banner {
            background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
        }
        
        .dark .staff-status-active {
            background-color: #14532d;
            color: #86efac;
        }
        
        .dark .staff-status-probation {
            background-color: #713f12;
            color: #fde047;
        }
        
        .dark .staff-status-pending {
            background-color: #1e3a8a;
            color: #93c5fd;
        }
        
        .dark .staff-status-inactive {
            background-color: #7f1d1d;
            color: #fca5a5;
        }
        
        .dark .promotion-eligible {
            background-color: #14532d;
            color: #86efac;
        }
        
        .dark .promotion-pending {
            background-color: #713f12;
            color: #fde047;
        }
        
        .dark .promotion-not-eligible {
            background-color: #7f1d1d;
            color: #fca5a5;
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                height: 100%;
                top: 0;
                left: 0;
                background: white;
            }
            
            .dark .sidebar {
                background-color: #1f2937;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0 !important;
                width: 100%;
            }
            
            .search-input {
                width: 100%;
            }
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .main-grid {
                grid-template-columns: 1fr;
            }
            
            .header-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .header-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .featured-banner {
                text-align: center;
                padding: 1.5rem !important;
            }
            
            .featured-banner-content {
                padding-right: 0 !important;
            }
            
            .featured-banner img {
                display: none;
            }
            
            .instructors-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .instructors-grid {
                grid-template-columns: 1fr;
            }
            
            .header-title {
                font-size: 1.5rem;
            }
            
            .featured-banner {
                text-align: center;
            }
            
            .featured-banner-button {
                width: 100%;
            }
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <!-- Mobile Overlay -->
    <div class="mobile-sidebar-overlay" id="mobile-overlay"></div>

    <!-- Sidebar -->
 @include('uno.hrm.hrm_manager.SideBarHrManager')

    <!-- Main Content -->
    <div class="main-content flex-1 ml-64 min-h-screen flex flex-col" id="main-content">
        <!-- Top Header -->
        <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 py-4 px-8 flex items-center justify-between sticky top-0 z-10">
            <div class="header-content flex items-center justify-between w-full">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white header-title">HR Manager Dashboard</h1>
                    <p class="text-gray-500 dark:text-gray-400 hidden md:block">Staff Management & Promotions Authority</p>
                </div>
                
                <div class="flex items-center space-x-4 header-actions">
                    <div class="flex items-center space-x-3">
                        <button class="md:hidden p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300" id="mobile-search-toggle">
                            <i class="fas fa-search"></i>
                        </button>
                        
                        <button class="relative p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        
                        <button class="md:hidden p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300" id="mobile-menu-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <div class="w-10 h-10 rounded-xl bg-gold-100 dark:bg-gold-900 flex items-center justify-center text-gold-700 dark:text-gold-300 font-medium hidden md:flex">
                            HM
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-8 overflow-y-auto custom-scrollbar">
            <!-- HR Manager Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 stats-grid">
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-gold-100 dark:bg-gold-900 flex items-center justify-center mr-4">
                        <i class="fas fa-user-tie text-gold-600 dark:text-gold-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Total HR Staff</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">24</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center mr-4">
                        <i class="fas fa-medal text-emerald-600 dark:text-emerald-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Eligible for Promotion</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">8</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-4">
                        <i class="fas fa-chart-line text-blue-600 dark:text-blue-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Promotion Rate</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">85%</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900 flex items-center justify-center mr-4">
                        <i class="fas fa-award text-purple-600 dark:text-purple-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Avg. Tenure</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">3.5 yrs</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 main-grid">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- HR Manager Banner -->
                    <div class="featured-banner">
                        <div class="p-8">
                            <div class="flex flex-col md:flex-row items-center justify-between">
                                <div class="featured-banner-content mb-6 md:mb-0">
                                    <h2 class="text-2xl font-bold mb-3 text-white">HR Manager Command Center</h2>
                                    <p class="text-blue-100 mb-6 max-w-lg">Manage HR staff, review performance, and authorize promotions across all departments.</p>
                                    <button class="px-6 py-3 bg-gold-theme hover:bg-gold-600 text-white font-semibold rounded-xl transition-colors shadow-md flex items-center featured-banner-button" id="promote-all-btn">
                                        <i class="fas fa-bolt mr-2"></i> Promote All Eligible Staff
                                    </button>
                                </div>
                                <div class="featured-banner-image animate-float">
                                    <div class="w-48 h-32 bg-gradient-to-r from-gold-400 to-gold-300 dark:from-gold-500 dark:to-gold-400 rounded-lg shadow-xl flex items-center justify-center">
                                        <i class="fas fa-user-shield text-white text-4xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- HR Staff Management Tools -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-bold text-xl text-gray-900 dark:text-white">HR Staff Management Tools</h3>
                            <a href="#" class="text-blue-theme font-medium flex items-center hover:text-blue-700 dark:hover:text-blue-400 text-sm">
                                All Functions <i class="fas fa-chevron-right ml-2 text-xs"></i>
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 transition-colors">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-12 h-12 rounded-lg bg-gold-theme flex items-center justify-center">
                                        <i class="fas fa-chart-bar text-white text-xl"></i>
                                    </div>
                                    <span class="bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 text-xs font-medium px-2 py-1 rounded">ANALYTICS</span>
                                </div>
                                <h4 class="font-bold text-gray-900 dark:text-white text-lg mb-1">Performance Reviews</h4>
                                <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Evaluate HR staff performance</p>
                                
                                <div class="mb-3">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600 dark:text-gray-300">Review Completion</span>
                                        <span class="text-blue-theme font-medium">78%</span>
                                    </div>
                                    <div class="course-progress">
                                        <div class="course-progress-fill" style="width: 78%"></div>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
                                    <span>18 Reviews</span>
                                    <span>5 Pending</span>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 transition-colors">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-12 h-12 rounded-lg bg-emerald-600 flex items-center justify-center">
                                        <i class="fas fa-user-check text-white text-xl"></i>
                                    </div>
                                    <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-medium px-2 py-1 rounded">PROMOTIONS</span>
                                </div>
                                <h4 class="font-bold text-gray-900 dark:text-white text-lg mb-1">Promotion Authority</h4>
                                <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Approve staff promotions</p>
                                
                                <div class="mb-3">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600 dark:text-gray-300">Approval Rate</span>
                                        <span class="text-blue-theme font-medium">92%</span>
                                    </div>
                                    <div class="course-progress">
                                        <div class="course-progress-fill" style="width: 92%"></div>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
                                    <span>8 Eligible</span>
                                    <span>24 Total Staff</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="space-y-8">
                    <!-- HR Manager Profile Card -->
                    <div class="card p-6">
                          <div class="card p-6 content-fade-in stagger-delay-3">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-bold text-xl text-gray-900 dark:text-white">Onboarding Checklist</h3>
                            <button class="px-3 py-1.5 bg-emerald-theme hover:bg-emerald-700 text-white rounded-lg text-sm font-medium transition-colors" id="add-checklist-btn">
                                <i class="fas fa-plus mr-1"></i> Add Task
                            </button>
                        </div>
                        
                        <div class="space-y-4" id="onboarding-checklist">
                            <!-- Onboarding steps will be loaded dynamically -->
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">Progress: 0/0 tasks completed</div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-emerald-theme h-2 rounded-full" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    <!-- Promotion Statistics -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Promotion Statistics</h3>
                            <a href="#" class="text-blue-theme text-sm font-medium hover:text-blue-700 dark:hover:text-blue-400">View Details</a>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center mr-3">
                                        <i class="fas fa-check-circle text-emerald-600 dark:text-emerald-300"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">ELIGIBLE STAFF</h4>
                                        <p class="text-gray-500 dark:text-gray-400 text-xs">Ready for promotion</p>
                                    </div>
                                </div>
                                <span class="text-gray-500 dark:text-gray-400 text-sm font-medium">8</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-3">
                                        <i class="fas fa-clock text-blue-600 dark:text-blue-300"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">PENDING REVIEW</h4>
                                        <p class="text-gray-500 dark:text-gray-400 text-xs">Under evaluation</p>
                                    </div>
                                </div>
                                <span class="text-gray-500 dark:text-gray-400 text-sm font-medium">5</span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-gold-100 dark:bg-gold-900 flex items-center justify-center mr-3">
                                        <i class="fas fa-trophy text-gold-600 dark:text-gold-300"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">PROMOTED THIS YEAR</h4>
                                        <p class="text-gray-500 dark:text-gray-400 text-xs">2023 promotions</p>
                                    </div>
                                </div>
                                <span class="text-gray-500 dark:text-gray-400 text-sm font-medium">12</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- HR Staff List with Promotion Controls -->
            <div class="mt-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-xl text-gray-900 dark:text-white">HR Staff Management</h3>
                    <div class="flex space-x-3">
                        <button class="px-4 py-2 bg-blue-theme hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors flex items-center">
                            <i class="fas fa-filter mr-2"></i> Filter Staff
                        </button>
                        <button class="px-4 py-2 bg-emerald-theme hover:bg-emerald-700 text-white rounded-lg text-sm font-medium transition-colors flex items-center" id="select-all-btn">
                            <i class="fas fa-check-double mr-2"></i> Select All
                        </button>
                    </div>
                </div>
                
                <div class="card p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700">
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        <input type="checkbox" id="select-all-checkbox" class="rounded border-gray-300 text-blue-theme focus:ring-blue-500">
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">HR Staff</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Position</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Department</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tenure</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Promotion Eligibility</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700" id="staff-table-body">
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="staff-checkbox rounded border-gray-300 text-blue-theme focus:ring-blue-500" data-id="1">
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 font-medium">
                                                SD
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">Sarah Dela Cruz</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">EMP-HR-001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">HR Director</td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                            Executive
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        5.2 years<br>
                                        <span class="text-gray-500 dark:text-gray-400 text-xs">Since 2018</span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="staff-status-badge staff-status-active">
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="promotion-badge promotion-eligible">
                                                <i class="fas fa-check text-xs"></i>
                                            </div>
                                            <span class="text-sm text-gray-900 dark:text-white">Eligible</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-gold-600 hover:text-gold-900 dark:text-gold-400 dark:hover:text-gold-300 mr-3 promote-btn" data-id="1" data-name="Sarah Dela Cruz">
                                            <i class="fas fa-arrow-up mr-1"></i> Promote
                                        </button>
                                        <button class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 view-btn">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="staff-checkbox rounded border-gray-300 text-blue-theme focus:ring-blue-500" data-id="2">
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center text-purple-600 dark:text-purple-300 font-medium">
                                                MP
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">Michael Perez</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">EMP-HR-002</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">Recruitment Manager</td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">
                                            Recruitment
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        3.8 years<br>
                                        <span class="text-gray-500 dark:text-gray-400 text-xs">Since 2020</span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="staff-status-badge staff-status-active">
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="promotion-badge promotion-eligible">
                                                <i class="fas fa-check text-xs"></i>
                                            </div>
                                            <span class="text-sm text-gray-900 dark:text-white">Eligible</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-gold-600 hover:text-gold-900 dark:text-gold-400 dark:hover:text-gold-300 mr-3 promote-btn" data-id="2" data-name="Michael Perez">
                                            <i class="fas fa-arrow-up mr-1"></i> Promote
                                        </button>
                                        <button class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 view-btn">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="staff-checkbox rounded border-gray-300 text-blue-theme focus:ring-blue-500" data-id="3">
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center text-green-600 dark:text-green-300 font-medium">
                                                AG
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">Anna Gomez</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">EMP-HR-003</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">Payroll Specialist</td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            Payroll
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        2.1 years<br>
                                        <span class="text-gray-500 dark:text-gray-400 text-xs">Since 2021</span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="staff-status-badge staff-status-probation">
                                            Probation
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="promotion-badge promotion-not-eligible">
                                                <i class="fas fa-times text-xs"></i>
                                            </div>
                                            <span class="text-sm text-gray-900 dark:text-white">Not Eligible</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-gray-400 dark:text-gray-600 mr-3 cursor-not-allowed" disabled>
                                            <i class="fas fa-arrow-up mr-1"></i> Promote
                                        </button>
                                        <button class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 view-btn">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="staff-checkbox rounded border-gray-300 text-blue-theme focus:ring-blue-500" data-id="4">
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center text-red-600 dark:text-red-300 font-medium">
                                                RS
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">Robert Santos</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">EMP-HR-004</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">Benefits Administrator</td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                            Benefits
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        4.5 years<br>
                                        <span class="text-gray-500 dark:text-gray-400 text-xs">Since 2019</span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="staff-status-badge staff-status-active">
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="promotion-badge promotion-pending">
                                                <i class="fas fa-clock text-xs"></i>
                                            </div>
                                            <span class="text-sm text-gray-900 dark:text-white">Pending Review</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-gold-600 hover:text-gold-900 dark:text-gold-400 dark:hover:text-gold-300 mr-3 promote-btn" data-id="4" data-name="Robert Santos">
                                            <i class="fas fa-arrow-up mr-1"></i> Promote
                                        </button>
                                        <button class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 view-btn">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Bulk Actions Footer -->
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            <span id="selected-count">0</span> staff selected
                        </div>
                        <div class="flex space-x-3">
                            <button class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg text-sm font-medium transition-colors" id="deselect-all-btn">
                                Deselect All
                            </button>
                            <button class="px-4 py-2 bg-gold-theme hover:bg-gold-600 text-white rounded-lg text-sm font-medium transition-colors flex items-center" id="bulk-promote-btn">
                                <i class="fas fa-arrow-up mr-2"></i> Promote Selected
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Promotion History -->
            <div class="mt-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-xl text-gray-900 dark:text-white">Recent Promotions History</h3>
                    <a href="#" class="text-blue-theme font-medium flex items-center hover:text-blue-700 dark:hover:text-blue-400 text-sm">
                        View Full History <i class="fas fa-chevron-right ml-2 text-xs"></i>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 instructors-grid">
                    <div class="card p-5">
                        <div class="flex items-center mb-4">
                            <div class="rounded-full w-12 h-12 bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 text-xl mr-3">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">Lisa Chen</div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">HR Assistant → HR Officer</div>
                            </div>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            Promoted: Oct 15, 2023
                        </div>
                        <div class="mt-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                <i class="fas fa-check mr-1"></i> Approved
                            </span>
                        </div>
                    </div>
                    
                    <div class="card p-5">
                        <div class="flex items-center mb-4">
                            <div class="rounded-full w-12 h-12 bg-purple-100 dark:bg-purple-900 flex items-center justify-center text-purple-600 dark:text-purple-300 text-xl mr-3">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">David Park</div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">HR Officer → Senior HR</div>
                            </div>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            Promoted: Sep 28, 2023
                        </div>
                        <div class="mt-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                <i class="fas fa-check mr-1"></i> Approved
                            </span>
                        </div>
                    </div>
                    
                    <div class="card p-5">
                        <div class="flex items-center mb-4">
                            <div class="rounded-full w-12 h-12 bg-gold-100 dark:bg-gold-900 flex items-center justify-center text-gold-600 dark:text-gold-300 text-xl mr-3">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <div>
                                <div class="text-gray-500 dark:text-gray-400 text-sm">Maria Cruz</div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Senior HR → HR Manager</div>
                            </div>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            Promoted: Aug 10, 2023
                        </div>
                        <div class="mt-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                <i class="fas fa-check mr-1"></i> Approved
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Promotion Confirmation Modal -->
    <div id="promotion-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-8 max-w-md w-full mx-4">
            <div class="text-center mb-6">
                <div class="w-16 h-16 rounded-full bg-gold-100 dark:bg-gold-900 flex items-center justify-center text-gold-600 dark:text-gold-300 text-2xl mx-auto mb-4">
                    <i class="fas fa-trophy"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2" id="modal-title">Promote Staff</h3>
                <p class="text-gray-600 dark:text-gray-400" id="modal-description">Are you sure you want to promote the selected staff?</p>
            </div>
            
            <div class="space-y-4 mb-6" id="promotion-details">
                <!-- Details will be inserted here -->
            </div>
            
            <div class="flex space-x-3">
                <button class="flex-1 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-xl font-medium transition-colors" id="cancel-promotion">
                    Cancel
                </button>
                <button class="flex-1 py-3 bg-gold-theme hover:bg-gold-600 text-white rounded-xl font-medium transition-colors" id="confirm-promotion">
                    Confirm Promotion
                </button>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileSearchToggle = document.getElementById('mobile-search-toggle');
        const mobileSearchBar = document.getElementById('mobile-search-bar');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        
        // Promotion functionality
        const promoteAllBtn = document.getElementById('promote-all-btn');
        const selectAllBtn = document.getElementById('select-all-btn');
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        const deselectAllBtn = document.getElementById('deselect-all-btn');
        const bulkPromoteBtn = document.getElementById('bulk-promote-btn');
        const staffCheckboxes = document.querySelectorAll('.staff-checkbox');
        const promoteBtns = document.querySelectorAll('.promote-btn');
        const promotionModal = document.getElementById('promotion-modal');
        const cancelPromotionBtn = document.getElementById('cancel-promotion');
        const confirmPromotionBtn = document.getElementById('confirm-promotion');
        const modalTitle = document.getElementById('modal-title');
        const modalDescription = document.getElementById('modal-description');
        const promotionDetails = document.getElementById('promotion-details');
        
        let selectedStaff = [];
        let promotionAction = 'single'; // 'single' or 'bulk' or 'all'
        let currentStaffId = null;
        let currentStaffName = null;
        
        // Function to toggle sidebar
        function toggleSidebar() {
            if (window.innerWidth < 1024) {
                // Mobile behavior
                sidebar.classList.toggle('active');
                mobileOverlay.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
            } else {
                // Desktop behavior
                sidebar.classList.toggle('collapsed');
                mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '80px' : '260px';
            }
        }
        
        // Function to close sidebar on mobile
        function closeSidebar() {
            if (window.innerWidth < 1024) {
                sidebar.classList.remove('active');
                mobileOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }
        
        // Event listeners
        sidebarToggle.addEventListener('click', toggleSidebar);
        mobileMenuToggle.addEventListener('click', toggleSidebar);
        mobileOverlay.addEventListener('click', closeSidebar);
        
        // Initialize progress animations
        document.addEventListener('DOMContentLoaded', () => {
            const progressBars = document.querySelectorAll('.course-progress-fill');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });
            
            // Handle responsive behavior on load
            if (window.innerWidth < 1024) {
                mainContent.style.marginLeft = '0';
            }
            
            // Initialize selected staff count
            updateSelectedCount();
        });
        
        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth < 1024) {
                mainContent.style.marginLeft = '0';
                sidebar.classList.remove('collapsed');
                
                // Close sidebar if open when resizing to mobile
                if (sidebar.classList.contains('active')) {
                    document.body.style.overflow = '';
                }
            } else {
                // Reset to desktop behavior
                mobileOverlay.classList.remove('active');
                sidebar.classList.remove('active');
                document.body.style.overflow = '';
                
                // Apply collapsed state if needed
                mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '80px' : '260px';
            }
        });
        
        // Update selected count
        function updateSelectedCount() {
            const selected = document.querySelectorAll('.staff-checkbox:checked');
            const count = selected.length;
            document.getElementById('selected-count').textContent = count;
            
            // Update select all checkbox state
            const total = staffCheckboxes.length;
            selectAllCheckbox.checked = count === total && total > 0;
            selectAllCheckbox.indeterminate = count > 0 && count < total;
        }
        
        // Select all functionality
        selectAllBtn.addEventListener('click', () => {
            staffCheckboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            updateSelectedCount();
            showToast('All staff selected for promotion', 'info');
        });
        
        selectAllCheckbox.addEventListener('change', () => {
            staffCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
            updateSelectedCount();
        });
        
        // Deselect all functionality
        deselectAllBtn.addEventListener('click', () => {
            staffCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateSelectedCount();
            showToast('All staff deselected', 'info');
        });
        
        // Individual checkbox change
        staffCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });
        
        // Promote all eligible staff
        promoteAllBtn.addEventListener('click', () => {
            promotionAction = 'all';
            const eligibleStaff = Array.from(staffCheckboxes)
                .filter(cb => {
                    const row = cb.closest('tr');
                    const eligibility = row.querySelector('.promotion-badge');
                    return eligibility && eligibility.classList.contains('promotion-eligible');
                })
                .map(cb => {
                    const row = cb.closest('tr');
                    const name = row.querySelector('.text-sm.font-medium').textContent;
                    const position = row.querySelector('td:nth-child(3)').textContent;
                    return { name, position };
                });
            
            if (eligibleStaff.length === 0) {
                showToast('No eligible staff found for promotion', 'warning');
                return;
            }
            
            modalTitle.textContent = 'Promote All Eligible Staff';
            modalDescription.textContent = `You are about to promote ${eligibleStaff.length} eligible staff members.`;
            
            promotionDetails.innerHTML = `
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">Staff to be promoted:</h4>
                    <ul class="space-y-2 max-h-40 overflow-y-auto">
                        ${eligibleStaff.map(staff => `
                            <li class="flex items-center text-sm">
                                <i class="fas fa-user text-blue-500 mr-2"></i>
                                <span class="text-gray-700 dark:text-gray-300">${staff.name}</span>
                                <span class="ml-auto text-gray-500 dark:text-gray-400">${staff.position}</span>
                            </li>
                        `).join('')}
                    </ul>
                </div>
            `;
            
            promotionModal.classList.remove('hidden');
        });
        
        // Bulk promote selected staff
        bulkPromoteBtn.addEventListener('click', () => {
            const selected = Array.from(staffCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => {
                    const row = cb.closest('tr');
                    const name = row.querySelector('.text-sm.font-medium').textContent;
                    const position = row.querySelector('td:nth-child(3)').textContent;
                    const eligibility = row.querySelector('.promotion-badge');
                    const isEligible = eligibility && eligibility.classList.contains('promotion-eligible');
                    return { name, position, isEligible };
                });
            
            if (selected.length === 0) {
                showToast('Please select staff to promote', 'warning');
                return;
            }
            
            const eligibleStaff = selected.filter(s => s.isEligible);
            const ineligibleStaff = selected.filter(s => !s.isEligible);
            
            promotionAction = 'bulk';
            
            modalTitle.textContent = 'Promote Selected Staff';
            modalDescription.textContent = `You are about to promote ${eligibleStaff.length} selected staff members.`;
            
            let detailsHtml = `
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">Staff to be promoted:</h4>
                    <ul class="space-y-2 max-h-40 overflow-y-auto">
            `;
            
            if (eligibleStaff.length > 0) {
                eligibleStaff.forEach(staff => {
                    detailsHtml += `
                        <li class="flex items-center text-sm">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span class="text-gray-700 dark:text-gray-300">${staff.name}</span>
                            <span class="ml-auto text-gray-500 dark:text-gray-400">${staff.position}</span>
                        </li>
                    `;
                });
            }
            
            if (ineligibleStaff.length > 0) {
                detailsHtml += `
                    </ul>
                </div>
                <div class="bg-yellow-50 dark:bg-yellow-900 rounded-lg p-4">
                    <h4 class="font-medium text-yellow-800 dark:text-yellow-300 mb-2">Not eligible for promotion:</h4>
                    <ul class="space-y-2">
                `;
                
                ineligibleStaff.forEach(staff => {
                    detailsHtml += `
                        <li class="flex items-center text-sm">
                            <i class="fas fa-times text-red-500 mr-2"></i>
                            <span class="text-yellow-700 dark:text-yellow-300">${staff.name}</span>
                            <span class="ml-auto text-yellow-600 dark:text-yellow-400">${staff.position}</span>
                        </li>
                    `;
                });
            }
            
            detailsHtml += `
                    </ul>
                </div>
            `;
            
            promotionDetails.innerHTML = detailsHtml;
            promotionModal.classList.remove('hidden');
        });
        
        // Individual promote buttons
        promoteBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                promotionAction = 'single';
                currentStaffId = btn.getAttribute('data-id');
                currentStaffName = btn.getAttribute('data-name');
                
                const row = btn.closest('tr');
                const position = row.querySelector('td:nth-child(3)').textContent;
                const department = row.querySelector('td:nth-child(4) span').textContent;
                const tenure = row.querySelector('td:nth-child(5)').textContent.split('\n')[0];
                
                modalTitle.textContent = `Promote ${currentStaffName}`;
                modalDescription.textContent = `You are about to promote this staff member.`;
                
                promotionDetails.innerHTML = `
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Name:</span>
                                <span class="font-medium text-gray-900 dark:text-white">${currentStaffName}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Current Position:</span>
                                <span class="font-medium text-gray-900 dark:text-white">${position}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Department:</span>
                                <span class="font-medium text-gray-900 dark:text-white">${department}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Tenure:</span>
                                <span class="font-medium text-gray-900 dark:text-white">${tenure}</span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-blue-50 dark:bg-blue-900 rounded-lg p-4">
                        <h4 class="font-medium text-blue-800 dark:text-blue-300 mb-2">New Position:</h4>
                        <select class="w-full input-field">
                            <option>Senior ${position}</option>
                            <option>Lead ${position.split(' ')[0]}</option>
                            <option>${position.split(' ')[0]} Manager</option>
                            <option>Department Head</option>
                        </select>
                    </div>
                `;
                
                promotionModal.classList.remove('hidden');
            });
        });
        
        // Cancel promotion
        cancelPromotionBtn.addEventListener('click', () => {
            promotionModal.classList.add('hidden');
        });
        
        // Confirm promotion
        confirmPromotionBtn.addEventListener('click', () => {
            promotionModal.classList.add('hidden');
            
            if (promotionAction === 'single') {
                // Update single staff
                const row = document.querySelector(`.staff-checkbox[data-id="${currentStaffId}"]`).closest('tr');
                const positionCell = row.querySelector('td:nth-child(3)');
                const oldPosition = positionCell.textContent;
                const newPosition = document.querySelector('#promotion-details select').value;
                
                // Update position
                positionCell.textContent = newPosition;
                
                // Update promotion eligibility
                const eligibilityBadge = row.querySelector('.promotion-badge');
                const eligibilityText = row.querySelector('.promotion-badge + span');
                
                eligibilityBadge.className = 'promotion-badge promotion-pending';
                eligibilityBadge.innerHTML = '<i class="fas fa-clock text-xs"></i>';
                eligibilityText.textContent = 'Recently Promoted';
                
                // Disable promote button
                const promoteBtn = row.querySelector('.promote-btn');
                promoteBtn.disabled = true;
                promoteBtn.className = 'text-gray-400 dark:text-gray-600 mr-3 cursor-not-allowed';
                
                showToast(`${currentStaffName} promoted from ${oldPosition} to ${newPosition}`, 'success');
                
            } else if (promotionAction === 'bulk' || promotionAction === 'all') {
                // Update all selected eligible staff
                const checkboxes = promotionAction === 'all' 
                    ? Array.from(staffCheckboxes).filter(cb => {
                        const row = cb.closest('tr');
                        const eligibility = row.querySelector('.promotion-badge');
                        return eligibility && eligibility.classList.contains('promotion-eligible');
                    })
                    : Array.from(staffCheckboxes).filter(cb => cb.checked);
                
                let promotedCount = 0;
                
                checkboxes.forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    const eligibilityBadge = row.querySelector('.promotion-badge');
                    
                    if (eligibilityBadge && eligibilityBadge.classList.contains('promotion-eligible')) {
                        const name = row.querySelector('.text-sm.font-medium').textContent;
                        const positionCell = row.querySelector('td:nth-child(3)');
                        const oldPosition = positionCell.textContent;
                        const newPosition = `Senior ${oldPosition.split(' ')[0]}`;
                        
                        // Update position
                        positionCell.textContent = newPosition;
                        
                        // Update promotion eligibility
                        const eligibilityText = row.querySelector('.promotion-badge + span');
                        
                        eligibilityBadge.className = 'promotion-badge promotion-pending';
                        eligibilityBadge.innerHTML = '<i class="fas fa-clock text-xs"></i>';
                        eligibilityText.textContent = 'Recently Promoted';
                        
                        // Disable promote button
                        const promoteBtn = row.querySelector('.promote-btn');
                        if (promoteBtn) {
                            promoteBtn.disabled = true;
                            promoteBtn.className = 'text-gray-400 dark:text-gray-600 mr-3 cursor-not-allowed';
                        }
                        
                        promotedCount++;
                    }
                });
                
                // Deselect all checkboxes
                staffCheckboxes.forEach(cb => cb.checked = false);
                updateSelectedCount();
                
                showToast(`${promotedCount} staff members promoted successfully!`, 'success');
            }
        });
        
        // View staff details
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');
                const name = row.querySelector('.text-sm.font-medium').textContent;
                const position = row.querySelector('td:nth-child(3)').textContent;
                
                showToast(`Viewing details for ${name} (${position})`, 'info');
            });
        });
        
        function showToast(message, type) {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-transform duration-300 ${
                type === 'success' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                type === 'warning' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' :
                'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300'
            }`;
            toast.textContent = message;
            
            // Add to DOM
            document.body.appendChild(toast);
            
            // Remove after 3 seconds
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>