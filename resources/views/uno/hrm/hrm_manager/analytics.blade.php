<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HR Analytics & Reports - Monti Textile HRM</title>

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
        
        /* Analytics specific styles */
        .analytics-chart {
            height: 250px;
            position: relative;
            margin-top: 1rem;
        }
        
        .chart-placeholder {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            height: 200px;
            padding: 0 1rem;
            margin-bottom: 1rem;
        }
        
        .chart-bar {
            width: 30px;
            background: linear-gradient(to top, #3b82f6, #60a5fa);
            border-radius: 4px 4px 0 0;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .chart-bar:hover {
            transform: scale(1.05);
            background: linear-gradient(to top, #2563eb, #3b82f6);
        }
        
        .chart-bar-label {
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 0.75rem;
            color: #6b7280;
        }
        
        .dark .chart-bar-label {
            color: #9ca3af;
        }
        
        .pie-chart {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: conic-gradient(
                #3b82f6 0% 25%,
                #10b981 25% 45%,
                #f59e0b 45% 70%,
                #8b5cf6 70% 85%,
                #ec4899 85% 100%
            );
            margin: 0 auto;
            position: relative;
        }
        
        .pie-chart-center {
            position: absolute;
            width: 70px;
            height: 70px;
            background: white;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        
        .dark .pie-chart-center {
            background: #374151;
        }
        
        .chart-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .legend-item {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            color: #4b5563;
        }
        
        .dark .legend-item {
            color: #d1d5db;
        }
        
        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 2px;
            margin-right: 0.5rem;
        }
        
        .metric-card {
            border-left: 4px solid #3b82f6;
        }
        
        .metric-card.green {
            border-left-color: #10b981;
        }
        
        .metric-card.orange {
            border-left-color: #f59e0b;
        }
        
        .metric-card.purple {
            border-left-color: #8b5cf6;
        }
        
        .metric-card.red {
            border-left-color: #ef4444;
        }
        
        .trend-indicator {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .trend-up {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .trend-down {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .trend-neutral {
            background-color: #f3f4f6;
            color: #4b5563;
        }
        
        .dark .trend-up {
            background-color: #14532d;
            color: #86efac;
        }
        
        .dark .trend-down {
            background-color: #7f1d1d;
            color: #fca5a5;
        }
        
        .dark .trend-neutral {
            background-color: #374151;
            color: #d1d5db;
        }
        
        .report-card {
            border: 2px dashed #d1d5db;
            transition: all 0.2s ease;
        }
        
        .report-card:hover {
            border-color: #3b82f6;
            background-color: #f8fafc;
        }
        
        .dark .report-card:hover {
            background-color: #1f2937;
        }
        
        .report-status {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-published {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .status-draft {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .status-scheduled {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .status-archived {
            background-color: #f3f4f6;
            color: #4b5563;
        }
        
        .dark .status-published {
            background-color: #14532d;
            color: #86efac;
        }
        
        .dark .status-draft {
            background-color: #78350f;
            color: #fde68a;
        }
        
        .dark .status-scheduled {
            background-color: #1e3a8a;
            color: #93c5fd;
        }
        
        .dark .status-archived {
            background-color: #374151;
            color: #9ca3af;
        }
        
        .insight-card {
            position: relative;
            overflow: hidden;
        }
        
        .insight-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
            border-radius: 50%;
            transform: translate(30%, -30%);
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
        
        .dark .report-card {
            border-color: #4b5563;
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
            
            .chart-placeholder {
                overflow-x: auto;
                padding-bottom: 1rem;
            }
            
            .chart-bar {
                min-width: 25px;
                margin-right: 0.5rem;
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
            
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }
        
        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .charts-grid {
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
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white header-title">HR Analytics & Reports</h1>
                    <p class="text-gray-500 dark:text-gray-400 hidden md:block">Data-driven insights and comprehensive HR reporting</p>
                </div>
                
                <div class="flex items-center space-x-4 header-actions">
                    <div class="flex items-center space-x-3">
                        <button class="md:hidden p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300" id="mobile-search-toggle">
                            <i class="fas fa-search"></i>
                        </button>
                        
                        <button class="relative p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">7</span>
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
            <!-- HR Analytics Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 stats-grid">
                <div class="card p-6 flex items-center metric-card">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-4">
                        <i class="fas fa-users text-blue-600 dark:text-blue-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Employee Turnover Rate</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">8.2%</div>
                        <div class="flex items-center mt-1">
                            <span class="trend-indicator trend-down mr-2">
                                <i class="fas fa-arrow-down mr-1"></i> 1.5%
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">vs last month</span>
                        </div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center metric-card green">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center mr-4">
                        <i class="fas fa-user-check text-emerald-600 dark:text-emerald-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Employee Satisfaction</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">4.8/5</div>
                        <div class="flex items-center mt-1">
                            <span class="trend-indicator trend-up mr-2">
                                <i class="fas fa-arrow-up mr-1"></i> 0.3
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">vs last quarter</span>
                        </div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center metric-card orange">
                    <div class="w-12 h-12 rounded-xl bg-orange-100 dark:bg-orange-900 flex items-center justify-center mr-4">
                        <i class="fas fa-clock text-orange-600 dark:text-orange-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Time to Hire</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">24 days</div>
                        <div class="flex items-center mt-1">
                            <span class="trend-indicator trend-down mr-2">
                                <i class="fas fa-arrow-down mr-1"></i> 3 days
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">vs last quarter</span>
                        </div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center metric-card purple">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900 flex items-center justify-center mr-4">
                        <i class="fas fa-money-bill-wave text-purple-600 dark:text-purple-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Cost per Hire</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">₱15,240</div>
                        <div class="flex items-center mt-1">
                            <span class="trend-indicator trend-up mr-2">
                                <i class="fas fa-arrow-up mr-1"></i> 5.2%
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">vs last quarter</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analytics Dashboard Banner -->
            <div class="featured-banner mb-8">
                <div class="p-8">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <div class="featured-banner-content mb-6 md:mb-0">
                            <h2 class="text-2xl font-bold mb-3 text-white">HR Analytics Dashboard</h2>
                            <p class="text-blue-100 mb-6 max-w-lg">Gain actionable insights with real-time analytics, predictive trends, and comprehensive workforce intelligence.</p>
                            <div class="flex flex-wrap gap-3">
                                <button class="px-6 py-3 bg-gold-theme hover:bg-gold-600 text-white font-semibold rounded-xl transition-colors shadow-md flex items-center" id="generate-report-btn">
                                    <i class="fas fa-file-export mr-2"></i> Generate Custom Report
                                </button>
                                <button class="px-6 py-3 bg-white hover:bg-gray-100 text-blue-700 font-semibold rounded-xl transition-colors shadow-md flex items-center" id="schedule-analytics-btn">
                                    <i class="fas fa-calendar-alt mr-2"></i> Schedule Report
                                </button>
                            </div>
                        </div>
                        <div class="featured-banner-image animate-float">
                            <div class="w-48 h-32 bg-gradient-to-r from-purple-400 to-purple-300 dark:from-purple-500 dark:to-purple-400 rounded-lg shadow-xl flex items-center justify-center">
                                <i class="fas fa-chart-line text-white text-4xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 main-grid">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Key Metrics Charts -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-bold text-xl text-gray-900 dark:text-white">Key HR Metrics Trends</h3>
                            <div class="flex space-x-2">
                                <select class="input-field text-sm py-1.5">
                                    <option>Last 7 Days</option>
                                    <option>Last 30 Days</option>
                                    <option>Last Quarter</option>
                                    <option>Last Year</option>
                                </select>
                                <button class="px-3 py-1.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium transition-colors">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="analytics-chart">
                            <div class="chart-placeholder">
                                <div class="chart-bar" style="height: 85%">
                                    <div class="chart-bar-label">Jan</div>
                                </div>
                                <div class="chart-bar" style="height: 72%">
                                    <div class="chart-bar-label">Feb</div>
                                </div>
                                <div class="chart-bar" style="height: 68%">
                                    <div class="chart-bar-label">Mar</div>
                                </div>
                                <div class="chart-bar" style="height: 78%">
                                    <div class="chart-bar-label">Apr</div>
                                </div>
                                <div class="chart-bar" style="height: 82%">
                                    <div class="chart-bar-label">May</div>
                                </div>
                                <div class="chart-bar" style="height: 88%">
                                    <div class="chart-bar-label">Jun</div>
                                </div>
                                <div class="chart-bar" style="height: 92%">
                                    <div class="chart-bar-label">Jul</div>
                                </div>
                                <div class="chart-bar" style="height: 85%">
                                    <div class="chart-bar-label">Aug</div>
                                </div>
                                <div class="chart-bar" style="height: 78%">
                                    <div class="chart-bar-label">Sep</div>
                                </div>
                                <div class="chart-bar" style="height: 82%">
                                    <div class="chart-bar-label">Oct</div>
                                </div>
                                <div class="chart-bar" style="height: 86%">
                                    <div class="chart-bar-label">Nov</div>
                                </div>
                                <div class="chart-bar" style="height: 91%">
                                    <div class="chart-bar-label">Dec</div>
                                </div>
                            </div>
                            <div class="text-center text-sm text-gray-500 dark:text-gray-400 mt-4">
                                Employee Satisfaction Score (Monthly Average)
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">4.8</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Current Score</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">+0.3</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Quarterly Growth</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900 dark:text-white">92%</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Above Industry Avg.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Department Performance -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-bold text-xl text-gray-900 dark:text-white">Department Performance Analysis</h3>
                            <a href="#" class="text-blue-theme font-medium flex items-center hover:text-blue-700 dark:hover:text-blue-400 text-sm">
                                View Details <i class="fas fa-chevron-right ml-2 text-xs"></i>
                            </a>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr class="bg-gray-50 dark:bg-gray-700">
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Department</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Headcount</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Turnover Rate</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Satisfaction</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Productivity</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 mr-3">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                                <div class="font-medium text-gray-900 dark:text-white">HR Department</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-gray-900 dark:text-white font-medium">24</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">+2 this quarter</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-gray-900 dark:text-white font-medium">5.2%</div>
                                            <div class="text-sm text-emerald-600 dark:text-emerald-400">-1.8% vs target</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-gray-900 dark:text-white font-medium">4.9/5</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Excellent</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-24 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                                    <div class="bg-emerald-500 h-2 rounded-full" style="width: 92%"></div>
                                                </div>
                                                <span class="ml-2 text-sm font-medium text-gray-900 dark:text-white">92%</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="trend-indicator trend-up">
                                                <i class="fas fa-arrow-up mr-1"></i> Optimal
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-lg bg-green-100 dark:bg-green-900 flex items-center justify-center text-green-600 dark:text-green-300 mr-3">
                                                    <i class="fas fa-industry"></i>
                                                </div>
                                                <div class="font-medium text-gray-900 dark:text-white">Production</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-gray-900 dark:text-white font-medium">156</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">+12 this quarter</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-gray-900 dark:text-white font-medium">12.4%</div>
                                            <div class="text-sm text-red-600 dark:text-red-400">+2.4% vs target</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-gray-900 dark:text-white font-medium">4.2/5</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Good</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-24 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                                    <div class="bg-yellow-500 h-2 rounded-full" style="width: 78%"></div>
                                                </div>
                                                <span class="ml-2 text-sm font-medium text-gray-900 dark:text-white">78%</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="trend-indicator trend-neutral">
                                                <i class="fas fa-minus mr-1"></i> Stable
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900 flex items-center justify-center text-purple-600 dark:text-purple-300 mr-3">
                                                    <i class="fas fa-chart-line"></i>
                                                </div>
                                                <div class="font-medium text-gray-900 dark:text-white">Sales & Marketing</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-gray-900 dark:text-white font-medium">42</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">+5 this quarter</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-gray-900 dark:text-white font-medium">8.7%</div>
                                            <div class="text-sm text-emerald-600 dark:text-emerald-400">-1.3% vs target</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-gray-900 dark:text-white font-medium">4.6/5</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Excellent</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-24 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                                    <div class="bg-emerald-500 h-2 rounded-full" style="width: 88%"></div>
                                                </div>
                                                <span class="ml-2 text-sm font-medium text-gray-900 dark:text-white">88%</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="trend-indicator trend-up">
                                                <i class="fas fa-arrow-up mr-1"></i> Improving
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 rounded-lg bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center text-yellow-600 dark:text-yellow-300 mr-3">
                                                    <i class="fas fa-flask"></i>
                                                </div>
                                                <div class="font-medium text-gray-900 dark:text-white">Quality Control</div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-gray-900 dark:text-white font-medium">28</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">+3 this quarter</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-gray-900 dark:text-white font-medium">6.8%</div>
                                            <div class="text-sm text-emerald-600 dark:text-emerald-400">-3.2% vs target</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="text-gray-900 dark:text-white font-medium">4.7/5</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">Excellent</div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-24 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                                    <div class="bg-emerald-500 h-2 rounded-full" style="width: 91%"></div>
                                                </div>
                                                <span class="ml-2 text-sm font-medium text-gray-900 dark:text-white">91%</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 whitespace-nowrap">
                                            <span class="trend-indicator trend-up">
                                                <i class="fas fa-arrow-up mr-1"></i> Optimal
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="space-y-8">
                    <!-- Workforce Distribution -->
                    <div class="card p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-bold text-xl text-gray-900 dark:text-white">Workforce Distribution</h3>
                            <span class="text-sm text-gray-500 dark:text-gray-400">Total: 250 Employees</span>
                        </div>
                        
                        <div class="flex flex-col items-center">
                            <div class="pie-chart">
                                <div class="pie-chart-center"></div>
                            </div>
                            
                            <div class="chart-legend mt-6">
                                <div class="legend-item">
                                    <div class="legend-color bg-blue-500"></div>
                                    <span>Production (62%)</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color bg-emerald-500"></div>
                                    <span>HR & Admin (10%)</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color bg-yellow-500"></div>
                                    <span>Sales (17%)</span>
                                </div>
                                <div class="legend-item">
                                    <div class="legend-color bg-purple-500"></div>
                                    <span>Quality (11%)</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Avg. Tenure</div>
                                    <div class="text-lg font-bold text-gray-900 dark:text-white">3.5 years</div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">Avg. Age</div>
                                    <div class="text-lg font-bold text-gray-900 dark:text-white">34.2 years</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- AI Insights & Predictions -->
                    <div class="card p-6 insight-card">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-bold text-xl text-gray-900 dark:text-white">AI Insights & Predictions</h3>
                            <span class="text-xs text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900 px-2 py-1 rounded-full">LIVE</span>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="p-3 rounded-lg bg-blue-50 dark:bg-blue-900 border border-blue-100 dark:border-blue-800">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-800 flex items-center justify-center text-blue-600 dark:text-blue-300 mr-3">
                                        <i class="fas fa-lightbulb"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">Turnover Prediction</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">High risk of turnover in Production department (15%) next quarter. Consider retention initiatives.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-3 rounded-lg bg-emerald-50 dark:bg-emerald-900 border border-emerald-100 dark:border-emerald-800">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-800 flex items-center justify-center text-emerald-600 dark:text-emerald-300 mr-3">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">Recruitment Trend</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Quality Control roles take 18% longer to fill than average. Consider revising job requirements.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="p-3 rounded-lg bg-purple-50 dark:bg-purple-900 border border-purple-100 dark:border-purple-800">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-800 flex items-center justify-center text-purple-600 dark:text-purple-300 mr-3">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">Cost Optimization</h4>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Potential to reduce hiring costs by 12% through improved candidate sourcing channels.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button class="w-full mt-6 py-2.5 bg-blue-theme hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-robot mr-2"></i> Generate More Insights
                        </button>
                    </div>
                    
                    <!-- Quick Report Generator -->
                    {{-- <div class="card p-6">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Quick Report Generator</h3>
                            <i class="fas fa-magic text-blue-500"></i>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Report Type</label>
                                <select class="input-field text-sm">
                                    <option>Employee Turnover Analysis</option>
                                    <option>Recruitment Funnel Report</option>
                                    <option>Compensation Benchmarking</option>
                                    <option>Employee Engagement Survey</option>
                                    <option>Training Effectiveness</option>
                                    <option>Diversity & Inclusion Metrics</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date Range</label>
                                <select class="input-field text-sm">
                                    <option>Last 30 Days</option>
                                    <option>Last Quarter</option>
                                    <option>Last 6 Months</option>
                                    <option>Year to Date</option>
                                    <option>Custom Range</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Format</label>
                                <div class="flex space-x-2">
                                    <button class="flex-1 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium transition-colors">
                                        <i class="fas fa-file-pdf mr-1"></i> PDF
                                    </button>
                                    <button class="flex-1 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium transition-colors">
                                        <i class="fas fa-file-excel mr-1"></i> Excel
                                    </button>
                                    <button class="flex-1 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-medium transition-colors">
                                        <i class="fas fa-chart-bar mr-1"></i> Dashboard
                                    </button>
                                </div>
                            </div>
                            
                            <button class="w-full py-3 bg-gold-theme hover:bg-gold-600 text-white rounded-lg font-medium transition-colors">
                                <i class="fas fa-bolt mr-2"></i> Generate Report Now
                            </button>
                        </div>
                    </div> --}}
                </div>
            </div>

            <!-- Saved Reports -->
            <div class="mt-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-xl text-gray-900 dark:text-white">Saved Reports & Templates</h3>
                    <div class="flex space-x-3">
                        <button class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-filter mr-2"></i> Filter
                        </button>
                        <button class="px-4 py-2 bg-blue-theme hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-plus mr-2"></i> New Template
                        </button>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    <div class="card p-5 report-card">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <div class="font-medium text-gray-900 dark:text-white">Monthly HR Dashboard</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Comprehensive monthly overview</div>
                            </div>
                            <span class="report-status status-published">Published</span>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-calendar-alt mr-2 text-xs"></i>
                                <span>Generated: Dec 1, 2023</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-file-pdf mr-2 text-xs"></i>
                                <span>PDF · 24 pages</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="flex-1 py-2 bg-blue-theme hover:bg-blue-700 text-white text-sm rounded-lg transition-colors">
                                <i class="fas fa-eye mr-1"></i> View
                            </button>
                            <button class="flex-1 py-2 bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-300 text-sm rounded-lg transition-colors">
                                <i class="fas fa-download mr-1"></i> Download
                            </button>
                        </div>
                    </div>
                    
                    <div class="card p-5 report-card">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <div class="font-medium text-gray-900 dark:text-white">Q4 Recruitment Analysis</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Recruitment funnel & efficiency</div>
                            </div>
                            <span class="report-status status-published">Published</span>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-calendar-alt mr-2 text-xs"></i>
                                <span>Generated: Nov 28, 2023</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-file-excel mr-2 text-xs"></i>
                                <span>Excel · 15 sheets</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="flex-1 py-2 bg-blue-theme hover:bg-blue-700 text-white text-sm rounded-lg transition-colors">
                                <i class="fas fa-eye mr-1"></i> View
                            </button>
                            <button class="flex-1 py-2 bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-300 text-sm rounded-lg transition-colors">
                                <i class="fas fa-download mr-1"></i> Download
                            </button>
                        </div>
                    </div>
                    
                    <div class="card p-5 report-card">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <div class="font-medium text-gray-900 dark:text-white">Employee Engagement Survey</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Annual engagement results</div>
                            </div>
                            <span class="report-status status-draft">Draft</span>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            <div class="flex items-center mb-1">
                                <i class="fas fa-calendar-alt mr-2 text-xs"></i>
                                <span>Last edited: Dec 3, 2023</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-chart-pie mr-2 text-xs"></i>
                                <span>Dashboard · Interactive</span>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button class="flex-1 py-2 bg-emerald-theme hover:bg-emerald-700 text-white text-sm rounded-lg transition-colors">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </button>
                            <button class="flex-1 py-2 bg-gray-200 dark:bg-gray-600 hover:bg-gray-300 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-300 text-sm rounded-lg transition-colors">
                                <i class="fas fa-share mr-1"></i> Share
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scheduled Reports -->
            <div class="mt-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-xl text-gray-900 dark:text-white">Scheduled Reports</h3>
                    <a href="#" class="text-blue-theme font-medium flex items-center hover:text-blue-700 dark:hover:text-blue-400 text-sm">
                        View All Schedules <i class="fas fa-chevron-right ml-2 text-xs"></i>
                    </a>
                </div>
                
                <div class="card p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700">
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Report Name</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Frequency</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Recipients</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Next Run</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900 dark:text-white">Executive HR Dashboard</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Automated weekly report</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                            <i class="fas fa-calendar-week mr-1"></i> Weekly
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-gray-900 dark:text-white">8 recipients</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Executives & Managers</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-gray-900 dark:text-white">Mon, Dec 11</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">9:00 AM</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="report-status status-scheduled">Active</span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-3">
                                            <i class="fas fa-pause"></i>
                                        </button>
                                        <button class="text-emerald-600 hover:text-emerald-900 dark:text-emerald-400 dark:hover:text-emerald-300">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900 dark:text-white">Monthly Compliance Report</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Regulatory compliance metrics</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">
                                            <i class="fas fa-calendar-alt mr-1"></i> Monthly
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-gray-900 dark:text-white">3 recipients</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Legal & Compliance</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-gray-900 dark:text-white">Jan 1, 2024</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">8:00 AM</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="report-status status-scheduled">Active</span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-3">
                                            <i class="fas fa-pause"></i>
                                        </button>
                                        <button class="text-emerald-600 hover:text-emerald-900 dark:text-emerald-400 dark:hover:text-emerald-300">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900 dark:text-white">Quarterly Talent Review</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">Talent pipeline analysis</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            <i class="fas fa-calendar mr-1"></i> Quarterly
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-gray-900 dark:text-white">12 recipients</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">HR & Department Heads</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-gray-900 dark:text-white">Jan 15, 2024</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">10:00 AM</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="report-status status-archived">Paused</span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-emerald-600 hover:text-emerald-900 dark:text-emerald-400 dark:hover:text-emerald-300 mr-3">
                                            <i class="fas fa-play"></i>
                                        </button>
                                        <button class="text-emerald-600 hover:text-emerald-900 dark:text-emerald-400 dark:hover:text-emerald-300">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Generate Report Modal -->
    <div id="generate-report-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-8 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Generate Custom Report</h3>
                <button class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300" id="close-report-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="report-form">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Report Name *</label>
                        <input type="text" class="input-field" placeholder="e.g., Annual HR Analytics Report 2023" required>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Report Type *</label>
                            <select class="input-field" required>
                                <option value="">Select Report Type</option>
                                <option>Analytical Dashboard</option>
                                <option>Executive Summary</option>
                                <option>Detailed Analysis</option>
                                <option>Compliance Report</option>
                                <option>Benchmarking Report</option>
                                <option>Predictive Analytics</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date Range *</label>
                            <select class="input-field" required>
                                <option>Last 30 Days</option>
                                <option>Last Quarter</option>
                                <option>Last 6 Months</option>
                                <option>Year to Date</option>
                                <option>Last Year</option>
                                <option>Custom Range</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Data Modules</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-theme mr-2" checked>
                                <span class="text-sm">Employee Demographics</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-theme mr-2" checked>
                                <span class="text-sm">Turnover Analysis</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-theme mr-2">
                                <span class="text-sm">Recruitment Metrics</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-theme mr-2" checked>
                                <span class="text-sm">Compensation Data</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-theme mr-2">
                                <span class="text-sm">Training & Development</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-theme mr-2" checked>
                                <span class="text-sm">Performance Metrics</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Report Format</label>
                        <div class="grid grid-cols-3 gap-3">
                            <label class="flex flex-col items-center p-3 border rounded-lg cursor-pointer hover:border-blue-300 dark:hover:border-blue-500">
                                <input type="radio" name="format" class="hidden" value="pdf" checked>
                                <i class="fas fa-file-pdf text-2xl text-red-500 mb-2"></i>
                                <span class="text-sm">PDF Report</span>
                            </label>
                            <label class="flex flex-col items-center p-3 border rounded-lg cursor-pointer hover:border-blue-300 dark:hover:border-blue-500">
                                <input type="radio" name="format" class="hidden" value="excel">
                                <i class="fas fa-file-excel text-2xl text-green-500 mb-2"></i>
                                <span class="text-sm">Excel Data</span>
                            </label>
                            <label class="flex flex-col items-center p-3 border rounded-lg cursor-pointer hover:border-blue-300 dark:hover:border-blue-500">
                                <input type="radio" name="format" class="hidden" value="dashboard">
                                <i class="fas fa-chart-bar text-2xl text-blue-500 mb-2"></i>
                                <span class="text-sm">Interactive Dashboard</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Schedule (Optional)</label>
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center">
                                <input type="checkbox" id="schedule-report" class="rounded border-gray-300 text-blue-theme mr-2">
                                <span class="text-sm">Schedule recurring report</span>
                            </label>
                            <select id="schedule-frequency" class="input-field text-sm hidden">
                                <option>Daily</option>
                                <option>Weekly</option>
                                <option>Monthly</option>
                                <option>Quarterly</option>
                                <option>Annually</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Recipients (Optional)</label>
                        <input type="text" class="input-field" placeholder="Enter email addresses separated by commas">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notes</label>
                        <textarea class="input-field" rows="3" placeholder="Additional instructions or notes..."></textarea>
                    </div>
                </div>
                
                <div class="mt-8 flex space-x-3">
                    <button type="button" class="flex-1 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-xl font-medium transition-colors" id="cancel-report">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 py-3 bg-gold-theme hover:bg-gold-600 text-white rounded-xl font-medium transition-colors">
                        Generate Report
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Schedule Analytics Modal -->
    <div id="schedule-analytics-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-8 max-w-md w-full mx-4">
            <div class="text-center mb-6">
                <div class="w-16 h-16 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center text-purple-600 dark:text-purple-300 text-2xl mx-auto mb-4">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Schedule Analytics Report</h3>
                <p class="text-gray-600 dark:text-gray-400">Set up automated report delivery</p>
            </div>
            
            <form id="schedule-analytics-form">
                <div class="space-y-4 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Report Template</label>
                        <select class="input-field" required>
                            <option value="">Select Template</option>
                            <option>Executive HR Dashboard</option>
                            <option>Monthly Compliance Report</option>
                            <option>Recruitment Analytics</option>
                            <option>Employee Engagement Survey</option>
                            <option>Talent Pipeline Report</option>
                        </select>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Frequency</label>
                            <select class="input-field" required>
                                <option>Daily</option>
                                <option>Weekly</option>
                                <option>Monthly</option>
                                <option>Quarterly</option>
                                <option>Annually</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Time</label>
                            <input type="time" class="input-field" required>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Start Date</label>
                        <input type="date" class="input-field" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Recipients</label>
                        <input type="text" class="input-field" placeholder="Enter email addresses" required>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Format</label>
                        <div class="flex space-x-2">
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-theme mr-1">
                                <span class="text-sm">PDF</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-theme mr-1">
                                <span class="text-sm">Excel</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="rounded border-gray-300 text-blue-theme mr-1">
                                <span class="text-sm">Dashboard Link</span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="flex space-x-3">
                    <button type="button" class="flex-1 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-xl font-medium transition-colors" id="cancel-schedule-analytics">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 py-3 bg-emerald-theme hover:bg-emerald-700 text-white rounded-xl font-medium transition-colors">
                        Schedule Report
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sidebar functionality
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        
        // Modals and buttons
        const generateReportBtn = document.getElementById('generate-report-btn');
        const generateReportModal = document.getElementById('generate-report-modal');
        const closeReportModal = document.getElementById('close-report-modal');
        const cancelReport = document.getElementById('cancel-report');
        const scheduleAnalyticsBtn = document.getElementById('schedule-analytics-btn');
        const scheduleAnalyticsModal = document.getElementById('schedule-analytics-modal');
        const cancelScheduleAnalytics = document.getElementById('cancel-schedule-analytics');
        const reportForm = document.getElementById('report-form');
        const scheduleAnalyticsForm = document.getElementById('schedule-analytics-form');
        const scheduleReportCheckbox = document.getElementById('schedule-report');
        const scheduleFrequencySelect = document.getElementById('schedule-frequency');
        
        // Function to toggle sidebar
        function toggleSidebar() {
            if (window.innerWidth < 1024) {
                sidebar.classList.toggle('active');
                mobileOverlay.classList.toggle('active');
                document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
            } else {
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
        
        // Event listeners for sidebar
        sidebarToggle.addEventListener('click', toggleSidebar);
        mobileMenuToggle.addEventListener('click', toggleSidebar);
        mobileOverlay.addEventListener('click', closeSidebar);
        
        // Initialize on load
        document.addEventListener('DOMContentLoaded', () => {
            if (window.innerWidth < 1024) {
                mainContent.style.marginLeft = '0';
            }
            
            // Initialize chart animations
            animateChartBars();
        });
        
        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth < 1024) {
                mainContent.style.marginLeft = '0';
                sidebar.classList.remove('collapsed');
                
                if (sidebar.classList.contains('active')) {
                    document.body.style.overflow = '';
                }
            } else {
                mobileOverlay.classList.remove('active');
                sidebar.classList.remove('active');
                document.body.style.overflow = '';
                
                mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '80px' : '260px';
            }
        });
        
        // Generate Report Modal
        generateReportBtn.addEventListener('click', () => {
            generateReportModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
        
        closeReportModal.addEventListener('click', () => {
            generateReportModal.classList.add('hidden');
            document.body.style.overflow = '';
        });
        
        cancelReport.addEventListener('click', () => {
            generateReportModal.classList.add('hidden');
            document.body.style.overflow = '';
        });
        
        // Schedule Analytics Modal
        scheduleAnalyticsBtn.addEventListener('click', () => {
            scheduleAnalyticsModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });
        
        cancelScheduleAnalytics.addEventListener('click', () => {
            scheduleAnalyticsModal.classList.add('hidden');
            document.body.style.overflow = '';
        });
        
        // Close modals when clicking outside
        [generateReportModal, scheduleAnalyticsModal].forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });
        });
        
        // Form submissions
        reportForm.addEventListener('submit', (e) => {
            e.preventDefault();
            generateReportModal.classList.add('hidden');
            document.body.style.overflow = '';
            showToast('Custom report generation started! You will be notified when it\'s ready.', 'success');
        });
        
        scheduleAnalyticsForm.addEventListener('submit', (e) => {
            e.preventDefault();
            scheduleAnalyticsModal.classList.add('hidden');
            document.body.style.overflow = '';
            showToast('Analytics report scheduled successfully!', 'success');
        });
        
        // Schedule report checkbox
        scheduleReportCheckbox.addEventListener('change', () => {
            if (scheduleReportCheckbox.checked) {
                scheduleFrequencySelect.classList.remove('hidden');
            } else {
                scheduleFrequencySelect.classList.add('hidden');
            }
        });
        
        // Animate chart bars
        function animateChartBars() {
            const chartBars = document.querySelectorAll('.chart-bar');
            chartBars.forEach(bar => {
                const height = bar.style.height;
                bar.style.height = '0%';
                setTimeout(() => {
                    bar.style.height = height;
                }, 300 + Math.random() * 500);
            });
        }
        
        // View report buttons
        document.querySelectorAll('.report-card button.bg-blue-theme').forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.report-card');
                const reportName = card.querySelector('.font-medium').textContent;
                showToast(`Opening report: ${reportName}`, 'info');
            });
        });
        
        // Download report buttons
        document.querySelectorAll('.report-card button.bg-gray-200').forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.report-card');
                const reportName = card.querySelector('.font-medium').textContent;
                showToast(`Downloading report: ${reportName}`, 'success');
            });
        });
        
        // Edit report buttons
        document.querySelectorAll('.report-card button.bg-emerald-theme').forEach(btn => {
            btn.addEventListener('click', function() {
                const card = this.closest('.report-card');
                const reportName = card.querySelector('.font-medium').textContent;
                showToast(`Editing report template: ${reportName}`, 'info');
            });
        });
        
        // Schedule report actions
        document.querySelectorAll('button.text-blue-600').forEach(btn => {
            btn.addEventListener('click', function() {
                const row = this.closest('tr');
                const reportName = row.querySelector('.font-medium').textContent;
                showToast(`Paused schedule for: ${reportName}`, 'warning');
            });
        });
        
        // Toast notification function
        function showToast(message, type) {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-transform duration-300 ${
                type === 'success' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                type === 'warning' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' :
                'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300'
            }`;
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
        
        // Quick report generator
        document.querySelector('.bg-gold-theme.text-white.rounded-lg').addEventListener('click', function() {
            const reportType = document.querySelector('#report-form select').value;
            showToast(`Generating ${reportType} report...`, 'info');
        });
        
        // Generate more insights button
        document.querySelector('.bg-blue-theme.text-white.rounded-lg').addEventListener('click', function() {
            showToast('AI is analyzing data to generate new insights...', 'info');
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>