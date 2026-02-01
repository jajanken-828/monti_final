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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
        
        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .badge-under-review {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .badge-interview {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .badge-interview-passed {
            background-color: #10b981;
            color: white;
        }
        
        .badge-interview-failed {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .badge-accepted {
            background-color: #10b981;
            color: white;
        }
        
        .badge-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .dark .badge-pending {
            background-color: #78350f;
            color: #fcd34d;
        }
        
        .dark .badge-under-review {
            background-color: #1e3a8a;
            color: #93c5fd;
        }
        
        .dark .badge-interview {
            background-color: #064e3b;
            color: #a7f3d0;
        }
        
        .dark .badge-interview-passed {
            background-color: #047857;
            color: white;
        }
        
        .dark .badge-interview-failed {
            background-color: #7f1d1d;
            color: #fca5a5;
        }
        
        .dark .badge-accepted {
            background-color: #047857;
            color: white;
        }
        
        .dark .badge-rejected {
            background-color: #7f1d1d;
            color: #fca5a5;
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
        
        /* File upload styles */
        .file-upload-area {
            border: 2px dashed #cbd5e1;
            border-radius: 0.75rem;
            padding: 2rem;
            text-align: center;
            transition: all 0.2s ease;
            background: #f8fafc;
        }
        
        .file-upload-area:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }
        
        .file-upload-area.dragover {
            border-color: #10b981;
            background: #ecfdf5;
        }
        
        .file-upload-area .file-input {
            display: none;
        }
        
        .file-upload-area .file-label {
            cursor: pointer;
            color: #3b82f6;
            font-weight: 500;
        }
        
        .file-preview {
            margin-top: 1rem;
        }
        
        .file-preview-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.75rem;
            margin-bottom: 0.5rem;
        }
        
        .file-preview-item .file-name {
            flex: 1;
            margin-right: 1rem;
            font-size: 0.875rem;
        }
        
        /* Action dropdown - REMOVED */
        
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
        
        /* Status colors */
        .status-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 6px;
        }
        
        .status-dot-pending { background-color: #f59e0b; }
        .status-dot-under-review { background-color: #3b82f6; }
        .status-dot-interview { background-color: #10b981; }
        .status-dot-interview-passed { background-color: #059669; }
        .status-dot-interview-failed { background-color: #ef4444; }
        .status-dot-accepted { background-color: #059669; }
        .status-dot-rejected { background-color: #ef4444; }
        
        /* Calendar Styles */
        .flatpickr-calendar {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .flatpickr-day.selected {
            background: #2563eb;
            border-color: #2563eb;
        }

        .flatpickr-day.today {
            border-color: #fbbf24;
        }

        .flatpickr-day:hover {
            background: #eff6ff;
            border-color: #dbeafe;
        }

        /* Modal Calendar Container */
        #interview-calendar {
            width: 100%;
            min-height: 300px;
        }

        /* Time Select Styles */
        #interview-time {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Selected Date Display */
        #selected-date {
            background-color: #f8fafc;
            font-weight: 500;
            color: #1e293b;
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
            
            /* Make buttons stack on mobile */
            .data-table td:last-child .flex {
                flex-direction: column;
                gap: 8px;
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
            
            /* Adjust modal widths on mobile */
            .modal-content {
                width: 95%;
                max-width: 95%;
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
                    <button id="encode-applicant-btn" class="btn btn-primary">
                        <i class="fas fa-plus mr-2"></i> Encode New Applicant
                    </button>
                    
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
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalApplications ?? 0 }}</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center content-fade-in stagger-delay-2">
                    <div class="w-12 h-12 rounded-xl bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center mr-4">
                        <i class="fas fa-clock text-yellow-600 dark:text-yellow-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Pending Review</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pendingReview ?? 0 }}</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center content-fade-in stagger-delay-3">
                    <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900 flex items-center justify-center mr-4">
                        <i class="fas fa-calendar-check text-green-600 dark:text-green-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Scheduled Interviews</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $scheduledInterviews ?? 0 }}</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center content-fade-in stagger-delay-4">
                    <div class="w-12 h-12 rounded-xl bg-red-100 dark:bg-red-900 flex items-center justify-center mr-4">
                        <i class="fas fa-times-circle text-red-600 dark:text-red-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Rejected</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $rejected ?? 0 }}</div>
                    </div>
                </div>
            </div>

            <!-- Additional Interview Status Summary -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="card p-6 flex items-center content-fade-in stagger-delay-1">
                    <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900 flex items-center justify-center mr-4">
                        <i class="fas fa-check-circle text-green-600 dark:text-green-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Interview Passed</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $interviewPassed ?? 0 }}</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center content-fade-in stagger-delay-2">
                    <div class="w-12 h-12 rounded-xl bg-red-100 dark:bg-red-900 flex items-center justify-center mr-4">
                        <i class="fas fa-times-circle text-red-600 dark:text-red-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Interview Failed</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $interviewFailed ?? 0 }}</div>
                    </div>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="card p-6 mb-8 content-fade-in stagger-delay-1">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" id="search-applicants" class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600" placeholder="Search applicants...">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <select id="filter-status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="under_review">Under Review</option>
                            <option value="interview_scheduled">Interview Scheduled</option>
                            <option value="interview_passed">Interview Passed</option>
                            <option value="interview_failed">Interview Failed</option>
                            <option value="accepted">Accepted</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        <select id="filter-position" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600">
                            <option value="">All Positions</option>
                            <option value="production_supervisor">Production Supervisor</option>
                            <option value="quality_inspector">Quality Control Inspector</option>
                            <option value="maintenance_tech">Maintenance Technician</option>
                            <option value="hr_assistant">HR Assistant</option>
                            <option value="warehouse_staff">Warehouse Staff</option>
                            <option value="textile_designer">Textile Designer</option>
                            <option value="machine_operator">Machine Operator</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Applications Table -->
            <div class="card overflow-hidden mb-8 content-fade-in stagger-delay-1">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Active Applicants</h2>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Showing only applicants with status: Pending or Under Review</p>
                    </div>
                    <div class="text-sm text-gray-500">
                        @php
                            // Filter applicants to only show pending or under_review
                            $filteredApplicants = $applicants->filter(function($applicant) {
                                return in_array($applicant->status, ['pending', 'under_review']);
                            });
                            $filteredCount = $filteredApplicants->count();
                            $totalFiltered = $filteredCount;
                        @endphp
                        Showing {{ $filteredCount }} entries
                    </div>
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
                        <tbody id="applicants-table-body">
                            @php
                                // Filter the applicants collection
                                $filteredApplicants = collect();
                                foreach ($applicants as $applicant) {
                                    if (in_array($applicant->status, ['pending', 'under_review'])) {
                                        $filteredApplicants->push($applicant);
                                    }
                                }
                            @endphp
                            
                            @forelse($filteredApplicants as $applicant)
                                <tr data-id="{{ $applicant->id }}">
                                    <td>
                                        <div class="font-medium text-gray-900 dark:text-white">{{ $applicant->full_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $applicant->email }}</div>
                                    </td>
                                    <td>
                                        <div class="font-medium">{{ ucwords(str_replace('_', ' ', $applicant->position_applied)) }}</div>
                                        <div class="text-sm text-gray-500">Start: {{ $applicant->available_start_date->format('M d, Y') }}</div>
                                    </td>
                                    <td>
                                        <div class="font-medium">{{ $applicant->created_at->format('M d, Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $applicant->created_at->diffForHumans() }}</div>
                                    </td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'pending' => 'badge-pending',
                                                'under_review' => 'badge-under-review',
                                                'interview_scheduled' => 'badge-interview',
                                                'interview_passed' => 'badge-interview-passed',
                                                'interview_failed' => 'badge-interview-failed',
                                                'accepted' => 'badge-accepted',
                                                'rejected' => 'badge-rejected'
                                            ];
                                        @endphp
                                        <span class="badge {{ $statusClasses[$applicant->status] ?? 'badge-pending' }}">
                                            <span class="status-dot status-dot-{{ str_replace('_', '-', $applicant->status) }}"></span>
                                            {{ ucwords(str_replace('_', ' ', $applicant->status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-gray-900 dark:text-white">{{ $applicant->phone_number }}</div>
                                        <div class="text-sm text-gray-500">{{ $applicant->city }}, {{ $applicant->state_province }}</div>
                                    </td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <!-- View Button -->
                                            <button class="btn btn-sm btn-primary view-applicant" data-id="{{ $applicant->id }}" title="View Details">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                            
                                            <!-- Schedule Button -->
                                            <button class="btn btn-sm btn-success schedule-interview-btn" data-id="{{ $applicant->id }}" data-name="{{ $applicant->full_name }}" title="Schedule Interview">
                                                <i class="fas fa-calendar-alt"></i>  Schedule
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-8 text-gray-500">
                                    <i class="fas fa-inbox text-4xl mb-4 text-gray-300"></i>
                                    <p class="text-lg">No active applicants found</p>
                                    <p class="text-sm mt-2">No applicants with status: Pending or Under Review</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($applicants->hasPages())
                <div class="p-6 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <div class="text-gray-500 dark:text-gray-400 text-sm">
                        Showing {{ $applicants->firstItem() }} to {{ $applicants->lastItem() }} of {{ $applicants->total() }} entries
                        <br>
                        <small>Filtered: {{ $filteredCount }} applicants (Pending or Under Review)</small>
                    </div>
                    <div class="flex space-x-2">
                        @if($applicants->onFirstPage())
                            <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-400 cursor-not-allowed" disabled>
                                Previous
                            </button>
                        @else
                            <a href="{{ $applicants->previousPageUrl() }}" class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                Previous
                            </a>
                        @endif

                        @foreach($applicants->links()->elements[0] as $page => $url)
                            @if($page == $applicants->currentPage())
                                <span class="px-3 py-1 bg-blue-600 text-white rounded-lg">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        @if($applicants->hasMorePages())
                            <a href="{{ $applicants->nextPageUrl() }}" class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                Next
                            </a>
                        @else
                            <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-400 cursor-not-allowed" disabled>
                                Next
                            </button>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Application Status Chart -->
            <div class="card p-6 content-fade-in stagger-delay-2">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Application Status Overview</h2>
                <div class="flex items-center justify-center h-64">
                    <canvas id="statusChart"></canvas>
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
                    <button class="text-gray-500 hover:text-red-500 transition-colors duration-200" id="close-modal">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-6">
                <form id="applicant-form" enctype="multipart/form-data">
                    @csrf
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
                                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                                    <input type="text" name="first_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="First Name" required>
                                    <div class="text-red-500 text-sm mt-1 error-message" id="error-first_name"></div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                                    <input type="text" name="middle_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Middle Name">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                                    <input type="text" name="last_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Last Name" required>
                                    <div class="text-red-500 text-sm mt-1 error-message" id="error-last_name"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Birth Date Section -->
                        <div class="form-group bg-white p-5 rounded-xl border border-gray-200">
                            <div class="flex items-center mb-4">
                                <div class="h-8 w-8 bg-yellow-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar text-white text-sm"></i>
                                </div>
                                <h4 class="text-lg font-bold text-gray-800">Birth Date *</h4>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Month *</label>
                                    <select name="birth_month" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                                        <option value="">Select Month</option>
                                        @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                        @endfor
                                    </select>
                                    <div class="text-red-500 text-sm mt-1 error-message" id="error-birth_month"></div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Day *</label>
                                    <select name="birth_day" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                                        <option value="">Select Day</option>
                                        @for($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <div class="text-red-500 text-sm mt-1 error-message" id="error-birth_day"></div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Year *</label>
                                    <select name="birth_year" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                                        <option value="">Select Year</option>
                                        @for($i = date('Y'); $i >= 1960; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    <div class="text-red-500 text-sm mt-1 error-message" id="error-birth_year"></div>
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
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Street Address *</label>
                                    <input type="text" name="street_address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Street Address" required>
                                    <div class="text-red-500 text-sm mt-1 error-message" id="error-street_address"></div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Street Address Line 2</label>
                                    <input type="text" name="street_address_line2" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Apartment, Suite, Unit, etc.">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                                        <input type="text" name="city" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="City" required>
                                        <div class="text-red-500 text-sm mt-1 error-message" id="error-city"></div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">State / Province *</label>
                                        <input type="text" name="state_province" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="State / Province" required>
                                        <div class="text-red-500 text-sm mt-1 error-message" id="error-state_province"></div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Postal / Zip Code *</label>
                                        <input type="text" name="postal_zip_code" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="Postal / Zip Code" required>
                                        <div class="text-red-500 text-sm mt-1 error-message" id="error-postal_zip_code"></div>
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
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                    <input type="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="myname@example.com" required>
                                    <div class="text-red-500 text-sm mt-1 error-message" id="error-email"></div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                                    <input type="tel" name="phone_number" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="000 800-0600" required>
                                    <div class="text-red-500 text-sm mt-1 error-message" id="error-phone_number"></div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn Profile (Optional)</label>
                                <input type="url" name="linkedin_profile" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="https://linkedin.com/in/username">
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
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Position Applied For *</label>
                                    <select name="position_applied" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                                        <option value="">Please Select</option>
                                        <option value="production_supervisor">Production Supervisor</option>
                                        <option value="quality_inspector">Quality Control Inspector</option>
                                        <option value="maintenance_tech">Maintenance Technician</option>
                                        <option value="hr_assistant">HR Assistant</option>
                                        <option value="warehouse_staff">Warehouse Staff</option>
                                        <option value="textile_designer">Textile Designer</option>
                                        <option value="machine_operator">Machine Operator</option>
                                    </select>
                                    <div class="text-red-500 text-sm mt-1 error-message" id="error-position_applied"></div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">How did you hear about us? *</label>
                                    <select name="referral_source" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                                        <option value="">Please Select</option>
                                        <option value="linkedin">LinkedIn</option>
                                        <option value="job_portal">Job Portal</option>
                                        <option value="referral">Employee Referral</option>
                                        <option value="social_media">Social Media</option>
                                        <option value="company_website">Company Website</option>
                                        <option value="career_fair">Career Fair</option>
                                    </select>
                                    <div class="text-red-500 text-sm mt-1 error-message" id="error-referral_source"></div>
                                </div>
                            </div>
                            <div class="mt-5">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Available Start Date *</label>
                                <input type="date" name="available_start_date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                                <div class="text-red-500 text-sm mt-1 error-message" id="error-available_start_date"></div>
                            </div>
                        </div>

                        <!-- Government Documents Section -->
                        <div class="form-group bg-white p-5 rounded-xl border border-gray-200">
                            <div class="flex items-center mb-4">
                                <div class="h-8 w-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-file-alt text-white text-sm"></i>
                                </div>
                                <h4 class="text-lg font-bold text-gray-800">Government Documents</h4>
                            </div>
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">SSS ID/Number</label>
                                    <div class="file-upload-area" id="sss-upload-area">
                                        <input type="file" name="sss_file" class="file-input" id="sss-file" accept=".pdf,.jpg,.jpeg,.png">
                                        <label for="sss-file" class="file-label">
                                            <i class="fas fa-cloud-upload-alt text-2xl text-blue-400 mb-2"></i>
                                            <p class="text-gray-600 mb-2">Upload SSS ID or Number Document</p>
                                            <button type="button" class="bg-white border border-blue-500 text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                                <i class="fas fa-folder-open mr-2"></i> Choose File
                                            </button>
                                            <p class="text-gray-400 text-xs mt-2">PDF, JPG, PNG up to 5MB</p>
                                        </label>
                                        <div class="file-preview" id="sss-preview"></div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">PhilHealth ID/Number</label>
                                    <div class="file-upload-area" id="philhealth-upload-area">
                                        <input type="file" name="philhealth_file" class="file-input" id="philhealth-file" accept=".pdf,.jpg,.jpeg,.png">
                                        <label for="philhealth-file" class="file-label">
                                            <i class="fas fa-cloud-upload-alt text-2xl text-blue-400 mb-2"></i>
                                            <p class="text-gray-600 mb-2">Upload PhilHealth ID or Number Document</p>
                                            <button type="button" class="bg-white border border-blue-500 text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                                <i class="fas fa-folder-open mr-2"></i> Choose File
                                            </button>
                                            <p class="text-gray-400 text-xs mt-2">PDF, JPG, PNG up to 5MB</p>
                                        </label>
                                        <div class="file-preview" id="philhealth-preview"></div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Pag-IBIG ID/Number</label>
                                    <div class="file-upload-area" id="pagibig-upload-area">
                                        <input type="file" name="pagibig_file" class="file-input" id="pagibig-file" accept=".pdf,.jpg,.jpeg,.png">
                                        <label for="pagibig-file" class="file-label">
                                            <i class="fas fa-cloud-upload-alt text-2xl text-blue-400 mb-2"></i>
                                            <p class="text-gray-600 mb-2">Upload Pag-IBIG ID or Number Document</p>
                                            <button type="button" class="bg-white border border-blue-500 text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                                <i class="fas fa-folder-open mr-2"></i> Choose File
                                            </button>
                                            <p class="text-gray-400 text-xs mt-2">PDF, JPG, PNG up to 5MB</p>
                                        </label>
                                        <div class="file-preview" id="pagibig-preview"></div>
                                    </div>
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
                                    <input type="text" name="expected_salary" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" placeholder="e.g., ₱25,000 - ₱30,000">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Notice Period (if currently employed)</label>
                                    <select name="notice_period" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
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
                                            <input type="radio" name="textile_experience" value="yes" class="text-blue-600 focus:ring-blue-500">
                                            <span class="ml-2">Yes</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="textile_experience" value="no" class="text-blue-600 focus:ring-blue-500" checked>
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
                                <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-8 py-3 rounded-lg font-medium shadow-md hover:shadow-lg transition-all duration-200" id="submit-form">
                                    <i class="fas fa-save mr-2"></i> Save Applicant
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Applicant Details Modal -->
    <div class="modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 hidden" id="view-applicant-modal">
        <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="modal-header monti-header bg-gradient-to-r from-white to-blue-50 p-6 rounded-t-xl border-b border-blue-100">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-user text-blue-600 text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800" id="applicant-name"></h2>
                            <h3 class="text-lg font-semibold text-blue-700">Applicant Details</h3>
                        </div>
                    </div>
                    <button class="text-gray-500 hover:text-red-500 transition-colors duration-200 close-view-modal">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body p-6">
                <div class="space-y-6" id="applicant-details">
                    <!-- Details will be loaded via JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Schedule Interview Modal -->
    <div class="modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 hidden" id="schedule-interview-modal">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="modal-header monti-header bg-gradient-to-r from-white to-green-50 p-6 rounded-t-xl border-b border-green-100">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="h-10 w-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-green-600 text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Schedule Interview</h2>
                        <h3 class="text-lg font-semibold text-green-700" id="interview-applicant-name"></h3>
                    </div>
                </div>
                <button class="text-gray-500 hover:text-red-500 transition-colors duration-200 close-schedule-modal">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>

        <div class="modal-body p-6">
            <form id="schedule-interview-form">
                @csrf
                <input type="hidden" id="schedule-applicant-id" name="applicant_id">

                <div class="space-y-6">
                    <!-- Calendar Section -->
                    <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                        <div class="flex items-center mb-4">
                            <div class="h-8 w-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-calendar text-white text-sm"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-800">Select Date & Time</h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Calendar -->
                            <div class="flex items-start justify-center">
                                <div id="interview-calendar" class="mb-4"></div>
                            </div>

                            <!-- Right inputs -->
                            <div class="flex flex-col justify-start">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Selected Date
                                    </label>
                                    <input
                                        type="text"
                                        id="selected-date"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                        readonly
                                    >
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Time Slot
                                    </label>
                                    <select
                                        id="interview-time"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    >
                                        <option value="">Select Time</option>
                                        <option value="09:00">09:00 AM</option>
                                        <option value="10:00" selected>10:00 AM</option>
                                        <option value="11:00">11:00 AM</option>
                                        <option value="13:00">01:00 PM</option>
                                        <option value="14:00">02:00 PM</option>
                                        <option value="15:00">03:00 PM</option>
                                        <option value="16:00">04:00 PM</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Duration
                                    </label>
                                    <select
                                        name="duration"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    >
                                        <option value="30">30 minutes</option>
                                        <option value="45">45 minutes</option>
                                        <option value="60" selected>60 minutes</option>
                                        <option value="90">90 minutes</option>
                                        <option value="120">120 minutes</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="interview_date" id="interview-date-time">
                    </div>

                    <!-- Interview Details -->
                    <div class="bg-white p-5 rounded-xl border border-gray-200">
                        <div class="flex items-center mb-4">
                            <div class="h-8 w-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-info-circle text-white text-sm"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-800">Interview Details</h4>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Interview Type *
                                </label>
                                <select
                                    name="interview_type"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    required
                                >
                                    <option value="">Select Type</option>
                                    <option value="phone">Phone Interview</option>
                                    <option value="video">Video Interview</option>
                                    <option value="in_person" selected>In-Person Interview</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Location
                                </label>
                                <input
                                    type="text"
                                    name="location"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Meeting Room, Office Address"
                                >
                            </div>
                        </div>

                        <div class="mt-5">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Additional Notes
                            </label>
                            <textarea
                                name="notes"
                                rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Any special instructions or notes..."
                            ></textarea>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                        <button type="button" class="btn btn-outline close-schedule-modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-calendar-check mr-2"></i> Schedule Interview
                        </button>
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/default.js"></script>
    <script>
        // Content loading functionality
        const contentLoadingOverlay = document.getElementById('content-loading-overlay');
        const loadingProgressFill = document.getElementById('loading-progress-fill');
        const mainContent = document.getElementById('main-content');
        const sidebar = document.getElementById('sidebar');
        
        // Adjust loading overlay position when sidebar collapses/expands
        function adjustLoadingOverlay() {
            if (window.innerWidth >= 1024) {
                if (sidebar && sidebar.classList.contains('collapsed')) {
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
                
                // Initialize chart
                initStatusChart();
                
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

        // Initialize date picker for available start date
        flatpickr("input[name='available_start_date']", {
            minDate: "today",
            dateFormat: "Y-m-d",
        });

        // File upload functionality
        function setupFileUpload(inputId, previewId, areaId) {
            const fileInput = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            const uploadArea = document.getElementById(areaId);

            fileInput.addEventListener('change', function(e) {
                preview.innerHTML = '';
                const files = Array.from(e.target.files);
                
                files.forEach(file => {
                    if (file.size > 5 * 1024 * 1024) {
                        Swal.fire({
                            icon: 'error',
                            title: 'File too large',
                            text: 'File must be less than 5MB'
                        });
                        return;
                    }

                    const fileItem = document.createElement('div');
                    fileItem.className = 'file-preview-item';
                    fileItem.innerHTML = `
                        <div class="file-name">
                            <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                            ${file.name} (${(file.size / 1024).toFixed(2)} KB)
                        </div>
                        <button type="button" class="text-red-500 hover:text-red-700 remove-file">
                            <i class="fas fa-times"></i>
                        </button>
                    `;

                    fileItem.querySelector('.remove-file').addEventListener('click', () => {
                        fileInput.value = '';
                        preview.innerHTML = '';
                    });

                    preview.appendChild(fileItem);
                });
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

            uploadArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change'));
            }
        }

        // Setup file uploads
        setupFileUpload('sss-file', 'sss-preview', 'sss-upload-area');
        setupFileUpload('philhealth-file', 'philhealth-preview', 'philhealth-upload-area');
        setupFileUpload('pagibig-file', 'pagibig-preview', 'pagibig-upload-area');

        // Modal functionality
        const encodeBtn = document.getElementById('encode-applicant-btn');
        const modal = document.getElementById('encode-applicant-modal');
        const closeModal = document.getElementById('close-modal');
        const cancelForm = document.getElementById('cancel-form');
        const applicantForm = document.getElementById('applicant-form');
        const submitBtn = document.getElementById('submit-form');
        
        encodeBtn.addEventListener('click', () => {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
        
        closeModal.addEventListener('click', () => {
            modal.classList.remove('active');
            document.body.style.overflow = '';
            clearFormErrors();
        });
        
        cancelForm.addEventListener('click', () => {
            modal.classList.remove('active');
            document.body.style.overflow = '';
            clearFormErrors();
        });
        
        // Close modal when clicking outside
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('active');
                document.body.style.overflow = '';
                clearFormErrors();
            }
        });

        // Form submission - FIXED: Added proper FormData handling
        applicantForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Saving...';

            const formData = new FormData(applicantForm);

            try {
                const response = await fetch('{{ route("hrm.staff.application.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });

                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                    applicantForm.reset();
                    
                    // Clear file previews
                    ['sss-preview', 'philhealth-preview', 'pagibig-preview'].forEach(id => {
                        document.getElementById(id).innerHTML = '';
                    });

                    // Reload page after 1 second
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    clearFormErrors();
                    // Display validation errors
                    if (data.errors) {
                        Object.keys(data.errors).forEach(field => {
                            const errorElement = document.getElementById(`error-${field}`);
                            if (errorElement) {
                                errorElement.textContent = data.errors[field][0];
                            }
                        });
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.'
                });
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-save mr-2"></i> Save Applicant';
            }
        });

        function clearFormErrors() {
            document.querySelectorAll('.error-message').forEach(el => {
                el.textContent = '';
            });
        }

        // View Applicant Details
        document.querySelectorAll('.view-applicant').forEach(btn => {
            btn.addEventListener('click', async function(e) {
                e.preventDefault();
                const applicantId = this.getAttribute('data-id');
                
                try {
                    const response = await fetch('{{ route("hrm.staff.application.show", ["id" => "__id__"]) }}'.replace('__id__', applicantId));
                    const applicant = await response.json();
                    
                    // Format the date
                    const formatDate = (dateString) => {
                        if (!dateString) return 'N/A';
                        const date = new Date(dateString);
                        return date.toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                    };
                    
                    // Populate modal
                    document.getElementById('applicant-name').textContent = applicant.full_name;
                    
                    const detailsHtml = `
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 p-5 rounded-xl">
                                <h4 class="font-bold text-gray-800 mb-3 text-lg border-b pb-2">Personal Information</h4>
                                <div class="space-y-3">
                                    <div>
                                        <span class="text-gray-600 text-sm">Full Name:</span>
                                        <p class="font-medium">${applicant.full_name}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Birth Date:</span>
                                        <p class="font-medium">${formatDate(applicant.birth_date)}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Email:</span>
                                        <p class="font-medium">${applicant.email}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Phone:</span>
                                        <p class="font-medium">${applicant.phone_number}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">LinkedIn:</span>
                                        <p class="font-medium">${applicant.linkedin_profile || 'N/A'}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-5 rounded-xl">
                                <h4 class="font-bold text-gray-800 mb-3 text-lg border-b pb-2">Address</h4>
                                <div class="space-y-3">
                                    <div>
                                        <span class="text-gray-600 text-sm">Street Address:</span>
                                        <p class="font-medium">${applicant.street_address}</p>
                                    </div>
                                    ${applicant.street_address_line2 ? `
                                    <div>
                                        <span class="text-gray-600 text-sm">Address Line 2:</span>
                                        <p class="font-medium">${applicant.street_address_line2}</p>
                                    </div>
                                    ` : ''}
                                    <div>
                                        <span class="text-gray-600 text-sm">City:</span>
                                        <p class="font-medium">${applicant.city}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">State/Province:</span>
                                        <p class="font-medium">${applicant.state_province}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Postal Code:</span>
                                        <p class="font-medium">${applicant.postal_zip_code}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-5 rounded-xl">
                                <h4 class="font-bold text-gray-800 mb-3 text-lg border-b pb-2">Application Details</h4>
                                <div class="space-y-3">
                                    <div>
                                        <span class="text-gray-600 text-sm">Position Applied:</span>
                                        <p class="font-medium">${applicant.position_applied.replace(/_/g, ' ').toUpperCase()}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Referral Source:</span>
                                        <p class="font-medium">${applicant.referral_source.replace(/_/g, ' ').toUpperCase()}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Available Start Date:</span>
                                        <p class="font-medium">${formatDate(applicant.available_start_date)}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Expected Salary:</span>
                                        <p class="font-medium">${applicant.expected_salary || 'Not specified'}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Notice Period:</span>
                                        <p class="font-medium">${applicant.notice_period ? applicant.notice_period.replace(/_/g, ' ') : 'Immediate'}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-5 rounded-xl">
                                <h4 class="font-bold text-gray-800 mb-3 text-lg border-b pb-2">Status & Documents</h4>
                                <div class="space-y-3">
                                    <div>
                                        <span class="text-gray-600 text-sm">Application Status:</span>
                                        <span class="badge badge-${applicant.status}">
                                            ${applicant.status.replace(/_/g, ' ').toUpperCase()}
                                        </span>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Textile Experience:</span>
                                        <p class="font-medium">${applicant.textile_experience ? 'Yes' : 'No'}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Date Applied:</span>
                                        <p class="font-medium">${formatDate(applicant.created_at)}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Government Documents:</span>
                                        <p class="font-medium">${applicant.sss_file_path || applicant.philhealth_file_path || applicant.pagibig_file_path ? 'Uploaded' : 'Not uploaded'}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        ${applicant.notes ? `
                        <div class="bg-yellow-50 p-5 rounded-xl mt-6">
                            <h4 class="font-bold text-gray-800 mb-3 text-lg border-b pb-2">Notes</h4>
                            <p class="text-gray-700">${applicant.notes}</p>
                        </div>
                        ` : ''}
                    `;
                    
                    document.getElementById('applicant-details').innerHTML = detailsHtml;
                    document.getElementById('view-applicant-modal').classList.add('active');
                    document.body.style.overflow = 'hidden';
                    
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load applicant details.'
                    });
                }
            });
        });

        // Initialize Calendar for Schedule Modal
        let interviewCalendar = null;
        let selectedDate = null;

        function initializeInterviewCalendar() {
            const calendarEl = document.getElementById('interview-calendar');
            if (!calendarEl) return;
            
            // Destroy existing calendar if exists
            if (interviewCalendar) {
                interviewCalendar.destroy();
            }
            
            const today = new Date();
            const nextWeek = new Date(today);
            nextWeek.setDate(today.getDate() + 14);
            
            interviewCalendar = flatpickr(calendarEl, {
                inline: true,
                mode: "single",
                minDate: "today",
                maxDate: nextWeek,
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length > 0) {
                        selectedDate = selectedDates[0];
                        const formattedDate = selectedDate.toLocaleDateString('en-US', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        document.getElementById('selected-date').value = formattedDate;
                        updateInterviewDateTime();
                    }
                },
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                        longhand: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
                    },
                    months: {
                        shorthand: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        longhand: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
                    }
                }
            });
            
            // Set initial date to tomorrow
            const tomorrow = new Date(today);
            tomorrow.setDate(today.getDate() + 1);
            interviewCalendar.setDate(tomorrow, false);
            selectedDate = tomorrow;
            
            const formattedDate = tomorrow.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            document.getElementById('selected-date').value = formattedDate;
            updateInterviewDateTime();
        }

        // Schedule Interview Modal
        document.querySelectorAll('.schedule-interview-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const applicantId = this.getAttribute('data-id');
                const applicantName = this.getAttribute('data-name');
                
                document.getElementById('schedule-applicant-id').value = applicantId;
                document.getElementById('interview-applicant-name').textContent = applicantName;
                
                // Initialize or reinitialize calendar
                initializeInterviewCalendar();
                
                document.getElementById('schedule-interview-modal').classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        // Update interview date and time when changed
        function updateInterviewDateTime() {
            if (!selectedDate) return;
            
            const timeSelect = document.getElementById('interview-time');
            const selectedTime = timeSelect.value;
            
            if (!selectedTime) {
                document.getElementById('interview-date-time').value = '';
                return;
            }
            
            const dateStr = selectedDate.toISOString().split('T')[0];
            const dateTimeStr = `${dateStr} ${selectedTime}:00`;
            document.getElementById('interview-date-time').value = dateTimeStr;
        }

        // Listen for time changes
        document.getElementById('interview-time').addEventListener('change', updateInterviewDateTime);

        // Schedule Interview Form Submission
        document.getElementById('schedule-interview-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const applicantId = document.getElementById('schedule-applicant-id').value;
            const interviewDateTime = document.getElementById('interview-date-time').value;
            
            if (!interviewDateTime) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Please select a date and time for the interview.'
                });
                return;
            }
            
            const formData = new FormData(this);
            
            try {
                const response = await fetch('{{ route("hrm.staff.application.schedule-interview", ["id" => "__id__"]) }}'.replace('__id__', applicantId), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(Object.fromEntries(formData))
                });
                
                const data = await response.json();
                
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                    
                    document.getElementById('schedule-interview-modal').classList.remove('active');
                    document.body.style.overflow = '';
                    
                    // Reload page after 1 second
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    if (data.errors) {
                        let errorMessage = '';
                        Object.values(data.errors).forEach(errors => {
                            errorMessage += errors[0] + '\n';
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessage
                        });
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.'
                });
            }
        });

        // Close Modals
        document.querySelectorAll('.close-view-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('view-applicant-modal').classList.remove('active');
                document.body.style.overflow = '';
            });
        });

        document.querySelectorAll('.close-schedule-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('schedule-interview-modal').classList.remove('active');
                document.body.style.overflow = '';
            });
        });

        // Close modals when clicking outside
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });

        // Search functionality
        const searchInput = document.getElementById('search-applicants');
        const filterStatus = document.getElementById('filter-status');
        const filterPosition = document.getElementById('filter-position');

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusFilter = filterStatus.value;
            const positionFilter = filterPosition.value;

            document.querySelectorAll('#applicants-table-body tr').forEach(row => {
                const name = row.cells[0].textContent.toLowerCase();
                const email = row.cells[0].querySelector('.text-sm').textContent.toLowerCase();
                const position = row.cells[1].textContent.toLowerCase();
                const statusBadge = row.cells[3].querySelector('.badge');
                let status = '';
                
                if (statusBadge) {
                    status = statusBadge.textContent.trim().toLowerCase().replace(' ', '_');
                }

                const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm) || position.includes(searchTerm);
                const matchesStatus = !statusFilter || status === statusFilter;
                const matchesPosition = !positionFilter || position.includes(positionFilter);

                row.style.display = matchesSearch && matchesStatus && matchesPosition ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterTable);
        filterStatus.addEventListener('change', filterTable);
        filterPosition.addEventListener('change', filterTable);

        // Initialize status chart
        function initStatusChart() {
            const ctx = document.getElementById('statusChart');
            if (!ctx) return;

            const statusData = {
                pending: {{ $pendingReview ?? 0 }},
                under_review: {{ $applicants->where('status', 'under_review')->count() }},
                interview_scheduled: {{ $scheduledInterviews ?? 0 }},
                interview_passed: {{ $interviewPassed ?? 0 }},
                interview_failed: {{ $interviewFailed ?? 0 }},
                accepted: {{ $applicants->where('status', 'accepted')->count() }},
                rejected: {{ $rejected ?? 0 }}
            };

            const chart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Under Review', 'Interview Scheduled', 'Interview Passed', 'Interview Failed', 'Accepted', 'Rejected'],
                    datasets: [{
                        data: [
                            statusData.pending,
                            statusData.under_review,
                            statusData.interview_scheduled,
                            statusData.interview_passed,
                            statusData.interview_failed,
                            statusData.accepted,
                            statusData.rejected
                        ],
                        backgroundColor: [
                            '#f59e0b',
                            '#3b82f6',
                            '#10b981',
                            '#059669',
                            '#dc2626',
                            '#8b5cf6',
                            '#ef4444'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Navigation
        document.querySelectorAll('.sidebar-item').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.getAttribute('href') && !this.getAttribute('href').startsWith('#')) {
                    e.preventDefault();
                    contentLoadingOverlay.style.display = 'flex';
                    contentLoadingOverlay.classList.remove('hidden');
                    mainContent.classList.add('hidden');
                    setTimeout(() => {
                        window.location.href = this.getAttribute('href');
                    }, 300);
                }
            });
        });

        // Set today's date as default for available start date
        const today = new Date().toISOString().split('T')[0];
        const startDateInput = document.querySelector('input[name="available_start_date"]');
        if (startDateInput) {
            startDateInput.value = today;
        }

        // Initialize calendar when page loads
        document.addEventListener('DOMContentLoaded', () => {
            // Load flatpickr locale and styles for calendar
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css';
            document.head.appendChild(link);
        });

    </script>
</body>
</html>