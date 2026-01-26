<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Application Management - Monti Textile HRM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        @include('uno.hrm.hrm_staff.style')
    @endif

    <!-- Custom Styles (from dashboard) -->
    <style>
        /* Content Loading Overlay */
        .content-loading-overlay {
            position: fixed;
            top: 0;
            left: 260px; /* Sidebar width */
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            z-index: 9998;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }
        
        /* Adjust for collapsed sidebar */
        .sidebar.collapsed ~ .content-loading-overlay {
            left: 80px;
        }
        
        .content-loading-overlay.hidden {
            opacity: 0;
            visibility: hidden;
        }
        
        .loading-spinner {
            width: 80px;
            height: 80px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #ffffff;
            animation: spin 1s ease-in-out infinite;
            margin-bottom: 20px;
        }
        
        .loading-content {
            text-align: center;
            color: white;
        }
        
        .loading-content h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .loading-content p {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .loading-progress-bar {
            width: 200px;
            height: 4px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
            margin-top: 20px;
            overflow: hidden;
        }
        
        .loading-progress-fill {
            height: 100%;
            background: #ffffff;
            width: 0%;
            border-radius: 2px;
            transition: width 0.3s ease;
        }
        
        /* Main content fade-in */
        .main-content.hidden {
            opacity: 0;
            visibility: hidden;
        }
        
        .main-content.visible {
            opacity: 1;
            visibility: visible;
            transition: opacity 0.8s ease, visibility 0.8s ease;
        }
        
        /* Content Fade-in Animation */
        .content-fade-in {
            animation: fadeIn 0.8s ease forwards;
            opacity: 0;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Staggered Animations */
        .stagger-delay-1 { animation-delay: 0.1s; }
        .stagger-delay-2 { animation-delay: 0.2s; }
        .stagger-delay-3 { animation-delay: 0.3s; }
        .stagger-delay-4 { animation-delay: 0.4s; }
        .stagger-delay-5 { animation-delay: 0.5s; }

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
            transition: margin-left 0.3s ease, opacity 0.8s ease, visibility 0.8s ease;
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
        
        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .data-table th {
            background-color: #f9fafb;
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .dark .data-table th {
            background-color: #374151;
            color: #f9fafb;
            border-bottom-color: #4b5563;
        }
        
        .data-table td {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .dark .data-table td {
            border-bottom-color: #4b5563;
        }
        
        .data-table tr:hover {
            background-color: #f9fafb;
        }
        
        .dark .data-table tr:hover {
            background-color: #374151;
        }
        
        /* Badge Styles */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .dark .badge-success {
            background-color: #064e3b;
            color: #a7f3d0;
        }
        
        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .dark .badge-warning {
            background-color: #78350f;
            color: #fcd34d;
        }
        
        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .dark .badge-danger {
            background-color: #7f1d1d;
            color: #fca5a5;
        }
        
        .badge-info {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .dark .badge-info {
            background-color: #1e3a8a;
            color: #93c5fd;
        }
        
        /* Button Styles */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
            border: 1px solid transparent;
            cursor: pointer;
        }
        
        .btn-sm {
            padding: 6px 12px;
            font-size: 14px;
        }
        
        .btn-primary {
            background-color: #2563eb;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #1d4ed8;
        }
        
        .btn-success {
            background-color: #10b981;
            color: white;
        }
        
        .btn-success:hover {
            background-color: #059669;
        }
        
        .btn-danger {
            background-color: #ef4444;
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #dc2626;
        }
        
        .btn-warning {
            background-color: #f59e0b;
            color: white;
        }
        
        .btn-warning:hover {
            background-color: #d97706;
        }
        
        .btn-outline {
            background-color: transparent;
            border-color: #d1d5db;
            color: #374151;
        }
        
        .dark .btn-outline {
            border-color: #4b5563;
            color: #f9fafb;
        }
        
        .btn-outline:hover {
            background-color: #f3f4f6;
        }
        
        .dark .btn-outline:hover {
            background-color: #374151;
        }
        
        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        
        .dark .form-label {
            color: #f9fafb;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            background-color: white;
            transition: border-color 0.15s ease-in-out;
        }
        
        .dark .form-control {
            background-color: #374151;
            border-color: #4b5563;
            color: #f9fafb;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        .dark .form-control:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
        }
        
        /* Department Tag Styles */
        .department-tag {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            margin: 2px;
        }
        
        .department-production {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .department-quality {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .department-maintenance {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .department-admin {
            background-color: #f3e8ff;
            color: #6b21a8;
        }
        
        .department-logistics {
            background-color: #fce7f3;
            color: #9d174d;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1001;
            align-items: center;
            justify-content: center;
        }
        
        .modal.active {
            display: flex;
        }
        
        .modal-content {
            background: white;
            border-radius: 1rem;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
        }
        
        .dark .modal-content {
            background-color: #374151;
        }
        
        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .dark .modal-header {
            border-bottom-color: #4b5563;
        }
        
        .modal-body {
            padding: 1.5rem;
        }

        .monti-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-bottom: 3px solid #fbbf24;
        }
        
        /* Scrollbar Styling */
        .modal-content::-webkit-scrollbar {
            width: 8px;
        }
        
        .modal-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        
        .modal-content::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }
        
        .modal-content::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
        
        /* Focus styles */
        input:focus, select:focus, textarea:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .content-loading-overlay {
                left: 0;
            }
            
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
            
            .data-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <!-- Mobile Overlay -->
    <div class="mobile-sidebar-overlay" id="mobile-overlay"></div>

    <!-- Sidebar -->
    @include('uno.hrm.hrm_staff.SideBarHrStaff')

    <!-- Content Loading Overlay -->
    <div id="content-loading-overlay" class="content-loading-overlay">
        <div class="loading-spinner"></div>
        <div class="loading-content">
            <h3>Monti Textile HRM</h3>
            <p>Loading application management...</p>
        </div>
        <div class="loading-progress-bar">
            <div id="loading-progress-fill" class="loading-progress-fill"></div>
        </div>
    </div>

    <!-- Main Content (Initially hidden) -->
    <div class="main-content flex-1 ml-64 min-h-screen flex flex-col hidden" id="main-content">
        <!-- Top Header -->
        <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 py-4 px-8 flex items-center justify-between sticky top-0 z-10 content-fade-in">
            <div class="header-content flex items-center justify-between w-full">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white header-title">Application Management</h1>
                    <p class="text-gray-500 dark:text-gray-400 hidden md:block">Manage job applications and recruitment process</p>
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
                        
                        <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-700 dark:text-blue-300 font-medium hidden md:flex">
                            HR
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-8 overflow-y-auto custom-scrollbar">
            <!-- Status Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 stats-grid">
                <div class="card p-6 flex items-center content-fade-in stagger-delay-1">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-4">
                        <i class="fas fa-file-alt text-blue-600 dark:text-blue-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Total Applications</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">12</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center content-fade-in stagger-delay-2">
                    <div class="w-12 h-12 rounded-xl bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center mr-4">
                        <i class="fas fa-clock text-yellow-600 dark:text-yellow-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Pending Review</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">5</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center content-fade-in stagger-delay-3">
                    <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900 flex items-center justify-center mr-4">
                        <i class="fas fa-calendar-check text-green-600 dark:text-green-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Scheduled Interviews</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">3</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center content-fade-in stagger-delay-4">
                    <div class="w-12 h-12 rounded-xl bg-red-100 dark:bg-red-900 flex items-center justify-center mr-4">
                        <i class="fas fa-times-circle text-red-600 dark:text-red-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Rejected</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">4</div>
                    </div>
                </div>
            </div>

            <!-- Applications Table -->
            <div class="card overflow-hidden mb-8 content-fade-in stagger-delay-1">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Job Applications</h2>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Recent applications for various positions</p>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Applicant</th>
                                <th>Position Applied</th>
                                <th>Date Applied</th>
                                <th>Status</th>
                                <th>Contact Info</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 font-bold mr-3">
                                            JM
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white">John Michael Santos</div>
                                            <div class="text-gray-500 dark:text-gray-400 text-sm">Applied: 2025-09-15</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-medium">Production Supervisor</div>
                                    <div class="text-gray-500 dark:text-gray-400 text-sm">Production Department</div>
                                </td>
                                <td>2025-09-15</td>
                                <td>
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock text-xs mr-1"></i> Pending Review
                                    </span>
                                </td>
                                <td>
                                    <div class="text-sm">
                                        <div class="text-gray-900 dark:text-white">john.santos@email.com</div>
                                        <div class="text-gray-500 dark:text-gray-400">+63 912 345 6789</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex space-x-2">
                                        <button class="btn btn-success btn-sm" onclick="scheduleInterview(1)">
                                            <i class="fas fa-calendar-alt mr-1"></i> Schedule
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="rejectApplication(1)">
                                            <i class="fas fa-times mr-1"></i> Reject
                                        </button>
                                        <button class="btn btn-outline btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center text-green-600 dark:text-green-300 font-bold mr-3">
                                            AS
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white">Ana Sophia Reyes</div>
                                            <div class="text-gray-500 dark:text-gray-400 text-sm">Applied: 2025-09-14</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-medium">Quality Control Inspector</div>
                                    <div class="text-gray-500 dark:text-gray-400 text-sm">Quality Department</div>
                                </td>
                                <td>2025-09-14</td>
                                <td>
                                    <span class="badge badge-info">
                                        <i class="fas fa-calendar-check text-xs mr-1"></i> Interview Scheduled
                                    </span>
                                </td>
                                <td>
                                    <div class="text-sm">
                                        <div class="text-gray-900 dark:text-white">ana.reyes@email.com</div>
                                        <div class="text-gray-500 dark:text-gray-400">+63 923 456 7890</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex space-x-2">
                                        <button class="btn btn-warning btn-sm" onclick="rescheduleInterview(2)">
                                            <i class="fas fa-calendar-edit mr-1"></i> Reschedule
                                        </button>
                                        <button class="btn btn-success btn-sm" onclick="markAsHired(2)">
                                            <i class="fas fa-check mr-1"></i> Hire
                                        </button>
                                        <button class="btn btn-outline btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center text-red-600 dark:text-red-300 font-bold mr-3">
                                            CR
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white">Carlos Ramirez</div>
                                            <div class="text-gray-500 dark:text-gray-400 text-sm">Applied: 2025-09-12</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-medium">Maintenance Technician</div>
                                    <div class="text-gray-500 dark:text-gray-400 text-sm">Maintenance Department</div>
                                </td>
                                <td>2025-09-12</td>
                                <td>
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times-circle text-xs mr-1"></i> Rejected
                                    </span>
                                </td>
                                <td>
                                    <div class="text-sm">
                                        <div class="text-gray-900 dark:text-white">carlos.ramirez@email.com</div>
                                        <div class="text-gray-500 dark:text-gray-400">+63 934 567 8901</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex space-x-2">
                                        <button class="btn btn-outline btn-sm" onclick="reconsiderApplication(3)">
                                            <i class="fas fa-redo mr-1"></i> Reconsider
                                        </button>
                                        <button class="btn btn-outline btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center text-purple-600 dark:text-purple-300 font-bold mr-3">
                                            MG
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white">Maria Gonzales</div>
                                            <div class="text-gray-500 dark:text-gray-400 text-sm">Applied: 2025-09-10</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-medium">HR Assistant</div>
                                    <div class="text-gray-500 dark:text-gray-400 text-sm">Administration</div>
                                </td>
                                <td>2025-09-10</td>
                                <td>
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle text-xs mr-1"></i> Hired
                                    </span>
                                </td>
                                <td>
                                    <div class="text-sm">
                                        <div class="text-gray-900 dark:text-white">maria.gonzales@email.com</div>
                                        <div class="text-gray-500 dark:text-gray-400">+63 945 678 9012</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex space-x-2">
                                        <button class="btn btn-primary btn-sm" onclick="viewOfferLetter(4)">
                                            <i class="fas fa-file-contract mr-1"></i> Offer Letter
                                        </button>
                                        <button class="btn btn-outline btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center text-yellow-600 dark:text-yellow-300 font-bold mr-3">
                                            LR
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white">Luis Rivera</div>
                                            <div class="text-gray-500 dark:text-gray-400 text-sm">Applied: 2025-09-08</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-medium">Warehouse Staff</div>
                                    <div class="text-gray-500 dark:text-gray-400 text-sm">Logistics Department</div>
                                </td>
                                <td>2025-09-08</td>
                                <td>
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock text-xs mr-1"></i> Pending Review
                                    </span>
                                </td>
                                <td>
                                    <div class="text-sm">
                                        <div class="text-gray-900 dark:text-white">luis.rivera@email.com</div>
                                        <div class="text-gray-500 dark:text-gray-400">+63 956 789 0123</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex space-x-2">
                                        <button class="btn btn-success btn-sm" onclick="scheduleInterview(5)">
                                            <i class="fas fa-calendar-alt mr-1"></i> Schedule
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="rejectApplication(5)">
                                            <i class="fas fa-times mr-1"></i> Reject
                                        </button>
                                        <button class="btn btn-outline btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="p-6 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <div class="text-gray-500 dark:text-gray-400 text-sm">
                        Showing 1 to 5 of 12 entries
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            Previous
                        </button>
                        <button class="px-3 py-1 bg-blue-600 text-white rounded-lg">1</button>
                        <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            2
                        </button>
                        <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            3
                        </button>
                        <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            Next
                        </button>
                    </div>
                </div>
            </div>

            <!-- Application Status Chart -->
            <div class="card p-6 content-fade-in stagger-delay-2">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Application Status Overview</h2>
                <div class="flex items-center justify-center h-64">
                    <div class="text-center">
                        <div class="text-gray-500 dark:text-gray-400 mb-4">Status Distribution</div>
                        <div class="flex items-center justify-center space-x-8">
                            <div class="text-center">
                                <div class="w-20 h-20 rounded-full bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center mx-auto mb-2">
                                    <span class="text-2xl font-bold text-yellow-600 dark:text-yellow-300">5</span>
                                </div>
                                <div class="text-sm font-medium">Pending</div>
                            </div>
                            <div class="text-center">
                                <div class="w-20 h-20 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center mx-auto mb-2">
                                    <span class="text-2xl font-bold text-green-600 dark:text-green-300">3</span>
                                </div>
                                <div class="text-sm font-medium">Interview</div>
                            </div>
                            <div class="text-center">
                                <div class="w-20 h-20 rounded-full bg-red-100 dark:bg-red-900 flex items-center justify-center mx-auto mb-2">
                                    <span class="text-2xl font-bold text-red-600 dark:text-red-300">4</span>
                                </div>
                                <div class="text-sm font-medium">Rejected</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Encode Applicant Modal -->
    <div class="modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 hidden" id="encode-applicant-modal">
        <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <!-- Modal Header with Monti Textile Branding -->
            <div class="modal-header monti-header bg-gradient-to-r from-white to-blue-50 p-6 rounded-t-xl border-b border-blue-100">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="h-10 w-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-industry text-yellow-600 text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Monti Textile</h2>
                            <h3 class="text-lg font-semibold text-blue-700">Encode New Applicant</h3>
                        </div>
                    </div>
                    <button class="text-gray-500 hover:text-red-500 opacity-0 transition-colors duration-200" id="close-modal">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-6">
                <form id="applicant-form">
                    <div class="space-y-8">
                        
                        <!-- Full Name Section -->
                        <div class="form-group bg-blue-50 p-5 rounded-xl border border-blue-100">
                            <div class="flex items-center mb-4">
                                <div class="h-8 w-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <h4 class="text-lg font-bold text-blue-900">Full Name</h4>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                    <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="First Name" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                                    <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Middle Name">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                    <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Last Name" required>
                                </div>
                            </div>
                        </div>

                        <!-- Birth Date Section -->
                        <div class="form-group bg-white p-5 rounded-xl border border-gray-200">
                            <div class="flex items-center mb-4">
                                <div class="h-8 w-8 bg-yellow-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar text-white text-sm"></i>
                                </div>
                                <h4 class="text-lg font-bold text-gray-800">Birth Date</h4>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Month</label>
                                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                                        <option value="">Select Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Day</label>
                                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                                        <option value="">Select Day</option>
                                        <!-- Days 1-31 -->
                                        <script>
                                            for(let i=1; i<=31; i++) {
                                                document.write(`<option value="${i}">${i}</option>`);
                                            }
                                        </script>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                                        <option value="">Select Year</option>
                                        <!-- Years 1960-2023 -->
                                        <script>
                                            const currentYear = new Date().getFullYear();
                                            for(let i=currentYear; i>=1960; i--) {
                                                document.write(`<option value="${i}">${i}</option>`);
                                            }
                                        </script>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Current Address Section -->
                        <div class="form-group bg-blue-50 p-5 rounded-xl border border-blue-100">
                            <div class="flex items-center mb-4">
                                <div class="h-8 w-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-home text-white text-sm"></i>
                                </div>
                                <h4 class="text-lg font-bold text-blue-900">Current Address</h4>
                            </div>
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Street Address</label>
                                    <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Street Address" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Street Address Line 2</label>
                                    <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Apartment, Suite, Unit, etc.">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="City" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">State / Province</label>
                                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="State / Province" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Postal / Zip Code</label>
                                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Postal / Zip Code" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="form-group bg-white p-5 rounded-xl border border-gray-200">
                            <div class="flex items-center mb-4">
                                <div class="h-8 w-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-phone text-white text-sm"></i>
                                </div>
                                <h4 class="text-lg font-bold text-gray-800">Contact Information</h4>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                    <input type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="myname@example.com" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                    <input type="tel" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="000 800-0600" required>
                                </div>
                            </div>
                            <div class="mt-5">
                                <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn Profile (Optional)</label>
                                <input type="url" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="https://linkedin.com/in/username">
                            </div>
                        </div>

                        <!-- Position Information -->
                        <div class="form-group bg-blue-50 p-5 rounded-xl border border-blue-100">
                            <div class="flex items-center mb-4">
                                <div class="h-8 w-8 bg-yellow-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-briefcase text-white text-sm"></i>
                                </div>
                                <h4 class="text-lg font-bold text-blue-900">Position Information</h4>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Position Applied For</label>
                                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                                        <option value="">Please Select</option>
                                        <option value="production_supervisor">Production Supervisor</option>
                                        <option value="quality_inspector">Quality Control Inspector</option>
                                        <option value="maintenance_tech">Maintenance Technician</option>
                                        <option value="hr_assistant">HR Assistant</option>
                                        <option value="warehouse_staff">Warehouse Staff</option>
                                        <option value="textile_designer">Textile Designer</option>
                                        <option value="machine_operator">Machine Operator</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">How did you hear about us?</label>
                                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                                        <option value="">Please Select</option>
                                        <option value="linkedin">LinkedIn</option>
                                        <option value="job_portal">Job Portal</option>
                                        <option value="referral">Employee Referral</option>
                                        <option value="social_media">Social Media</option>
                                        <option value="company_website">Company Website</option>
                                        <option value="career_fair">Career Fair</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-5">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Available Start Date</label>
                                <input type="date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                            </div>
                        </div>

                        <!-- Documents Section -->
                        <div class="form-group bg-white p-5 rounded-xl border border-gray-200">
                            <div class="flex items-center mb-4">
                                <div class="h-8 w-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-file-alt text-white text-sm"></i>
                                </div>
                                <h4 class="text-lg font-bold text-gray-800">Documents</h4>
                            </div>
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Your Resume</label>
                                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center transition-all duration-200 hover:border-blue-400 hover:bg-blue-50">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-blue-400 mb-3"></i>
                                        <p class="text-gray-600 mb-2">Drag and drop your resume here</p>
                                        <p class="text-gray-500 text-sm mb-4">or</p>
                                        <button type="button" class="bg-white border border-blue-500 text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                            <i class="fas fa-folder-open mr-2"></i> Browse Files
                                        </button>
                                        <p class="text-gray-400 text-xs mt-4">PDF, DOC, DOCX up to 5MB</p>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Cover Letter (Optional)</label>
                                    <textarea class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" rows="4" placeholder="Write your cover letter here..."></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information Section -->
                        <div class="form-group bg-yellow-50 p-5 rounded-xl border border-yellow-100">
                            <div class="flex items-center mb-4">
                                <div class="h-8 w-8 bg-yellow-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-info-circle text-white text-sm"></i>
                                </div>
                                <h4 class="text-lg font-bold text-gray-800">Additional Information</h4>
                            </div>
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Expected Salary (per month)</label>
                                    <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="e.g., ₱25,000 - ₱30,000">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Notice Period (if currently employed)</label>
                                    <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                        <option value="">Select Notice Period</option>
                                        <option value="immediate">Immediate</option>
                                        <option value="1_week">1 Week</option>
                                        <option value="2_weeks">2 Weeks</option>
                                        <option value="1_month">1 Month</option>
                                        <option value="2_months">2 Months</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Do you have textile industry experience?</label>
                                    <div class="flex space-x-6 mt-2">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="experience" value="yes" class="text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2">Yes</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="experience" value="no" class="text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2">No</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row justify-between items-center pt-8 border-t border-gray-200 space-y-4 sm:space-y-0">
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-shield-alt text-blue-400 mr-2"></i>
                                Your information is secure and confidential
                            </div>
                            <div class="flex space-x-4">
                                <button type="button" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-6 py-3 rounded-lg font-medium transition-colors duration-200" id="cancel-form">
                                    Cancel
                                </button>
                                <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-8 py-3 rounded-lg font-medium shadow-md hover:shadow-lg transition-all duration-200">
                                    <i class="fas fa-save mr-2"></i> Save Applicant
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        // Content loading functionality
        const contentLoadingOverlay = document.getElementById('content-loading-overlay');
        const loadingProgressFill = document.getElementById('loading-progress-fill');
        const mainContent = document.getElementById('main-content');
        const sidebar = document.getElementById('sidebar');
        
        // Adjust loading overlay position when sidebar collapses/expands
        function adjustLoadingOverlay() {
            if (window.innerWidth >= 1024) {
                if (sidebar.classList.contains('collapsed')) {
                    contentLoadingOverlay.style.left = '80px';
                } else {
                    contentLoadingOverlay.style.left = '260px';
                }
            } else {
                contentLoadingOverlay.style.left = '0';
            }
        }
        
        // Simulate loading progress
        function simulateLoading() {
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 15;
                if (progress > 95) {
                    progress = 95;
                }
                loadingProgressFill.style.width = progress + '%';
                
                if (progress >= 95) {
                    clearInterval(interval);
                }
            }, 200);
        }
        
        // Hide loading overlay and show main content
        function showMainContent() {
            loadingProgressFill.style.width = '100%';
            
            setTimeout(() => {
                contentLoadingOverlay.classList.add('hidden');
                mainContent.classList.remove('hidden');
                mainContent.classList.add('visible');
                
                // Add animation classes to content elements
                const contentElements = document.querySelectorAll('.content-fade-in');
                contentElements.forEach((el, index) => {
                    el.style.animationDelay = (index * 0.1) + 's';
                    el.style.opacity = '1';
                });
                
                // Remove loading overlay from DOM after animation
                setTimeout(() => {
                    contentLoadingOverlay.style.display = 'none';
                }, 500);
            }, 300);
        }
        
        // Start loading simulation
        document.addEventListener('DOMContentLoaded', () => {
            simulateLoading();
            adjustLoadingOverlay();
            
            // Initialize sidebar toggle listeners immediately
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
            const mobileOverlay = document.getElementById('mobile-overlay');
            
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
                    adjustLoadingOverlay();
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
            
            // Event listeners for sidebar (work immediately)
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', toggleSidebar);
            }
            if (mobileOverlay) {
                mobileOverlay.addEventListener('click', closeSidebar);
            }
            
            // Handle responsive behavior on load
            if (window.innerWidth < 1024) {
                mainContent.style.marginLeft = '0';
            }
        });
        
        // Hide overlay when window is fully loaded
        window.addEventListener('load', () => {
            showMainContent();
        });
        
        // Fallback: hide loading after 3 seconds max
        setTimeout(() => {
            if (!contentLoadingOverlay.classList.contains('hidden')) {
                showMainContent();
            }
        }, 3000);
        
        // Handle window resize
        window.addEventListener('resize', () => {
            adjustLoadingOverlay();
            
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
                adjustLoadingOverlay();
            }
        });

        // Initialize progress animations when main content is shown
        mainContent.addEventListener('animationend', () => {
            const progressBars = document.querySelectorAll('.course-progress-fill');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });
        });

        // Modal functionality
        const encodeBtn = document.getElementById('encode-applicant-btn');
        const modal = document.getElementById('encode-applicant-modal');
        const closeModal = document.getElementById('close-modal');
        const cancelForm = document.getElementById('cancel-form');
        const applicantForm = document.getElementById('applicant-form');
        
        // Create encode button if not exists in DOM
        if (!encodeBtn) {
            const newEncodeBtn = document.createElement('button');
            newEncodeBtn.className = 'btn btn-primary';
            newEncodeBtn.id = 'encode-applicant-btn';
            newEncodeBtn.innerHTML = '<i class="fas fa-plus mr-2"></i> Encode New Applicant';
            document.querySelector('.header-actions .flex').prepend(newEncodeBtn);
        }
        
        const encodeBtnElement = document.getElementById('encode-applicant-btn');
        
        encodeBtnElement.addEventListener('click', () => {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
        
        closeModal.addEventListener('click', () => {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        cancelForm.addEventListener('click', () => {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
        
        // Form submission
        applicantForm.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Applicant information saved successfully!');
            modal.classList.remove('active');
            document.body.style.overflow = '';
            applicantForm.reset();
        });
        
        // Action functions
        function scheduleInterview(id) {
            if (confirm('Schedule interview for this applicant?')) {
                alert(`Interview scheduled for applicant #${id}`);
                // Update UI here
            }
        }
        
        function rejectApplication(id) {
            if (confirm('Reject this application?')) {
                alert(`Application #${id} rejected`);
                // Update UI here
            }
        }
        
        function rescheduleInterview(id) {
            alert(`Reschedule interview for applicant #${id}`);
        }
        
        function markAsHired(id) {
            if (confirm('Mark this applicant as hired?')) {
                alert(`Applicant #${id} marked as hired`);
                // Update UI here
            }
        }
        
        function reconsiderApplication(id) {
            alert(`Application #${id} sent for reconsideration`);
        }
        
        function viewOfferLetter(id) {
            alert(`Viewing offer letter for applicant #${id}`);
        }

        document.querySelectorAll('.sidebar-item').forEach(l=>l.addEventListener('click',e=>{e.preventDefault();setTimeout(()=>window.location.href=l.getAttribute('href'),300)}));
    </script>
</body>
</html>