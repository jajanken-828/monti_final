<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payroll Management - Monti Textile HRM</title>

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
        
        .payroll-status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .payroll-status-pending {
            background-color: #fef9c3;
            color: #854d0e;
        }
        
        .payroll-status-processing {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .payroll-status-paid {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .payroll-status-failed {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .amount-positive {
            color: #059669;
            font-weight: 600;
        }
        
        .amount-negative {
            color: #dc2626;
            font-weight: 600;
        }
        
        .payroll-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            margin-right: 8px;
        }
        
        .payroll-action-approve {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .payroll-action-reject {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .payroll-action-view {
            background-color: #dbeafe;
            color: #1e40af;
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
        
        .dark .payroll-status-pending {
            background-color: #713f12;
            color: #fde047;
        }
        
        .dark .payroll-status-processing {
            background-color: #1e3a8a;
            color: #93c5fd;
        }
        
        .dark .payroll-status-paid {
            background-color: #14532d;
            color: #86efac;
        }
        
        .dark .payroll-status-failed {
            background-color: #7f1d1d;
            color: #fca5a5;
        }
        
        .dark .payroll-action-approve {
            background-color: #14532d;
            color: #86efac;
        }
        
        .dark .payroll-action-reject {
            background-color: #7f1d1d;
            color: #fca5a5;
        }
        
        .dark .payroll-action-view {
            background-color: #1e3a8a;
            color: #93c5fd;
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
            
            .payroll-period-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .payroll-period-grid {
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
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white header-title">Payroll Management</h1>
                    <p class="text-gray-500 dark:text-gray-400 hidden md:block">Process & Approve Employee Salaries</p>
                </div>
                
                <div class="flex items-center space-x-4 header-actions">
                    <div class="flex items-center space-x-3">
                        <button class="md:hidden p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300" id="mobile-search-toggle">
                            <i class="fas fa-search"></i>
                        </button>
                        
                        <button class="relative p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">5</span>
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
            <!-- Payroll Overview Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 stats-grid">
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-gold-100 dark:bg-gold-900 flex items-center justify-center mr-4">
                        <i class="fas fa-money-bill-wave text-gold-600 dark:text-gold-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Total Payroll</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">₱1,245,800</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center mr-4">
                        <i class="fas fa-user-check text-emerald-600 dark:text-emerald-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Employees Paid</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">156</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-4">
                        <i class="fas fa-clock text-blue-600 dark:text-blue-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Pending Approval</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">24</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900 flex items-center justify-center mr-4">
                        <i class="fas fa-exclamation-circle text-purple-600 dark:text-purple-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Discrepancies</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">3</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 main-grid">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Payroll Processing Banner -->
                    <div class="featured-banner">
                        <div class="p-8">
                            <div class="flex flex-col md:flex-row items-center justify-between">
                                <div class="featured-banner-content mb-6 md:mb-0">
                                    <h2 class="text-2xl font-bold mb-3 text-white">Payroll Processing Center</h2>
                                    <p class="text-blue-100 mb-6 max-w-lg">Review, approve, and process payroll for all departments. Final authority for salary disbursements.</p>
                                    <button class="px-6 py-3 bg-gold-theme hover:bg-gold-600 text-white font-semibold rounded-xl transition-colors shadow-md flex items-center featured-banner-button" id="process-payroll-btn">
                                        <i class="fas fa-bolt mr-2"></i> Process Payroll Run
                                    </button>
                                </div>
                                <div class="featured-banner-image animate-float">
                                    <div class="w-48 h-32 bg-gradient-to-r from-gold-400 to-gold-300 dark:from-gold-500 dark:to-gold-400 rounded-lg shadow-xl flex items-center justify-center">
                                        <i class="fas fa-file-invoice-dollar text-white text-4xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payroll Period Management -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-bold text-xl text-gray-900 dark:text-white">Payroll Period Management</h3>
                            <div class="flex space-x-3">
                                <button class="text-blue-theme font-medium flex items-center hover:text-blue-700 dark:hover:text-blue-400 text-sm">
                                    <i class="fas fa-history mr-2"></i> View History
                                </button>
                                <button class="text-emerald-theme font-medium flex items-center hover:text-emerald-700 dark:hover:text-emerald-400 text-sm">
                                    <i class="fas fa-plus mr-2"></i> New Period
                                </button>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 payroll-period-grid">
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 transition-colors">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-10 h-10 rounded-lg bg-gold-theme flex items-center justify-center">
                                        <i class="fas fa-calendar-check text-white text-lg"></i>
                                    </div>
                                    <span class="payroll-status-badge payroll-status-processing">PROCESSING</span>
                                </div>
                                <h4 class="font-bold text-gray-900 dark:text-white text-lg mb-1">Current Period</h4>
                                <p class="text-gray-500 dark:text-gray-400 text-sm mb-2">Nov 1-15, 2023</p>
                                
                                <div class="mb-3">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600 dark:text-gray-300">Progress</span>
                                        <span class="text-blue-theme font-medium">65%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                        <div class="bg-gold-theme h-2 rounded-full" style="width: 65%"></div>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
                                    <span>Due: Nov 30</span>
                                    <span>156/240</span>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 transition-colors">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-10 h-10 rounded-lg bg-emerald-600 flex items-center justify-center">
                                        <i class="fas fa-check-circle text-white text-lg"></i>
                                    </div>
                                    <span class="payroll-status-badge payroll-status-paid">COMPLETED</span>
                                </div>
                                <h4 class="font-bold text-gray-900 dark:text-white text-lg mb-1">Last Period</h4>
                                <p class="text-gray-500 dark:text-gray-400 text-sm mb-2">Oct 16-31, 2023</p>
                                
                                <div class="mb-3">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600 dark:text-gray-300">Total Paid</span>
                                        <span class="text-emerald-theme font-medium">₱1,189,450</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                        <div class="bg-emerald-600 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
                                    <span>Paid: Oct 31</span>
                                    <span>240/240</span>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 transition-colors">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-10 h-10 rounded-lg bg-blue-600 flex items-center justify-center">
                                        <i class="fas fa-calendar-alt text-white text-lg"></i>
                                    </div>
                                    <span class="payroll-status-badge payroll-status-pending">UPCOMING</span>
                                </div>
                                <h4 class="font-bold text-gray-900 dark:text-white text-lg mb-1">Next Period</h4>
                                <p class="text-gray-500 dark:text-gray-400 text-sm mb-2">Nov 16-30, 2023</p>
                                
                                <div class="mb-3">
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-600 dark:text-gray-300">Starts In</span>
                                        <span class="text-blue-theme font-medium">3 days</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: 15%"></div>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
                                    <span>Starts: Nov 16</span>
                                    <span>Projected: ₱1.2M</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="space-y-8">
                    <!-- Payroll Manager Profile Card -->
                    <div class="card p-6">
                        <div class="flex flex-col items-center text-center">
                            <div class="relative mb-4">
                                <div class="profile-image w-20 h-20 rounded-full bg-gold-theme flex items-center justify-center text-white text-2xl font-bold">
                                    HM
                                </div>
                                <div class="absolute bottom-0 right-0 w-7 h-7 rounded-full bg-blue-theme flex items-center justify-center border-2 border-white dark:border-gray-800 cursor-pointer hover:bg-blue-700">
                                    <i class="fas fa-pen text-xs text-white"></i>
                                </div>
                            </div>
                            
                            <h2 class="font-bold text-lg text-gray-900 dark:text-white">Payroll Manager</h2>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1 flex items-center justify-center">
                                <i class="fas fa-crown mr-1.5 text-gold-theme"></i> 
                                Senior Management
                            </p>
                            
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 mt-5">
                                <div class="bg-gold-theme h-2.5 rounded-full" style="width: 95%"></div>
                            </div>
                            <div class="w-full flex justify-between text-sm text-gray-500 dark:text-gray-400 mt-2">
                                <span>Approval Authority</span>
                                <span class="text-gray-900 dark:text-white font-medium">95%</span>
                            </div>
                            
                            <div class="w-full mt-5 grid grid-cols-2 gap-2">
                                <button class="py-3 bg-blue-theme hover:bg-blue-700 text-white rounded-xl font-medium transition-colors px-4">
                                    Audit Reports
                                </button>
                                <button class="py-3 bg-emerald-theme hover:bg-emerald-700 text-white rounded-xl font-medium transition-colors px-4">
                                    Tax Settings
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Payroll Actions -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Quick Actions</h3>
                            <a href="#" class="text-blue-theme text-sm font-medium hover:text-blue-700 dark:hover:text-blue-400">More Tools</a>
                        </div>
                        
                        <div class="space-y-4">
                            <button class="w-full flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors" id="generate-payslips">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-3">
                                        <i class="fas fa-file-alt text-blue-600 dark:text-blue-300"></i>
                                    </div>
                                    <div class="text-left">
                                        <h4 class="font-medium text-gray-900 dark:text-white">Generate Payslips</h4>
                                        <p class="text-gray-500 dark:text-gray-400 text-xs">For current period</p>
                                    </div>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </button>
                            
                            <button class="w-full flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors" id="export-reports">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center mr-3">
                                        <i class="fas fa-download text-emerald-600 dark:text-emerald-300"></i>
                                    </div>
                                    <div class="text-left">
                                        <h4 class="font-medium text-gray-900 dark:text-white">Export Reports</h4>
                                        <p class="text-gray-500 dark:text-gray-400 text-xs">CSV, Excel, PDF</p>
                                    </div>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </button>
                            
                            <button class="w-full flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors" id="bank-transfer">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-lg bg-gold-100 dark:bg-gold-900 flex items-center justify-center mr-3">
                                        <i class="fas fa-university text-gold-600 dark:text-gold-300"></i>
                                    </div>
                                    <div class="text-left">
                                        <h4 class="font-medium text-gray-900 dark:text-white">Bank Transfer</h4>
                                        <p class="text-gray-500 dark:text-gray-400 text-xs">Initiate bulk transfer</p>
                                    </div>
                                </div>
                                <i class="fas fa-chevron-right text-gray-400"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payroll Approval Queue -->
            <div class="mt-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-xl text-gray-900 dark:text-white">Payroll Approval Queue</h3>
                    <div class="flex space-x-3">
                        <button class="px-4 py-2 bg-blue-theme hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors flex items-center" id="filter-payroll">
                            <i class="fas fa-filter mr-2"></i> Filter
                        </button>
                        <button class="px-4 py-2 bg-emerald-theme hover:bg-emerald-700 text-white rounded-lg text-sm font-medium transition-colors flex items-center" id="select-all-payroll">
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
                                        <input type="checkbox" id="select-all-payroll-checkbox" class="rounded border-gray-300 text-blue-theme focus:ring-blue-500">
                                    </th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Employee</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Department</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Basic Salary</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Allowances</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Deductions</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Net Pay</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700" id="payroll-table-body">
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="payroll-checkbox rounded border-gray-300 text-blue-theme focus:ring-blue-500" data-id="1">
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 font-medium">
                                                SD
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">Sarah Dela Cruz</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">EMP-001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                            Weaving
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">₱28,500</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Monthly</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm amount-positive">+₱3,200</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Overtime: ₱2,800</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm amount-negative">-₱2,450</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Tax: ₱1,850</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-lg font-bold text-gray-900 dark:text-white">₱29,250</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="payroll-status-badge payroll-status-pending">
                                            Pending
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="payroll-action-btn payroll-action-approve mr-2 approve-payroll-btn" data-id="1" data-name="Sarah Dela Cruz">
                                            <i class="fas fa-check text-xs"></i>
                                        </button>
                                        <button class="payroll-action-btn payroll-action-reject mr-2 reject-payroll-btn" data-id="1" data-name="Sarah Dela Cruz">
                                            <i class="fas fa-times text-xs"></i>
                                        </button>
                                        <button class="payroll-action-btn payroll-action-view view-payroll-btn" data-id="1">
                                            <i class="fas fa-eye text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="payroll-checkbox rounded border-gray-300 text-blue-theme focus:ring-blue-500" data-id="2">
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center text-purple-600 dark:text-purple-300 font-medium">
                                                MP
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">Michael Perez</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">EMP-002</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">
                                            Dyeing
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">₱26,800</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Monthly</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm amount-positive">+₱4,500</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Bonus: ₱3,000</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm amount-negative">-₱2,150</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">SSS: ₱850</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-lg font-bold text-gray-900 dark:text-white">₱29,150</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="payroll-status-badge payroll-status-processing">
                                            Processing
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="payroll-action-btn payroll-action-approve mr-2 approve-payroll-btn" data-id="2" data-name="Michael Perez">
                                            <i class="fas fa-check text-xs"></i>
                                        </button>
                                        <button class="payroll-action-btn payroll-action-reject mr-2 reject-payroll-btn" data-id="2" data-name="Michael Perez">
                                            <i class="fas fa-times text-xs"></i>
                                        </button>
                                        <button class="payroll-action-btn payroll-action-view view-payroll-btn" data-id="2">
                                            <i class="fas fa-eye text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="payroll-checkbox rounded border-gray-300 text-blue-theme focus:ring-blue-500" data-id="3">
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center text-green-600 dark:text-green-300 font-medium">
                                                AG
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">Anna Gomez</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">EMP-003</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            Finishing
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">₱24,500</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Monthly</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm amount-positive">+₱2,800</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Allowance: ₱1,200</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm amount-negative">-₱1,980</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">PhilHealth: ₱380</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-lg font-bold text-gray-900 dark:text-white">₱25,320</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="payroll-status-badge payroll-status-paid">
                                            Paid
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="payroll-action-btn payroll-action-view view-payroll-btn" data-id="3">
                                            <i class="fas fa-eye text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="payroll-checkbox rounded border-gray-300 text-blue-theme focus:ring-blue-500" data-id="4">
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center text-red-600 dark:text-red-300 font-medium">
                                                RS
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">Robert Santos</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">EMP-004</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                            Quality Control
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">₱27,300</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Monthly</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm amount-positive">+₱1,500</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Attendance: ₱500</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm amount-negative">-₋₱3,200</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Loan: ₱1,500</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-lg font-bold text-gray-900 dark:text-white">₱25,600</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="payroll-status-badge payroll-status-failed">
                                            Discrepancy
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="payroll-action-btn payroll-action-approve mr-2 approve-payroll-btn" data-id="4" data-name="Robert Santos">
                                            <i class="fas fa-check text-xs"></i>
                                        </button>
                                        <button class="payroll-action-btn payroll-action-reject mr-2 reject-payroll-btn" data-id="4" data-name="Robert Santos">
                                            <i class="fas fa-times text-xs"></i>
                                        </button>
                                        <button class="payroll-action-btn payroll-action-view view-payroll-btn" data-id="4">
                                            <i class="fas fa-eye text-xs"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Bulk Actions Footer -->
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            <span id="selected-payroll-count">0</span> payrolls selected
                        </div>
                        <div class="flex space-x-3">
                            <button class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg text-sm font-medium transition-colors" id="deselect-all-payroll">
                                Deselect All
                            </button>
                            <button class="px-4 py-2 bg-gold-theme hover:bg-gold-600 text-white rounded-lg text-sm font-medium transition-colors flex items-center" id="bulk-approve-btn">
                                <i class="fas fa-check-double mr-2"></i> Approve Selected
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Payroll Transactions -->
            <div class="mt-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-xl text-gray-900 dark:text-white">Recent Payroll Transactions</h3>
                    <a href="#" class="text-blue-theme font-medium flex items-center hover:text-blue-700 dark:hover:text-blue-400 text-sm">
                        View All Transactions <i class="fas fa-chevron-right ml-2 text-xs"></i>
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    <div class="card p-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="rounded-full w-12 h-12 bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 text-xl">
                                <i class="fas fa-money-check"></i>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-gray-900 dark:text-white">₱1,189,450</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Oct 31, 2023</div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-900 dark:text-white font-medium mb-2">October 2nd Half Payroll</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            240 employees processed
                        </div>
                        <div class="mt-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                <i class="fas fa-check-circle mr-1"></i> Completed
                            </span>
                        </div>
                    </div>
                    
                    <div class="card p-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="rounded-full w-12 h-12 bg-purple-100 dark:bg-purple-900 flex items-center justify-center text-purple-600 dark:text-purple-300 text-xl">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-gray-900 dark:text-white">₱1,245,800</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Processing</div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-900 dark:text-white font-medium mb-2">November 1st Half Payroll</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            156/240 processed
                        </div>
                        <div class="mt-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                <i class="fas fa-spinner fa-spin mr-1"></i> Processing
                            </span>
                        </div>
                    </div>
                    
                    <div class="card p-5">
                        <div class="flex items-center justify-between mb-4">
                            <div class="rounded-full w-12 h-12 bg-gold-100 dark:bg-gold-900 flex items-center justify-center text-gold-600 dark:text-gold-300 text-xl">
                                <i class="fas fa-file-excel"></i>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-gray-900 dark:text-white">BIR 2316</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Due Dec 15</div>
                            </div>
                        </div>
                        <div class="text-sm text-gray-900 dark:text-white font-medium mb-2">Annual Tax Reports</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            Year-end tax filing
                        </div>
                        <div class="mt-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                <i class="fas fa-clock mr-1"></i> Pending
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

    <!-- Payroll Approval Modal -->
    <div id="payroll-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-8 max-w-md w-full mx-4">
            <div class="text-center mb-6">
                <div class="w-16 h-16 rounded-full bg-gold-100 dark:bg-gold-900 flex items-center justify-center text-gold-600 dark:text-gold-300 text-2xl mx-auto mb-4">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2" id="modal-title">Approve Payroll</h3>
                <p class="text-gray-600 dark:text-gray-400" id="modal-description">Are you sure you want to approve this payroll?</p>
            </div>
            
            <div class="space-y-4 mb-6" id="payroll-details">
                <!-- Details will be inserted here -->
            </div>
            
            <div class="flex space-x-3">
                <button class="flex-1 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-xl font-medium transition-colors" id="cancel-payroll">
                    Cancel
                </button>
                <button class="flex-1 py-3 bg-gold-theme hover:bg-gold-600 text-white rounded-xl font-medium transition-colors" id="confirm-payroll">
                    Confirm Approval
                </button>
            </div>
        </div>
    </div>

    <!-- Payroll Rejection Modal -->
    <div id="rejection-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-8 max-w-md w-full mx-4">
            <div class="text-center mb-6">
                <div class="w-16 h-16 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center text-red-600 dark:text-red-300 text-2xl mx-auto mb-4">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Reject Payroll</h3>
                <p class="text-gray-600 dark:text-gray-400" id="rejection-description">Please provide a reason for rejecting this payroll.</p>
            </div>
            
            <div class="space-y-4 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Reason for Rejection</label>
                    <select class="w-full input-field" id="rejection-reason">
                        <option value="">Select a reason</option>
                        <option value="discrepancy">Salary Discrepancy</option>
                        <option value="attendance">Attendance Issues</option>
                        <option value="documents">Missing Documents</option>
                        <option value="calculation">Calculation Error</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div id="other-reason-container" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Specify Reason</label>
                    <textarea class="w-full input-field" rows="3" id="other-reason" placeholder="Please specify the reason..."></textarea>
                </div>
            </div>
            
            <div class="flex space-x-3">
                <button class="flex-1 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-xl font-medium transition-colors" id="cancel-rejection">
                    Cancel
                </button>
                <button class="flex-1 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-medium transition-colors" id="confirm-rejection">
                    Confirm Rejection
                </button>
            </div>
        </div>
    </div>

    <script>
        // Toggle sidebar
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        
        // Payroll functionality
        const processPayrollBtn = document.getElementById('process-payroll-btn');
        const selectAllPayrollBtn = document.getElementById('select-all-payroll');
        const selectAllPayrollCheckbox = document.getElementById('select-all-payroll-checkbox');
        const deselectAllPayrollBtn = document.getElementById('deselect-all-payroll');
        const bulkApproveBtn = document.getElementById('bulk-approve-btn');
        const payrollCheckboxes = document.querySelectorAll('.payroll-checkbox');
        const approveBtns = document.querySelectorAll('.approve-payroll-btn');
        const rejectBtns = document.querySelectorAll('.reject-payroll-btn');
        const viewBtns = document.querySelectorAll('.view-payroll-btn');
        const payrollModal = document.getElementById('payroll-modal');
        const rejectionModal = document.getElementById('rejection-modal');
        const cancelPayrollBtn = document.getElementById('cancel-payroll');
        const confirmPayrollBtn = document.getElementById('confirm-payroll');
        const cancelRejectionBtn = document.getElementById('cancel-rejection');
        const confirmRejectionBtn = document.getElementById('confirm-rejection');
        const modalTitle = document.getElementById('modal-title');
        const modalDescription = document.getElementById('modal-description');
        const payrollDetails = document.getElementById('payroll-details');
        const rejectionReason = document.getElementById('rejection-reason');
        const otherReasonContainer = document.getElementById('other-reason-container');
        const otherReason = document.getElementById('other-reason');
        
        // Quick action buttons
        const generatePayslipsBtn = document.getElementById('generate-payslips');
        const exportReportsBtn = document.getElementById('export-reports');
        const bankTransferBtn = document.getElementById('bank-transfer');
        
        let selectedPayroll = [];
        let payrollAction = 'single'; // 'single' or 'bulk'
        let currentPayrollId = null;
        let currentPayrollName = null;
        let currentPayrollAction = 'approve'; // 'approve' or 'reject'
        
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
        
        // Initialize on load
        document.addEventListener('DOMContentLoaded', () => {
            // Handle responsive behavior on load
            if (window.innerWidth < 1024) {
                mainContent.style.marginLeft = '0';
            }
            
            // Initialize selected payroll count
            updateSelectedPayrollCount();
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
        
        // Update selected payroll count
        function updateSelectedPayrollCount() {
            const selected = document.querySelectorAll('.payroll-checkbox:checked');
            const count = selected.length;
            document.getElementById('selected-payroll-count').textContent = count;
            
            // Update select all checkbox state
            const total = payrollCheckboxes.length;
            selectAllPayrollCheckbox.checked = count === total && total > 0;
            selectAllPayrollCheckbox.indeterminate = count > 0 && count < total;
        }
        
        // Select all payroll functionality
        selectAllPayrollBtn.addEventListener('click', () => {
            payrollCheckboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            updateSelectedPayrollCount();
            showToast('All payrolls selected for approval', 'info');
        });
        
        selectAllPayrollCheckbox.addEventListener('change', () => {
            payrollCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllPayrollCheckbox.checked;
            });
            updateSelectedPayrollCount();
        });
        
        // Deselect all functionality
        deselectAllPayrollBtn.addEventListener('click', () => {
            payrollCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateSelectedPayrollCount();
            showToast('All payrolls deselected', 'info');
        });
        
        // Individual checkbox change
        payrollCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedPayrollCount);
        });
        
        // Process payroll run
        processPayrollBtn.addEventListener('click', () => {
            showToast('Initiating payroll processing for current period...', 'info');
            
            // Simulate processing
            setTimeout(() => {
                showToast('Payroll processing completed successfully!', 'success');
            }, 2000);
        });
        
        // Bulk approve selected payroll
        bulkApproveBtn.addEventListener('click', () => {
            const selected = Array.from(payrollCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => {
                    const row = cb.closest('tr');
                    const name = row.querySelector('.text-sm.font-medium').textContent;
                    const netPay = row.querySelector('td:nth-child(7) .text-lg').textContent;
                    const status = row.querySelector('.payroll-status-badge').textContent;
                    return { name, netPay, status };
                });
            
            if (selected.length === 0) {
                showToast('Please select payrolls to approve', 'warning');
                return;
            }
            
            payrollAction = 'bulk';
            currentPayrollAction = 'approve';
            
            modalTitle.textContent = 'Approve Selected Payroll';
            modalDescription.textContent = `You are about to approve ${selected.length} selected payrolls.`;
            
            let detailsHtml = `
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">Payrolls to be approved:</h4>
                    <ul class="space-y-2 max-h-40 overflow-y-auto">
            `;
            
            selected.forEach(payroll => {
                detailsHtml += `
                    <li class="flex items-center text-sm">
                        <i class="fas fa-user text-blue-500 mr-2"></i>
                        <span class="text-gray-700 dark:text-gray-300">${payroll.name}</span>
                        <span class="ml-auto text-gray-500 dark:text-gray-400">${payroll.netPay}</span>
                    </li>
                `;
            });
            
            detailsHtml += `
                    </ul>
                </div>
                <div class="bg-yellow-50 dark:bg-yellow-900 rounded-lg p-4">
                    <p class="text-sm text-yellow-700 dark:text-yellow-300">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        This action will initiate payment processing for selected employees.
                    </p>
                </div>
            `;
            
            payrollDetails.innerHTML = detailsHtml;
            payrollModal.classList.remove('hidden');
        });
        
        // Individual approve buttons
        approveBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                payrollAction = 'single';
                currentPayrollAction = 'approve';
                currentPayrollId = btn.getAttribute('data-id');
                currentPayrollName = btn.getAttribute('data-name');
                
                const row = btn.closest('tr');
                const department = row.querySelector('td:nth-child(3) span').textContent;
                const basicSalary = row.querySelector('td:nth-child(4) .text-sm').textContent;
                const allowances = row.querySelector('td:nth-child(5) .text-sm').textContent;
                const deductions = row.querySelector('td:nth-child(6) .text-sm').textContent;
                const netPay = row.querySelector('td:nth-child(7) .text-lg').textContent;
                
                modalTitle.textContent = `Approve Payroll for ${currentPayrollName}`;
                modalDescription.textContent = `You are about to approve this payroll for processing.`;
                
                payrollDetails.innerHTML = `
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Employee:</span>
                                <span class="font-medium text-gray-900 dark:text-white">${currentPayrollName}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Department:</span>
                                <span class="font-medium text-gray-900 dark:text-white">${department}</span>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-600 pt-3">
                                <div class="flex justify-between mb-1">
                                    <span class="text-gray-600 dark:text-gray-400">Basic Salary:</span>
                                    <span class="font-medium text-gray-900 dark:text-white">${basicSalary}</span>
                                </div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-gray-600 dark:text-gray-400">Allowances:</span>
                                    <span class="font-medium text-green-600 dark:text-green-400">${allowances}</span>
                                </div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-gray-600 dark:text-gray-400">Deductions:</span>
                                    <span class="font-medium text-red-600 dark:text-red-400">${deductions}</span>
                                </div>
                                <div class="flex justify-between font-bold text-lg mt-2 pt-2 border-t border-gray-200 dark:border-gray-600">
                                    <span class="text-gray-900 dark:text-white">Net Pay:</span>
                                    <span class="text-gold-600 dark:text-gold-400">${netPay}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                payrollModal.classList.remove('hidden');
            });
        });
        
        // Individual reject buttons
        rejectBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                currentPayrollId = btn.getAttribute('data-id');
                currentPayrollName = btn.getAttribute('data-name');
                
                const row = btn.closest('tr');
                const netPay = row.querySelector('td:nth-child(7) .text-lg').textContent;
                
                document.getElementById('rejection-description').textContent = `Reject payroll for ${currentPayrollName} (${netPay})`;
                rejectionModal.classList.remove('hidden');
            });
        });
        
        // View payroll details
        viewBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const payrollId = this.getAttribute('data-id');
                const row = this.closest('tr');
                const name = row.querySelector('.text-sm.font-medium').textContent;
                const netPay = row.querySelector('td:nth-child(7) .text-lg').textContent;
                
                showToast(`Viewing payroll details for ${name} (${netPay})`, 'info');
            });
        });
        
        // Quick action buttons
        generatePayslipsBtn.addEventListener('click', () => {
            showToast('Generating payslips for current period...', 'info');
            setTimeout(() => {
                showToast('Payslips generated successfully!', 'success');
            }, 1500);
        });
        
        exportReportsBtn.addEventListener('click', () => {
            showToast('Exporting payroll reports...', 'info');
            setTimeout(() => {
                showToast('Reports exported successfully!', 'success');
            }, 1500);
        });
        
        bankTransferBtn.addEventListener('click', () => {
            showToast('Initiating bank transfer process...', 'info');
            setTimeout(() => {
                showToast('Bank transfer initiated successfully!', 'success');
            }, 1500);
        });
        
        // Cancel payroll approval
        cancelPayrollBtn.addEventListener('click', () => {
            payrollModal.classList.add('hidden');
        });
        
        // Confirm payroll approval
        confirmPayrollBtn.addEventListener('click', () => {
            payrollModal.classList.add('hidden');
            
            if (payrollAction === 'single') {
                // Update single payroll
                const row = document.querySelector(`.payroll-checkbox[data-id="${currentPayrollId}"]`).closest('tr');
                const statusCell = row.querySelector('td:nth-child(8)');
                
                // Update status
                const statusBadge = statusCell.querySelector('.payroll-status-badge');
                statusBadge.className = 'payroll-status-badge payroll-status-paid';
                statusBadge.textContent = 'Paid';
                
                // Disable action buttons
                const approveBtn = row.querySelector('.approve-payroll-btn');
                const rejectBtn = row.querySelector('.reject-payroll-btn');
                
                if (approveBtn) {
                    approveBtn.style.display = 'none';
                }
                if (rejectBtn) {
                    rejectBtn.style.display = 'none';
                }
                
                showToast(`${currentPayrollName}'s payroll approved successfully!`, 'success');
                
            } else if (payrollAction === 'bulk') {
                // Update all selected payrolls
                const selectedCheckboxes = Array.from(payrollCheckboxes).filter(cb => cb.checked);
                
                selectedCheckboxes.forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    const name = row.querySelector('.text-sm.font-medium').textContent;
                    const statusCell = row.querySelector('td:nth-child(8)');
                    
                    // Update status
                    const statusBadge = statusCell.querySelector('.payroll-status-badge');
                    if (statusBadge) {
                        statusBadge.className = 'payroll-status-badge payroll-status-paid';
                        statusBadge.textContent = 'Paid';
                    }
                    
                    // Disable action buttons
                    const approveBtn = row.querySelector('.approve-payroll-btn');
                    const rejectBtn = row.querySelector('.reject-payroll-btn');
                    
                    if (approveBtn) {
                        approveBtn.style.display = 'none';
                    }
                    if (rejectBtn) {
                        rejectBtn.style.display = 'none';
                    }
                });
                
                // Deselect all checkboxes
                payrollCheckboxes.forEach(cb => cb.checked = false);
                updateSelectedPayrollCount();
                
                showToast(`${selectedCheckboxes.length} payrolls approved successfully!`, 'success');
            }
        });
        
        // Handle rejection reason selection
        rejectionReason.addEventListener('change', () => {
            if (rejectionReason.value === 'other') {
                otherReasonContainer.classList.remove('hidden');
            } else {
                otherReasonContainer.classList.add('hidden');
            }
        });
        
        // Cancel rejection
        cancelRejectionBtn.addEventListener('click', () => {
            rejectionModal.classList.add('hidden');
            rejectionReason.value = '';
            otherReasonContainer.classList.add('hidden');
            otherReason.value = '';
        });
        
        // Confirm rejection
        confirmRejectionBtn.addEventListener('click', () => {
            const reason = rejectionReason.value === 'other' ? otherReason.value : rejectionReason.value;
            
            if (!reason) {
                showToast('Please provide a rejection reason', 'warning');
                return;
            }
            
            rejectionModal.classList.add('hidden');
            
            // Update payroll status
            const row = document.querySelector(`.payroll-checkbox[data-id="${currentPayrollId}"]`).closest('tr');
            const statusCell = row.querySelector('td:nth-child(8)');
            
            // Update status
            const statusBadge = statusCell.querySelector('.payroll-status-badge');
            statusBadge.className = 'payroll-status-badge payroll-status-failed';
            statusBadge.textContent = 'Rejected';
            
            // Add rejection note
            const actionsCell = row.querySelector('td:nth-child(9)');
            actionsCell.innerHTML = `
                <span class="text-xs text-gray-500 dark:text-gray-400" title="Reason: ${reason}">
                    <i class="fas fa-ban text-red-500 mr-1"></i> Rejected
                </span>
            `;
            
            showToast(`${currentPayrollName}'s payroll rejected. Reason: ${reason}`, 'error');
            
            // Reset form
            rejectionReason.value = '';
            otherReasonContainer.classList.add('hidden');
            otherReason.value = '';
        });
        
        function showToast(message, type) {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-transform duration-300 ${
                type === 'success' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                type === 'warning' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' :
                type === 'error' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' :
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