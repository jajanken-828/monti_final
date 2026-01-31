<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Process Payroll Run - Monti Textile HRM</title>

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

    <!-- Custom color overrides for blue/yellow theme -->
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
        
        /* Payroll Table */
        .payroll-table-container {
            overflow-x: auto;
            border-radius: 0.75rem;
            border: 1px solid #e5e7eb;
            background: white;
        }
        
        .payroll-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .payroll-table thead {
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        .payroll-table th {
            background-color: #f8fafc;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #e5e7eb;
            position: relative;
            padding: 12px 8px;
            white-space: nowrap;
        }
        
        .payroll-table td {
            vertical-align: middle;
            padding: 12px 8px;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .payroll-table tr:hover td {
            background-color: #f8fafc;
        }
        
        /* Role & Department Grouping */
        .role-section {
            background: linear-gradient(to right, rgba(37, 99, 235, 0.15), rgba(37, 99, 235, 0.05));
            border-left: 6px solid #2563eb;
        }
        
        .role-section td {
            background-color: #eff6ff;
            font-weight: 700;
            color: #1e40af;
            padding: 16px 8px;
            border-bottom: 2px solid #2563eb;
            font-size: 1rem;
        }
        
        .department-section {
            background: linear-gradient(to right, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.03));
            border-left: 4px solid #3b82f6;
        }
        
        .department-section td {
            background-color: #f0f9ff;
            font-weight: 600;
            color: #1e40af;
            padding: 14px 8px;
            border-bottom: 2px solid #3b82f6;
        }
        
        .amount-input {
            width: 100%;
            text-align: right;
            font-family: 'SF Mono', Monaco, monospace;
            font-weight: 500;
            padding: 6px 8px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            transition: all 0.2s;
        }
        
        .amount-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }
        
        .hours-input {
            width: 70px;
            text-align: center;
            padding: 6px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            transition: all 0.2s;
        }
        
        .hours-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }
        
        .rate-input {
            width: 80px;
            text-align: right;
            padding: 6px 8px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            transition: all 0.2s;
        }
        
        .rate-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }
        
        .net-pay {
            font-weight: 700;
            color: #059669;
            font-size: 0.95rem;
        }
        
        .deduction {
            color: #dc2626;
        }
        
        .addition {
            color: #059669;
        }
        
        .employee-checkbox {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }
        
        .approval-status {
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-block;
            min-width: 80px;
            text-align: center;
        }
        
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .status-approved {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        /* Violation badges */
        .violation-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            margin: 1px;
        }
        
        .violation-late {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .violation-absent {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .violation-undertime {
            background-color: #fef9c3;
            color: #854d0e;
        }
        
        /* Fixed columns */
        .fixed-column {
            position: sticky;
            left: 0;
            background-color: white;
            z-index: 5;
            border-right: 1px solid #e5e7eb;
        }
        
        .dark .fixed-column {
            background-color: #1f2937;
            border-right-color: #374151;
        }
        
        /* Dark mode table styles */
        .dark .payroll-table-container {
            background-color: #1f2937;
            border-color: #374151;
        }
        
        .dark .payroll-table th {
            background-color: #374151;
            border-color: #4b5563;
            color: #d1d5db;
        }
        
        .dark .payroll-table td {
            border-color: #374151;
            color: #d1d5db;
        }
        
        .dark .payroll-table tr:hover td {
            background-color: #2d3748;
        }
        
        .dark .amount-input,
        .dark .hours-input,
        .dark .rate-input {
            background-color: #374151;
            border-color: #4b5563;
            color: #f9fafb;
        }
        
        .dark .role-section td {
            background-color: rgba(37, 99, 235, 0.2);
            color: #93c5fd;
        }
        
        .dark .department-section td {
            background-color: rgba(59, 130, 246, 0.15);
            color: #93c5fd;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
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
            max-width: 900px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .dark .modal-content {
            background-color: #1f2937;
            color: #f9fafb;
        }
        
        .modal-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .dark .modal-header {
            border-bottom-color: #374151;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .modal-footer {
            padding: 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
        }
        
        .dark .modal-footer {
            border-top-color: #374151;
        }
        
        .rate-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .rate-card {
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 1rem;
            background: #f9fafb;
        }
        
        .dark .rate-card {
            background-color: #2d3748;
            border-color: #4b5563;
        }
        
        /* Holiday Modal Specific */
        .holiday-modal .modal-content {
            max-width: 800px;
        }
        
        .holiday-form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .holiday-list {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.5rem;
        }
        
        .dark .holiday-list {
            border-color: #4b5563;
        }
        
        .holiday-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            border-bottom: 1px solid #e5e7eb;
            transition: background-color 0.2s;
        }
        
        .holiday-item:hover {
            background-color: #f9fafb;
        }
        
        .dark .holiday-item {
            border-bottom-color: #4b5563;
        }
        
        .dark .holiday-item:hover {
            background-color: #374151;
        }
        
        .holiday-item:last-child {
            border-bottom: none;
        }
        
        .holiday-item-info {
            flex: 1;
        }
        
        .holiday-item-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .holiday-type-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            margin-top: 0.25rem;
        }
        
        .holiday-regular {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .holiday-special {
            background-color: #f3e8ff;
            color: #7c3aed;
        }
        
        .holiday-religious {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .holiday-national {
            background-color: #dcfce7;
            color: #166534;
        }
        
        /* Deduction Rules Table */
        .deduction-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        
        .deduction-table th,
        .deduction-table td {
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            text-align: left;
        }
        
        .dark .deduction-table th,
        .dark .deduction-table td {
            border-color: #4b5563;
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
            
            .payroll-table-container {
                overflow-x: auto;
            }
            
            .payroll-table {
                min-width: 1200px;
            }
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
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
            
            .modal-content {
                width: 95%;
                margin: 1rem;
            }
            
            .rate-grid {
                grid-template-columns: 1fr;
            }
            
            .holiday-form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <!-- Mobile Overlay -->
    <div class="mobile-sidebar-overlay" id="mobile-overlay"></div>

    <!-- Sidebar (Loads immediately) -->
    @include('uno.hrm.hrm_staff.SideBarHrStaff')

    <!-- Content Loading Overlay -->
    <div id="content-loading-overlay" class="content-loading-overlay">
        <div class="loading-spinner"></div>
        <div class="loading-content">
            <h3>Monti Textile HRM</h3>
            <p>Loading payroll processing...</p>
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
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white header-title">Process Payroll Run</h1>
                    <p class="text-gray-500 dark:text-gray-400 hidden md:block">Set employee rates and submit for HR approval</p>
                </div>
                
                <div class="flex items-center space-x-4 header-actions">
                    <div class="flex items-center space-x-3">
                        <button id="manage-holidays-btn" class="px-4 py-2.5 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-medium transition-colors">
                            <i class="fas fa-calendar-day mr-2"></i> Manage Holidays
                        </button>
                        
                        <button id="configure-payroll-btn" class="px-4 py-2.5 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-medium transition-colors">
                            <i class="fas fa-cog mr-2"></i> Configure Payroll
                        </button>
                        
                        <button class="relative p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">3</span>
                        </button>
                        
                        <button class="md:hidden p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300" id="mobile-menu-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-700 dark:text-blue-300 font-medium hidden md:flex">
                            PO
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-8 overflow-y-auto custom-scrollbar">
            <!-- Payroll Run Header -->
            <div class="card p-6 mb-8 content-fade-in stagger-delay-1">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Payroll Run</h2>
                        <div class="flex items-center flex-wrap gap-4">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt text-blue-theme mr-2"></i>
                                <span class="text-gray-600 dark:text-gray-400" id="pay-period">Select Pay Period</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-users text-blue-theme mr-2"></i>
                                <span class="text-gray-600 dark:text-gray-400" id="employee-count">0 Employees</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-money-bill-wave text-blue-theme mr-2"></i>
                                <span class="text-gray-600 dark:text-gray-400" id="total-estimated">₱0.00</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 payroll-action-buttons">
                        <a href="{{ route('hrm.staff.payroll') }}" class="px-4 py-2.5 bg-white border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Payroll
                        </a>
                        <button id="submit-for-approval" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors flex items-center">
                            <i class="fas fa-paper-plane mr-2"></i> Submit for HR Approval
                        </button>
                    </div>
                </div>
                
                <!-- Applied Rates & Holidays Summary -->
                <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-blue-800 dark:text-blue-200">Active Payroll Configuration</span>
                        <div class="flex gap-2">
                            <button id="view-rates-summary" class="text-xs text-blue-600 dark:text-blue-300 hover:underline">View Rates</button>
                            <span class="text-gray-400">|</span>
                            <button id="view-holidays-summary" class="text-xs text-blue-600 dark:text-blue-300 hover:underline">View Holidays</button>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <span class="text-gray-600 dark:text-gray-400">Managerial Basic:</span>
                            <span class="font-medium ml-2" id="summary-managerial-basic">₱0/day</span>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-400">Staff Basic:</span>
                            <span class="font-medium ml-2" id="summary-staff-basic">₱0/day</span>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-400">Active Holidays:</span>
                            <span class="font-medium ml-2" id="summary-holidays-count">0 days</span>
                        </div>
                        <div>
                            <span class="text-gray-600 dark:text-gray-400">Late Rate:</span>
                            <span class="font-medium ml-2" id="summary-late-rate">₱0/min</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Summary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 payroll-summary-cards">
                <div class="card p-6 content-fade-in stagger-delay-1">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-gray-500 dark:text-gray-400 text-sm">Managerial Total</div>
                            <div class="text-2xl font-bold text-gray-900 dark:text-white" id="managerial-total">₱0.00</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400" id="managerial-count">0 Employees</div>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                            <i class="fas fa-user-tie text-purple-600 dark:text-purple-300 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card p-6 content-fade-in stagger-delay-2">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-gray-500 dark:text-gray-400 text-sm">Staff Total</div>
                            <div class="text-2xl font-bold text-gray-900 dark:text-white" id="staff-total">₱0.00</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400" id="staff-count">0 Employees</div>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <i class="fas fa-user text-blue-600 dark:text-blue-300 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card p-6 content-fade-in stagger-delay-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-gray-500 dark:text-gray-400 text-sm">Holiday Pay Total</div>
                            <div class="text-2xl font-bold text-gray-900 dark:text-white" id="holiday-total">₱0.00</div>
                            <div class="text-sm text-green-600 dark:text-green-400" id="holiday-count">For 0 holidays</div>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-orange-100 dark:bg-orange-900 flex items-center justify-center">
                            <i class="fas fa-calendar-day text-orange-600 dark:text-orange-300 text-xl"></i>
                        </div>
                    </div>
                </div>
                
                <div class="card p-6 content-fade-in stagger-delay-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-gray-500 dark:text-gray-400 text-sm">Net Pay Total</div>
                            <div class="text-2xl font-bold text-gray-900 dark:text-white" id="net-total">₱0.00</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">After deductions</div>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900 flex items-center justify-center">
                            <i class="fas fa-hand-holding-usd text-green-600 dark:text-green-300 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Role Tabs -->
            <div class="mb-6 content-fade-in stagger-delay-1">
                <div class="flex flex-wrap gap-2 mb-4">
                    <button class="px-4 py-2 rounded-lg bg-blue-theme text-white font-medium role-tab active" data-role="all">
                        All Roles
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium role-tab" data-role="managerial">
                        Managerial
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium role-tab" data-role="staff">
                        Staff
                    </button>
                </div>
                
                <!-- Bulk Actions -->
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="select-all" class="employee-checkbox h-4 w-4 text-blue-600 rounded border-gray-300">
                            <label for="select-all" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Select All</label>
                        </div>
                        
                        <select class="input-field text-sm py-1.5" id="bulk-action">
                            <option value="">Bulk Actions</option>
                            <option value="apply-bonus">Apply 13th Month Bonus</option>
                            <option value="increase-5">Increase 5%</option>
                            <option value="apply-overtime">Apply Overtime</option>
                            <option value="reset">Reset to Default</option>
                        </select>
                        
                        <button id="apply-bulk-action" class="px-4 py-1.5 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-lg text-sm font-medium hover:bg-blue-200 dark:hover:bg-blue-800">
                            Apply
                        </button>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <button class="px-4 py-2 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200 rounded-lg text-sm font-medium hover:bg-yellow-200 dark:hover:bg-yellow-800">
                            <i class="fas fa-download mr-2"></i> Export
                        </button>
                        <button id="recalculate-all" class="px-4 py-2 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg text-sm font-medium hover:bg-green-200 dark:hover:bg-green-800">
                            <i class="fas fa-calculator mr-2"></i> Recalculate All
                        </button>
                    </div>
                </div>
            </div>

            <!-- Payroll Table -->
            <div class="payroll-table-container content-fade-in stagger-delay-2">
                <table class="payroll-table">
                    <thead>
                        <tr>
                            <th class="py-3 px-4 text-left fixed-column">
                                <input type="checkbox" id="select-all-header" class="employee-checkbox">
                            </th>
                            <th class="py-3 px-4 text-left">Employee</th>
                            <th class="py-3 px-4 text-left">Role</th>
                            <th class="py-3 px-4 text-left">Department</th>
                            <th class="py-3 px-4 text-left">Basic Rate</th>
                            <th class="py-3 px-4 text-left">Days Worked</th>
                            <th class="py-3 px-4 text-left">Basic Pay</th>
                            <th class="py-3 px-4 text-left">Night Diff</th>
                            <th class="py-3 px-4 text-left">Overtime</th>
                            <th class="py-3 px-4 text-left">Holiday Pay</th>
                            <th class="py-3 px-4 text-left">Violations</th>
                            <th class="py-3 px-4 text-left">SSS</th>
                            <th class="py-3 px-4 text-left">PhilHealth</th>
                            <th class="py-3 px-4 text-left">Pag-IBIG</th>
                            <th class="py-3 px-4 text-left">Gross Pay</th>
                            <th class="py-3 px-4 text-left">Total Deductions</th>
                            <th class="py-3 px-4 text-left">Net Pay</th>
                            <th class="py-3 px-4 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody id="payroll-data">
                        <!-- Employee data will be loaded here from backend -->
                        <tr id="no-data-row">
                            <td colspan="18" class="py-8 text-center text-gray-500 dark:text-gray-400">
                                <i class="fas fa-users text-3xl mb-2"></i>
                                <p>No employee data available. Please configure payroll settings first.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Submission Section with Manual Correction -->
            <div class="card p-6 mt-8 content-fade-in stagger-delay-3">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Submit for HR Manager Approval</h3>
                
                <!-- Correction Toggle -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h4 class="font-medium text-gray-900 dark:text-white">Submission Type</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Choose between full payroll or correction submission</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="submission_type" value="full" class="h-4 w-4 text-blue-600" checked>
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Full Payroll</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="submission_type" value="correction" class="h-4 w-4 text-blue-600">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Manual Correction</span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Full Payroll Submission (Default) -->
                <div id="full-payroll-form">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select HR Manager</label>
                                <select class="input-field w-full" id="hr-manager-select">
                                    <option value="">Choose HR Manager</option>
                                    <!-- HR Managers will be loaded from backend -->
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Payment Date</label>
                                <input type="date" class="input-field w-full" id="payment-date">
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Payment Method</label>
                                <select class="input-field w-full" id="payment-method">
                                    <option value="bank">Bank Transfer</option>
                                    <option value="cash">Cash</option>
                                    <option value="check">Check</option>
                                </select>
                            </div>
                        </div>
                        
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notes for HR Manager</label>
                                <textarea class="input-field w-full h-32" id="hr-notes" placeholder="Add any special notes or instructions for the HR manager..."></textarea>
                            </div>
                            
                            <div class="flex items-center mb-4">
                                <input type="checkbox" id="send-email" class="h-4 w-4 text-blue-600 rounded border-gray-300">
                                <label for="send-email" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Send email notification to HR Manager</label>
                            </div>
                            
                            <div class="flex items-center mb-4">
                                <input type="checkbox" id="generate-payslips" class="h-4 w-4 text-blue-600 rounded border-gray-300" checked>
                                <label for="generate-payslips" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Generate payslips automatically</label>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" id="lock-payroll" class="h-4 w-4 text-blue-600 rounded border-gray-300" checked>
                                <label for="lock-payroll" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Lock payroll after submission</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Manual Correction Form -->
                <div id="correction-form" class="hidden">
                    <!-- Employee Search -->
                    <div class="bg-blue-50 dark:bg-blue-900 rounded-lg p-4 mb-6">
                        <h4 class="font-medium text-blue-800 dark:text-blue-200 mb-3">Find Employee for Correction</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-1">Employee ID</label>
                                <input type="text" class="input-field" id="correction-employee-id" placeholder="EMP-2023-001">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-blue-700 dark:text-blue-300 mb-1">Employee Name</label>
                                <input type="text" class="input-field" id="correction-employee-name" placeholder="John Dela Cruz">
                            </div>
                            <div class="flex items-end">
                                <button id="search-employee-btn" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                                    <i class="fas fa-search mr-2"></i> Search Employee
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Employee Details -->
                    <div id="employee-correction-details" class="mb-6 hidden">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-medium text-gray-900 dark:text-white">Employee Payroll Details</h4>
                            <span class="text-sm px-3 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-300 rounded-full">Editing Mode</span>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 mb-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400">Employee Name</span>
                                    <span class="font-medium text-gray-900 dark:text-white" id="correction-employee-fullname"></span>
                                </div>
                                <div>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400">Employee ID</span>
                                    <span class="font-medium text-gray-900 dark:text-white" id="correction-employee-emp-id"></span>
                                </div>
                                <div>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400">Department</span>
                                    <span class="font-medium text-gray-900 dark:text-white" id="correction-employee-dept"></span>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400">Role</span>
                                    <span id="correction-employee-role" class="px-2 py-1 text-xs rounded-full"></span>
                                </div>
                                <div>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400">Pay Period</span>
                                    <span class="font-medium text-gray-900 dark:text-white" id="correction-pay-period"></span>
                                </div>
                                <div>
                                    <span class="block text-sm text-gray-500 dark:text-gray-400">Current Status</span>
                                    <span id="correction-employee-status" class="px-2 py-1 text-xs rounded-full"></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Editable Payroll Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6" id="correction-fields">
                            <!-- Fields will be populated dynamically -->
                        </div>
                    </div>
                    
                    <!-- Correction Details -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 dark:text-white mb-3">Correction Details</h4>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Correction Reason</label>
                            <select class="input-field w-full mb-2" id="correction-reason">
                                <option value="">Select reason for correction</option>
                                <option value="incorrect_hours">Incorrect hours/attendance</option>
                                <option value="wrong_rate">Wrong pay rate applied</option>
                                <option value="missing_allowance">Missing allowance/bonus</option>
                                <option value="deduction_error">Deduction calculation error</option>
                                <option value="overtime_error">Overtime calculation error</option>
                                <option value="holiday_error">Holiday pay error</option>
                                <option value="other">Other (specify below)</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Detailed Explanation</label>
                            <textarea class="input-field w-full h-24" id="correction-explanation" placeholder="Provide detailed explanation of what needs to be corrected and why..."></textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Supporting Documents</label>
                            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-4 text-center">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-2xl mb-2"></i>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Drop files here or click to upload</p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Supported: PDF, JPG, PNG (Max 5MB each)</p>
                                <input type="file" class="hidden" id="supporting-docs" multiple>
                                <label for="supporting-docs" class="mt-2 inline-block px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-sm cursor-pointer">
                                    <i class="fas fa-paperclip mr-2"></i> Choose Files
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- HR Approval Details -->
                    <div class="mb-6">
                        <h4 class="font-medium text-gray-900 dark:text-white mb-3">HR Approval Details</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select HR Manager</label>
                                <select class="input-field w-full" id="correction-hr-manager">
                                    <option value="">Choose HR Manager</option>
                                    <!-- HR Managers will be loaded from backend -->
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Priority Level</label>
                                <select class="input-field w-full" id="correction-priority">
                                    <option value="normal">Normal Priority</option>
                                    <option value="high">High Priority (Urgent)</option>
                                    <option value="critical">Critical (Immediate attention)</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Additional Notes for HR</label>
                            <textarea class="input-field w-full h-20" id="correction-hr-notes" placeholder="Add any special notes or instructions for the HR manager..."></textarea>
                        </div>
                    </div>
                    
                    <!-- Summary of Changes -->
                    <div class="bg-yellow-50 dark:bg-yellow-900 rounded-lg p-4 mb-6 hidden" id="correction-summary">
                        <h4 class="font-medium text-yellow-800 dark:text-yellow-300 mb-3">Summary of Changes</h4>
                        <div class="space-y-2" id="correction-summary-details">
                            <!-- Summary will be populated dynamically -->
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-between">
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                        <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                        <span id="submission-info">Select payroll data first</span>
                    </div>
                    
                    <div class="flex">
                        <button type="button" id="save-draft-btn" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-300 dark:hover:bg-gray-600 mr-4">
                            Save as Draft
                        </button>
                        <button id="submit-approval-btn" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors flex items-center">
                            <i class="fas fa-paper-plane mr-2"></i> Submit for Approval
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Configure Payroll Modal -->
    <div id="configure-payroll-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Configure Payroll Rates & Deductions</h3>
                <button class="close-modal text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Role-Based Rate Settings -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Role-Based Rate Settings</h4>
                    <div class="rate-grid">
                        <div class="rate-card">
                            <div class="flex items-center justify-between mb-3">
                                <span class="font-medium text-gray-900 dark:text-white">Managerial Rate</span>
                                <span class="text-sm px-2 py-1 bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-300 rounded" id="managerial-employee-count">0 employees</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Basic Daily Rate</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="number" id="managerial-basic-rate" class="input-field pl-8" value="0" min="0" step="1">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Night Differential (%)</label>
                                <div class="relative">
                                    <input type="number" id="managerial-night-rate" class="input-field" value="0" min="0" max="100" step="0.1">
                                    <span class="absolute right-3 top-2 text-gray-400">%</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Overtime Rate Multiplier</label>
                                <select id="managerial-ot-multiplier" class="input-field">
                                    <option value="1.25" selected>1.25x (Regular)</option>
                                    <option value="1.3">1.3x (Special)</option>
                                    <option value="2.0">2.0x (Holiday)</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="rate-card">
                            <div class="flex items-center justify-between mb-3">
                                <span class="font-medium text-gray-900 dark:text-white">Staff Rate</span>
                                <span class="text-sm px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 rounded" id="staff-employee-count">0 employees</span>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Basic Daily Rate</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="number" id="staff-basic-rate" class="input-field pl-8" value="0" min="0" step="1">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Night Differential (%)</label>
                                <div class="relative">
                                    <input type="number" id="staff-night-rate" class="input-field" value="0" min="0" max="100" step="0.1">
                                    <span class="absolute right-3 top-2 text-gray-400">%</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Overtime Rate Multiplier</label>
                                <select id="staff-ot-multiplier" class="input-field">
                                    <option value="1.25" selected>1.25x (Regular)</option>
                                    <option value="1.3">1.3x (Special)</option>
                                    <option value="2.0">2.0x (Holiday)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Automatic Deductions -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Automatic Deduction Rules</h4>
                    
                    <!-- Violation Deductions -->
                    <div class="mb-6">
                        <h5 class="font-medium text-gray-900 dark:text-white mb-3">Attendance Violations</h5>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Late Per Minute</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="number" id="late-rate" class="input-field pl-8" value="0" min="0" step="0.1">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Absent Per Day</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="number" id="absent-rate" class="input-field pl-8" value="0" min="0" step="1">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Undertime Per Hour</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                    <input type="number" id="undertime-rate" class="input-field pl-8" value="0" min="0" step="0.1">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Statutory Deductions -->
                    <div>
                        <h5 class="font-medium text-gray-900 dark:text-white mb-3">Statutory Deductions (Based on Salary Range)</h5>
                        <div class="overflow-x-auto">
                            <table class="deduction-table">
                                <thead>
                                    <tr>
                                        <th>Salary Range</th>
                                        <th>SSS</th>
                                        <th>PhilHealth</th>
                                        <th>Pag-IBIG</th>
                                    </tr>
                                </thead>
                                <tbody id="statutory-deductions-body">
                                    <!-- Statutory deductions will be loaded from backend -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Loan Deductions -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Loan Deductions</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">SSS Loan (Default)</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                <input type="number" id="sss-loan" class="input-field pl-8" value="0" min="0" step="1">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Pag-IBIG Loan (Default)</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-400">₱</span>
                                <input type="number" id="pagibig-loan" class="input-field pl-8" value="0" min="0" step="1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="px-6 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-300 dark:hover:bg-gray-600 close-modal">
                    Cancel
                </button>
                <button id="save-payroll-settings" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                    Save Settings & Apply
                </button>
            </div>
        </div>
    </div>

    <!-- Manage Holidays Modal -->
    <div id="manage-holidays-modal" class="modal holiday-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Manage Holidays</h3>
                <button class="close-modal text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add New Holiday Form -->
                <div class="mb-8">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Add New Holiday</h4>
                    <div class="holiday-form-grid">
                        <div>
                            <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Holiday Name</label>
                            <input type="text" id="holiday-name" class="input-field" placeholder="e.g., All Saints' Day">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Date</label>
                            <input type="date" id="holiday-date" class="input-field">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Type</label>
                            <select id="holiday-type" class="input-field">
                                <option value="regular">Regular Holiday</option>
                                <option value="special">Special Holiday</option>
                                <option value="religious">Religious Holiday</option>
                                <option value="national">National Holiday</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-sm text-gray-600 dark:text-gray-400 mb-1">Rate Multiplier</label>
                            <select id="holiday-multiplier" class="input-field">
                                <option value="2.0" selected>2.0x (Double Pay)</option>
                                <option value="1.3">1.3x (130%)</option>
                                <option value="1.5">1.5x (150%)</option>
                                <option value="2.6">2.6x (Double + 30%)</option>
                                <option value="3.0">3.0x (Triple Pay)</option>
                            </select>
                        </div>
                        <div class="flex items-center pt-6">
                            <input type="checkbox" id="paid-if-not-working" class="h-4 w-4 text-blue-600 rounded border-gray-300" checked>
                            <label for="paid-if-not-working" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Paid even if not working</label>
                        </div>
                    </div>
                    
                    <div class="mt-4 flex justify-end">
                        <button id="add-holiday-btn" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                            <i class="fas fa-plus mr-2"></i> Add Holiday
                        </button>
                    </div>
                </div>
                
                <!-- Active Holidays List -->
                <div>
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Active Holidays</h4>
                    <div class="holiday-list" id="holiday-list-container">
                        <!-- Holiday items will be dynamically added here -->
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400" id="no-holidays-message">
                            <i class="fas fa-calendar-day text-3xl mb-2"></i>
                            <p>No holidays added yet. Add a holiday using the form above.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Holiday Settings -->
                <div class="mt-8">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Default Holiday Settings</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Regular Holiday Multiplier</label>
                            <select id="default-regular-multiplier" class="input-field">
                                <option value="2.0" selected>2.0x (Double Pay)</option>
                                <option value="2.6">2.6x (Double + 30%)</option>
                                <option value="3.0">3.0x (Triple Pay)</option>
                            </select>
                            <div class="mt-2 flex items-center">
                                <input type="checkbox" id="default-regular-paid" class="h-4 w-4 text-blue-600 rounded border-gray-300" checked>
                                <label for="default-regular-paid" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Paid even if not working</label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Special Holiday Multiplier</label>
                            <select id="default-special-multiplier" class="input-field">
                                <option value="1.3" selected>1.3x (130%)</option>
                                <option value="1.5">1.5x (150%)</option>
                                <option value="2.0">2.0x (Double Pay)</option>
                            </select>
                            <div class="mt-2 flex items-center">
                                <input type="checkbox" id="default-special-paid" class="h-4 w-4 text-blue-600 rounded border-gray-300">
                                <label for="default-special-paid" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Paid even if not working</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="px-6 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-300 dark:hover:bg-gray-600 close-modal">
                    Cancel
                </button>
                <button id="save-holiday-settings" class="px-6 py-2.5 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-medium transition-colors">
                    Save Holiday Settings
                </button>
            </div>
        </div>
    </div>

    <!-- Approval Confirmation Modal -->
    <div id="approval-modal" class="modal">
        <div class="modal-content max-w-md">
            <div class="p-6">
                <div class="flex items-center justify-center w-12 h-12 mx-auto bg-green-100 dark:bg-green-900 rounded-full mb-4">
                    <i class="fas fa-check text-green-600 dark:text-green-300 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white text-center mb-2">Submit for Approval?</h3>
                <p class="text-gray-600 dark:text-gray-400 text-center mb-6" id="approval-message">
                    You are about to submit the payroll for HR Manager approval. This action cannot be undone.
                </p>
                
                <div class="bg-blue-50 dark:bg-blue-900 rounded-lg p-4 mb-6" id="approval-summary">
                    <!-- Summary will be populated dynamically -->
                </div>
                
                <div class="flex justify-center space-x-4">
                    <button class="px-6 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-300 dark:hover:bg-gray-600 close-modal">
                        Cancel
                    </button>
                    <button id="confirm-approval" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">
                        Confirm Submission
                    </button>
                </div>
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
            
            // Initialize modals
            initializeModals();
            
            // Initialize event listeners
            initializeEventListeners();
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
                if (mobileOverlay) mobileOverlay.classList.remove('active');
                sidebar.classList.remove('active');
                document.body.style.overflow = '';
                
                // Apply collapsed state if needed
                mainContent.style.marginLeft = sidebar.classList.contains('collapsed') ? '80px' : '260px';
                adjustLoadingOverlay();
            }
        });

        // Initialize modals
        function initializeModals() {
            // Modal functionality
            const configurePayrollBtn = document.getElementById('configure-payroll-btn');
            const manageHolidaysBtn = document.getElementById('manage-holidays-btn');
            const configureModal = document.getElementById('configure-payroll-modal');
            const holidaysModal = document.getElementById('manage-holidays-modal');
            const approvalModal = document.getElementById('approval-modal');
            const closeModalBtns = document.querySelectorAll('.close-modal');
            const saveSettingsBtn = document.getElementById('save-payroll-settings');
            const saveHolidaySettingsBtn = document.getElementById('save-holiday-settings');
            const addHolidayBtn = document.getElementById('add-holiday-btn');
            
            // Open configure modal
            if (configurePayrollBtn) {
                configurePayrollBtn.addEventListener('click', () => {
                    if (configureModal) configureModal.classList.add('active');
                });
            }
            
            // Open holidays modal
            if (manageHolidaysBtn) {
                manageHolidaysBtn.addEventListener('click', () => {
                    if (holidaysModal) holidaysModal.classList.add('active');
                });
            }
            
            // Close modal function
            function closeAllModals() {
                if (configureModal) configureModal.classList.remove('active');
                if (holidaysModal) holidaysModal.classList.remove('active');
                if (approvalModal) approvalModal.classList.remove('active');
            }
            
            // Close modals on close button click
            closeModalBtns.forEach(btn => {
                btn.addEventListener('click', closeAllModals);
            });
            
            // Close modals on outside click
            window.addEventListener('click', (e) => {
                if (e.target === configureModal || e.target === holidaysModal || e.target === approvalModal) {
                    closeAllModals();
                }
            });
            
            // Save payroll settings
            if (saveSettingsBtn) {
                saveSettingsBtn.addEventListener('click', () => {
                    // Here you would typically send data to backend via AJAX
                    alert('Payroll settings saved successfully!');
                    closeAllModals();
                });
            }
            
            // Save holiday settings
            if (saveHolidaySettingsBtn) {
                saveHolidaySettingsBtn.addEventListener('click', () => {
                    // Here you would typically send data to backend via AJAX
                    alert('Holiday settings saved successfully!');
                    closeAllModals();
                });
            }
            
            // Add holiday button
            if (addHolidayBtn) {
                addHolidayBtn.addEventListener('click', addHoliday);
            }
            
            // Submission type toggle
            const submissionTypeRadios = document.querySelectorAll('input[name="submission_type"]');
            const fullPayrollForm = document.getElementById('full-payroll-form');
            const correctionForm = document.getElementById('correction-form');
            const submissionInfo = document.getElementById('submission-info');
            
            if (submissionTypeRadios.length > 0) {
                submissionTypeRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.value === 'full') {
                            fullPayrollForm.style.display = 'block';
                            correctionForm.style.display = 'none';
                            submissionInfo.textContent = 'Submitting full payroll';
                        } else {
                            fullPayrollForm.style.display = 'none';
                            correctionForm.style.display = 'block';
                            submissionInfo.textContent = 'Submitting manual correction';
                        }
                    });
                });
            }
            
            // Submit for approval button
            const submitForApprovalBtn = document.getElementById('submit-for-approval');
            const submitApprovalBtn = document.getElementById('submit-approval-btn');
            
            if (submitForApprovalBtn) {
                submitForApprovalBtn.addEventListener('click', () => {
                    if (approvalModal) approvalModal.classList.add('active');
                });
            }
            
            if (submitApprovalBtn) {
                submitApprovalBtn.addEventListener('click', () => {
                    if (approvalModal) approvalModal.classList.add('active');
                });
            }
            
            // Confirm approval
            const confirmApprovalBtn = document.getElementById('confirm-approval');
            if (confirmApprovalBtn) {
                confirmApprovalBtn.addEventListener('click', () => {
                    // Here you would typically submit the form via AJAX
                    alert('Payroll submitted successfully for HR Manager approval!');
                    closeAllModals();
                    
                    // Redirect to payroll page after submission
                    setTimeout(() => {
                        window.location.href = "{{ route('hrm.staff.payroll') }}";
                    }, 1500);
                });
            }
            
            // View rates summary
            const viewRatesSummary = document.getElementById('view-rates-summary');
            if (viewRatesSummary) {
                viewRatesSummary.addEventListener('click', () => {
                    if (configureModal) configureModal.classList.add('active');
                });
            }
            
            // View holidays summary
            const viewHolidaysSummary = document.getElementById('view-holidays-summary');
            if (viewHolidaysSummary) {
                viewHolidaysSummary.addEventListener('click', () => {
                    if (holidaysModal) holidaysModal.classList.add('active');
                });
            }
        }
        
        // Add holiday function
        function addHoliday() {
            const name = document.getElementById('holiday-name').value.trim();
            const date = document.getElementById('holiday-date').value;
            const type = document.getElementById('holiday-type').value;
            const multiplier = document.getElementById('holiday-multiplier').value;
            const paidIfNotWorking = document.getElementById('paid-if-not-working').checked;
            
            if (!name) {
                alert('Please enter a holiday name');
                return;
            }
            
            if (!date) {
                alert('Please select a date');
                return;
            }
            
            // Here you would typically send data to backend via AJAX
            // For now, just show a success message
            alert(`Holiday "${name}" added successfully!`);
            
            // Clear form
            document.getElementById('holiday-name').value = '';
            document.getElementById('holiday-date').value = '';
            document.getElementById('holiday-type').value = 'regular';
            document.getElementById('holiday-multiplier').value = '2.0';
            document.getElementById('paid-if-not-working').checked = true;
        }
        
        // Initialize event listeners
        function initializeEventListeners() {
            // Recalculate all button
            const recalculateAllBtn = document.getElementById('recalculate-all');
            if (recalculateAllBtn) {
                recalculateAllBtn.addEventListener('click', () => {
                    alert('Recalculating all payroll data...');
                    // Here you would typically call backend to recalculate
                });
            }
            
            // Role tab functionality
            const roleTabs = document.querySelectorAll('.role-tab');
            roleTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    roleTabs.forEach(t => {
                        t.classList.remove('active', 'bg-blue-theme', 'text-white');
                        t.classList.add('bg-gray-200', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
                    });
                    
                    tab.classList.remove('bg-gray-200', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
                    tab.classList.add('active', 'bg-blue-theme', 'text-white');
                    
                    const role = tab.dataset.role;
                    // Here you would typically filter employees by role
                    console.log(`Filtering by role: ${role}`);
                });
            });
            
            // Select All Checkbox
            const selectAllCheckbox = document.getElementById('select-all');
            const selectAllHeader = document.getElementById('select-all-header');
            const employeeCheckboxes = document.querySelectorAll('.employee-checkbox');
            
            if (selectAllCheckbox && selectAllHeader) {
                function updateSelectAll() {
                    const allChecked = Array.from(employeeCheckboxes).every(cb => cb.checked);
                    selectAllCheckbox.checked = allChecked;
                    selectAllHeader.checked = allChecked;
                }
                
                selectAllCheckbox.addEventListener('change', () => {
                    employeeCheckboxes.forEach(checkbox => {
                        checkbox.checked = selectAllCheckbox.checked;
                    });
                    selectAllHeader.checked = selectAllCheckbox.checked;
                });
                
                selectAllHeader.addEventListener('change', () => {
                    employeeCheckboxes.forEach(checkbox => {
                        checkbox.checked = selectAllHeader.checked;
                    });
                    selectAllCheckbox.checked = selectAllHeader.checked;
                });
                
                employeeCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', updateSelectAll);
                });
            }
            
            // Bulk Action
            const bulkActionSelect = document.getElementById('bulk-action');
            const applyBulkActionBtn = document.getElementById('apply-bulk-action');
            
            if (bulkActionSelect && applyBulkActionBtn) {
                applyBulkActionBtn.addEventListener('click', () => {
                    const action = bulkActionSelect.value;
                    if (!action) {
                        alert('Please select a bulk action first');
                        return;
                    }
                    
                    const selectedEmployees = Array.from(employeeCheckboxes).filter(cb => cb.checked);
                    if (selectedEmployees.length === 0) {
                        alert('Please select at least one employee');
                        return;
                    }
                    
                    // Apply bulk action logic
                    switch(action) {
                        case 'apply-bonus':
                            alert(`Applying 13th month bonus to ${selectedEmployees.length} employees`);
                            break;
                        case 'increase-5':
                            alert(`Increasing salary by 5% for ${selectedEmployees.length} employees`);
                            break;
                        case 'apply-overtime':
                            alert(`Applying overtime to ${selectedEmployees.length} employees`);
                            break;
                        case 'reset':
                            alert(`Resetting ${selectedEmployees.length} employees to default rates`);
                            break;
                    }
                    
                    bulkActionSelect.value = '';
                });
            }
            
            // Save draft button
            const saveDraftBtn = document.getElementById('save-draft-btn');
            if (saveDraftBtn) {
                saveDraftBtn.addEventListener('click', () => {
                    alert('Payroll saved as draft successfully!');
                });
            }
            
            // Search employee button
            const searchEmployeeBtn = document.getElementById('search-employee-btn');
            if (searchEmployeeBtn) {
                searchEmployeeBtn.addEventListener('click', () => {
                    const employeeId = document.getElementById('correction-employee-id').value;
                    const employeeName = document.getElementById('correction-employee-name').value;
                    
                    if (!employeeId && !employeeName) {
                        alert('Please enter either Employee ID or Employee Name');
                        return;
                    }
                    
                    // Here you would typically search for employee via AJAX
                    alert(`Searching for employee: ${employeeId || employeeName}`);
                });
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>