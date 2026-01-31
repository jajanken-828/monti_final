<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Interview Schedule - Monti Textile HRM</title>

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
        .bg-green-theme { background-color: #10b981; }
        .bg-purple-theme { background-color: #8b5cf6; }
        .text-blue-theme { color: #2563eb; }
        .text-yellow-theme { color: #fbbf24; }
        .text-green-theme { color: #10b981; }
        .text-purple-theme { color: #8b5cf6; }
        .border-blue-theme { border-color: #2563eb; }
        .border-yellow-theme { border-color: #fbbf24; }
        .border-green-theme { border-color: #10b981; }
        .border-purple-theme { border-color: #8b5cf6; }
        .hover\:bg-blue-theme:hover { background-color: #1d4ed8; }
        .hover\:bg-yellow-theme:hover { background-color: #f59e0b; }
        .hover\:bg-green-theme:hover { background-color: #059669; }
        .hover\:bg-purple-theme:hover { background-color: #7c3aed; }
        .dark .bg-blue-theme { background-color: #1e40af; }
        .dark .bg-yellow-theme { background-color: #d97706; }
        .dark .bg-green-theme { background-color: #047857; }
        .dark .bg-purple-theme { background-color: #6d28d9; }
        .dark .text-blue-theme { color: #60a5fa; }
        .dark .text-yellow-theme { color: #fbbf24; }
        .dark .text-green-theme { color: #34d399; }
        .dark .text-purple-theme { color: #a78bfa; }
        
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
        
        .badge-scheduled {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .badge-completed {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .badge-rescheduled {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .badge-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .badge-today {
            background-color: #f0f9ff;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }
        
        .badge-upcoming {
            background-color: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        
        .badge-overdue {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        
        .dark .badge-scheduled {
            background-color: #1e3a8a;
            color: #93c5fd;
        }
        
        .dark .badge-completed {
            background-color: #064e3b;
            color: #a7f3d0;
        }
        
        .dark .badge-rescheduled {
            background-color: #78350f;
            color: #fcd34d;
        }
        
        .dark .badge-cancelled {
            background-color: #7f1d1d;
            color: #fca5a5;
        }
        
        .dark .badge-today {
            background-color: #0c4a6e;
            color: #7dd3fc;
            border-color: #0ea5e9;
        }
        
        .dark .badge-upcoming {
            background-color: #052e16;
            color: #86efac;
            border-color: #22c55e;
        }
        
        .dark .badge-overdue {
            background-color: #450a0a;
            color: #fca5a5;
            border-color: #dc2626;
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
        
        /* Interview Timeline */
        .interview-timeline {
            position: relative;
            padding-left: 30px;
        }
        
        .interview-timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #e5e7eb;
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 25px;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -25px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #3b82f6;
            border: 2px solid white;
            box-shadow: 0 0 0 3px #3b82f6;
        }
        
        .timeline-item.completed::before {
            background-color: #10b981;
            box-shadow: 0 0 0 3px #10b981;
        }
        
        .timeline-item.cancelled::before {
            background-color: #ef4444;
            box-shadow: 0 0 0 3px #ef4444;
        }
        
        .timeline-item.rescheduled::before {
            background-color: #f59e0b;
            box-shadow: 0 0 0 3px #f59e0b;
        }
        
        /* Calendar Widget */
        .calendar-widget {
            background: white;
            border-radius: 1rem;
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }
        
        .calendar-header {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 1rem;
            text-align: center;
        }
        
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
            padding: 1rem;
        }
        
        .calendar-day {
            text-align: center;
            padding: 8px 4px;
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .calendar-date {
            text-align: center;
            padding: 8px;
            font-size: 0.875rem;
            cursor: pointer;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }
        
        .calendar-date:hover {
            background-color: #f3f4f6;
        }
        
        .calendar-date.today {
            background-color: #3b82f6;
            color: white;
        }
        
        .calendar-date.has-interview {
            background-color: #dbeafe;
            color: #1e40af;
            font-weight: 600;
        }
        
        .calendar-date.has-interview.today {
            background-color: #2563eb;
            color: white;
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
        
        .status-dot-scheduled { background-color: #3b82f6; }
        .status-dot-completed { background-color: #10b981; }
        .status-dot-rescheduled { background-color: #f59e0b; }
        .status-dot-cancelled { background-color: #ef4444; }
        
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
        
        /* Interview Specific Styles */
        .interview-card {
            border-left: 4px solid #3b82f6;
            transition: all 0.3s ease;
        }
        
        .interview-card:hover {
            transform: translateX(5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .interview-card.today {
            border-left-color: #10b981;
        }
        
        .interview-card.upcoming {
            border-left-color: #f59e0b;
        }
        
        .interview-card.overdue {
            border-left-color: #ef4444;
        }
        
        .interview-time {
            font-family: monospace;
            background: #f8fafc;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 600;
            color: #1e293b;
        }
        
        .interview-type-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .interview-type-in_person {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .interview-type-video {
            background-color: #f0f9ff;
            color: #0369a1;
        }
        
        .interview-type-phone {
            background-color: #f0fdf4;
            color: #166534;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }
        
        .empty-state-icon {
            font-size: 4rem;
            color: #d1d5db;
            margin-bottom: 1rem;
        }
        
        .empty-state-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        
        .empty-state-description {
            color: #6b7280;
            max-width: 400px;
            margin: 0 auto;
        }
        
        .dark .empty-state-icon {
            color: #4b5563;
        }
        
        .dark .empty-state-title {
            color: #f9fafb;
        }
        
        .dark .empty-state-description {
            color: #9ca3af;
        }

        /* Rating Stars */
        .rating-stars {
            display: flex;
            gap: 5px;
            margin: 10px 0;
        }
        
        .rating-star {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .rating-star:hover,
        .rating-star.active {
            color: #fbbf24;
        }
        
        /* Pass/Fail Buttons */
        .result-buttons {
            display: flex;
            gap: 10px;
            margin: 15px 0;
        }
        
        .result-btn {
            flex: 1;
            padding: 12px;
            border: 2px solid transparent;
            border-radius: 8px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .result-pass {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .result-pass:hover,
        .result-pass.active {
            background-color: #10b981;
            color: white;
            border-color: #059669;
        }
        
        .result-fail {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .result-fail:hover,
        .result-fail.active {
            background-color: #ef4444;
            color: white;
            border-color: #dc2626;
        }
        
        /* Interview Now Button */
        .btn-interview-now {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            font-weight: 600;
        }
        
        .btn-interview-now:hover {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
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
            <p>Loading interview schedule...</p>
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
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white header-title">Interview Schedule</h1>
                    <p class="text-gray-500 dark:text-gray-400 hidden md:block">Manage and view all scheduled interviews</p>
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
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 stats-grid">
                <div class="card p-6 flex items-center content-fade-in stagger-delay-1">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-4">
                        <i class="fas fa-calendar-alt text-blue-600 dark:text-blue-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Total Scheduled</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalScheduled ?? 0 }}</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center content-fade-in stagger-delay-2">
                    <div class="w-12 h-12 rounded-xl bg-green-100 dark:bg-green-900 flex items-center justify-center mr-4">
                        <i class="fas fa-calendar-day text-green-600 dark:text-green-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Today's Interviews</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $todayInterviews ?? 0 }}</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center content-fade-in stagger-delay-3">
                    <div class="w-12 h-12 rounded-xl bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center mr-4">
                        <i class="fas fa-calendar-week text-yellow-600 dark:text-yellow-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">This Week</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $thisWeekInterviews ?? 0 }}</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center content-fade-in stagger-delay-4">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900 flex items-center justify-center mr-4">
                        <i class="fas fa-user-clock text-purple-600 dark:text-purple-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Pending Feedback</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pendingFeedback ?? 0 }}</div>
                    </div>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="card p-6 mb-8 content-fade-in stagger-delay-1">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" id="search-interviews" class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600" placeholder="Search interviews...">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <select id="filter-status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600">
                            <option value="">All Status</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="rescheduled">Rescheduled</option>
                        </select>
                        <select id="filter-type" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600">
                            <option value="">All Types</option>
                            <option value="in_person">In-Person</option>
                            <option value="video">Video Call</option>
                            <option value="phone">Phone Call</option>
                        </select>
                        <input type="date" id="filter-date" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600">
                    </div>
                </div>
            </div>

            <!-- Tabs for Interview Views -->
            <div class="mb-8">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="-mb-px flex space-x-8">
                        <button class="nav-tab active" data-tab="all">All Interviews</button>
                        <button class="nav-tab" data-tab="today">Today</button>
                        <button class="nav-tab" data-tab="upcoming">Upcoming</button>
                    </nav>
                </div>
            </div>

            <!-- Interview Schedule Table -->
            <div class="card overflow-hidden mb-8 content-fade-in stagger-delay-1">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Interview Schedule</h2>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">All scheduled interviews with applicants</p>
                    </div>
                    <div class="text-sm text-gray-500">
                        Showing {{ $interviews->firstItem() ?? 0 }} to {{ $interviews->lastItem() ?? 0 }} of {{ $interviews->total() ?? 0 }} entries
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Applicant</th>
                                <th>Interview Date & Time</th>
                                <th>Type</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Location/Platform</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="interviews-table-body">
                            @forelse($interviews as $interview)
                            <tr data-id="{{ $interview->id }}" data-status="{{ $interview->status }}" data-date="{{ $interview->scheduled_date->format('Y-m-d') }}" data-type="{{ $interview->interview_type }}">
                                <td>
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-3">
                                            <i class="fas fa-user text-blue-600 dark:text-blue-300"></i>
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white">{{ $interview->applicant->full_name ?? 'N/A' }}</div>
                                            <div class="text-sm text-gray-500">{{ $interview->applicant->email ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="font-medium">{{ $interview->scheduled_date->format('M d, Y') }}</div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ $interview->scheduled_date->format('h:i A') }}
                                        @if($interview->duration)
                                            ({{ $interview->duration }} mins)
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $typeBadgeClasses = [
                                            'in_person' => 'interview-type-in_person',
                                            'video' => 'interview-type-video',
                                            'phone' => 'interview-type-phone'
                                        ];
                                        $typeLabels = [
                                            'in_person' => 'In-Person',
                                            'video' => 'Video Call',
                                            'phone' => 'Phone Call'
                                        ];
                                    @endphp
                                    <span class="interview-type-badge {{ $typeBadgeClasses[$interview->interview_type] ?? 'interview-type-in_person' }}">
                                        {{ $typeLabels[$interview->interview_type] ?? $interview->interview_type }}
                                    </span>
                                </td>
                                <td>
                                    <div class="font-medium">{{ ucwords(str_replace('_', ' ', $interview->applicant->position_applied ?? 'N/A')) }}</div>
                                </td>
                                <td>
                                    @php
                                        $statusClasses = [
                                            'scheduled' => 'badge-scheduled',
                                            'completed' => 'badge-completed',
                                            'rescheduled' => 'badge-rescheduled',
                                            'cancelled' => 'badge-cancelled'
                                        ];
                                    @endphp
                                    <span class="badge {{ $statusClasses[$interview->status] ?? 'badge-scheduled' }}">
                                        <span class="status-dot status-dot-{{ $interview->status }}"></span>
                                        {{ ucwords($interview->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="text-gray-900 dark:text-white">{{ $interview->location ?? 'Not specified' }}</div>
                                    @if($interview->interview_type == 'video' && $interview->location)
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-video mr-1"></i> {{ $interview->location }}
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex space-x-2">
                                        <!-- View Button -->
                                        <button class="btn btn-sm btn-primary view-interview" data-id="{{ $interview->id }}" title="View Details">
                                            <i class="fas fa-eye"></i> View
                                        </button>
                                        
                                        <!-- Interview Now Button (for scheduled/rescheduled interviews) -->
                                        @if(in_array($interview->status, ['scheduled', 'rescheduled']))
                                        <button class="btn btn-sm btn-interview-now interview-now-btn" data-id="{{ $interview->id }}" title="Start Interview Now">
                                            <i class="fas fa-video"></i> Interview Now
                                        </button>
                                        @endif
                                        
                                        <!-- Reschedule Button -->
                                        <button class="btn btn-sm btn-success reschedule-btn" data-id="{{ $interview->id }}" data-applicant-id="{{ $interview->applicant_id }}" data-name="{{ $interview->applicant->full_name ?? 'Applicant' }}" title="Reschedule">
                                            <i class="fas fa-calendar-alt"></i> Reschedule
                                        </button>
                                        
                                        <!-- Cancel Button -->
                                        @if($interview->status == 'scheduled')
                                        <button class="btn btn-sm btn-danger cancel-interview" data-id="{{ $interview->id }}" title="Cancel Interview">
                                            <i class="fas fa-times"></i> Cancel
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-8">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-calendar-times"></i>
                                        </div>
                                        <h3 class="empty-state-title">No interviews scheduled</h3>
                                        <p class="empty-state-description">
                                            There are no interviews scheduled at the moment. Schedule interviews from the Application Management page.
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($interviews->hasPages())
                <div class="p-6 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <div class="text-gray-500 dark:text-gray-400 text-sm">
                        Showing {{ $interviews->firstItem() }} to {{ $interviews->lastItem() }} of {{ $interviews->total() }} entries
                    </div>
                    <div class="flex space-x-2">
                        @if($interviews->onFirstPage())
                            <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-400 cursor-not-allowed" disabled>
                                Previous
                            </button>
                        @else
                            <a href="{{ $interviews->previousPageUrl() }}" class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                Previous
                            </a>
                        @endif

                        @foreach($interviews->links()->elements[0] as $page => $url)
                            @if($page == $interviews->currentPage())
                                <span class="px-3 py-1 bg-blue-600 text-white rounded-lg">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        @if($interviews->hasMorePages())
                            <a href="{{ $interviews->nextPageUrl() }}" class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
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

            <!-- Today's Interviews Widget -->
            @if($todayInterviewsList && count($todayInterviewsList) > 0)
            <div class="card p-6 mb-8 content-fade-in stagger-delay-2">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Today's Interviews</h2>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Interviews scheduled for {{ \Carbon\Carbon::today()->format('F j, Y') }}</p>
                    </div>
                    <span class="badge badge-today">
                        <i class="fas fa-calendar-day mr-1"></i> {{ count($todayInterviewsList) }} Interviews
                    </span>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($todayInterviewsList as $todayInterview)
                    <div class="interview-card bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700 today">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white">{{ $todayInterview->applicant->full_name ?? 'N/A' }}</h3>
                                <p class="text-sm text-gray-500">{{ $todayInterview->applicant->position_applied ? ucwords(str_replace('_', ' ', $todayInterview->applicant->position_applied)) : 'N/A' }}</p>
                            </div>
                            <span class="interview-time">{{ $todayInterview->scheduled_date->format('h:i A') }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <span class="interview-type-badge {{ $typeBadgeClasses[$todayInterview->interview_type] ?? 'interview-type-in_person' }}">
                                {{ $typeLabels[$todayInterview->interview_type] ?? $todayInterview->interview_type }}
                            </span>
                            <span class="badge {{ $statusClasses[$todayInterview->status] ?? 'badge-scheduled' }}">
                                {{ ucwords($todayInterview->status) }}
                            </span>
                        </div>
                        
                        <div class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ $todayInterview->location ?? 'Location not specified' }}
                        </div>
                        
                        <div class="flex space-x-2">
                            <button class="btn btn-sm btn-primary flex-1 view-interview" data-id="{{ $todayInterview->id }}">
                                <i class="fas fa-eye mr-1"></i> View
                            </button>
                            <button class="btn btn-sm btn-interview-now flex-1 interview-now-btn" data-id="{{ $todayInterview->id }}">
                                <i class="fas fa-video mr-1"></i> Interview Now
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Upcoming Interviews Timeline -->
            <div class="card p-6 content-fade-in stagger-delay-3">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Upcoming Interviews This Week</h2>
                
                @if($upcomingInterviewsList && count($upcomingInterviewsList) > 0)
                <div class="interview-timeline">
                    @foreach($upcomingInterviewsList as $upcomingInterview)
                    @php
                        $isToday = $upcomingInterview->scheduled_date->isToday();
                        $isTomorrow = $upcomingInterview->scheduled_date->isTomorrow();
                        $dayClass = $isToday ? 'today' : ($isTomorrow ? 'tomorrow' : '');
                        $dayLabel = $isToday ? 'Today' : ($isTomorrow ? 'Tomorrow' : $upcomingInterview->scheduled_date->format('l'));
                    @endphp
                    
                    <div class="timeline-item {{ $upcomingInterview->status }}">
                        <div class="bg-white dark:bg-gray-800 p-5 rounded-xl border border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <div class="flex items-center">
                                        <h3 class="font-bold text-gray-900 dark:text-white mr-3">{{ $upcomingInterview->applicant->full_name ?? 'N/A' }}</h3>
                                        <span class="badge badge-upcoming">
                                            <i class="fas fa-calendar mr-1"></i> {{ $dayLabel }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-500">{{ $upcomingInterview->applicant->position_applied ? ucwords(str_replace('_', ' ', $upcomingInterview->applicant->position_applied)) : 'N/A' }}</p>
                                </div>
                                <div class="text-right">
                                    <div class="font-medium text-gray-900 dark:text-white">{{ $upcomingInterview->scheduled_date->format('h:i A') }}</div>
                                    <span class="badge {{ $statusClasses[$upcomingInterview->status] ?? 'badge-scheduled' }}">
                                        {{ ucwords($upcomingInterview->status) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="flex items-center justify-between mb-4">
                                <span class="interview-type-badge {{ $typeBadgeClasses[$upcomingInterview->interview_type] ?? 'interview-type-in_person' }}">
                                    {{ $typeLabels[$upcomingInterview->interview_type] ?? $upcomingInterview->interview_type }}
                                </span>
                                <div class="text-sm text-gray-600 dark:text-gray-300">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    {{ $upcomingInterview->location ?? 'Location not specified' }}
                                </div>
                            </div>
                            
                            @if($upcomingInterview->notes)
                            <div class="text-sm text-gray-600 dark:text-gray-300 mb-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <i class="fas fa-sticky-note mr-2"></i>
                                {{ Str::limit($upcomingInterview->notes, 100) }}
                            </div>
                            @endif
                            
                            <div class="flex space-x-2">
                                <button class="btn btn-sm btn-primary flex-1 view-interview" data-id="{{ $upcomingInterview->id }}">
                                    <i class="fas fa-eye mr-1"></i> View Details
                                </button>
                                @if(in_array($upcomingInterview->status, ['scheduled', 'rescheduled']))
                                <button class="btn btn-sm btn-interview-now flex-1 interview-now-btn" data-id="{{ $upcomingInterview->id }}">
                                    <i class="fas fa-video mr-1"></i> Interview Now
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <h3 class="empty-state-title">No upcoming interviews</h3>
                    <p class="empty-state-description">
                        There are no interviews scheduled for the upcoming week.
                    </p>
                </div>
                @endif
            </div>
        </main>
    </div>

    <!-- View Interview Details Modal -->
    <div class="modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 hidden" id="view-interview-modal">
        <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="modal-header monti-header bg-gradient-to-r from-white to-blue-50 p-6 rounded-t-xl border-b border-blue-100">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-blue-600 text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800" id="interview-applicant-name"></h2>
                            <h3 class="text-lg font-semibold text-blue-700">Interview Details</h3>
                        </div>
                    </div>
                    <button class="text-gray-500 hover:text-red-500 transition-colors duration-200 close-view-modal">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body p-6">
                <div class="space-y-6" id="interview-details">
                    <!-- Details will be loaded via JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <!-- Complete Interview Modal -->
    <div class="modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 hidden" id="complete-interview-modal">
        <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-md">
            <div class="modal-header p-6 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-800">Complete Interview</h3>
                <button class="text-gray-500 hover:text-red-500" id="close-complete-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-6">
                <form id="complete-interview-form">
                    @csrf
                    <input type="hidden" id="complete-interview-id" name="interview_id">
                    <input type="hidden" id="complete-applicant-id" name="applicant_id">
                    
                    <div class="form-group mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Feedback</label>
                        <textarea name="feedback" id="feedback" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter feedback from the interview..."></textarea>
                    </div>
                    
                    <div class="form-group mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Result *</label>
                        <div class="result-buttons">
                            <button type="button" class="result-btn result-pass" data-result="pass">
                                <i class="fas fa-check mr-2"></i> Pass
                            </button>
                            <button type="button" class="result-btn result-fail" data-result="fail">
                                <i class="fas fa-times mr-2"></i> Fail
                            </button>
                        </div>
                        <input type="hidden" name="rating" id="rating-value" required>
                    </div>
                    
                    <div class="form-group mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Additional Notes</label>
                        <textarea name="notes" id="notes" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Any additional notes..."></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-4">
                        <button type="button" class="btn btn-outline" id="cancel-complete">Cancel</button>
                        <button type="submit" class="btn btn-primary">Complete Interview</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reschedule Interview Modal -->
    <div class="modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 z-50 hidden" id="reschedule-modal">
        <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="modal-header monti-header bg-gradient-to-r from-white to-green-50 p-6 rounded-t-xl border-b border-green-100">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="h-10 w-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-green-600 text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">Reschedule Interview</h2>
                            <h3 class="text-lg font-semibold text-green-700" id="reschedule-applicant-name"></h3>
                        </div>
                    </div>
                    <button class="text-gray-500 hover:text-red-500 transition-colors duration-200 close-reschedule-modal">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <div class="modal-body p-6">
                <form id="reschedule-form">
                    @csrf
                    <input type="hidden" id="reschedule-interview-id" name="interview_id">
                    <input type="hidden" id="reschedule-applicant-id" name="applicant_id">

                    <div class="space-y-6">
                        <!-- Calendar Section -->
                        <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                            <div class="flex items-center mb-4">
                                <div class="h-8 w-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar text-white text-sm"></i>
                                </div>
                                <h4 class="text-lg font-bold text-gray-800">Select New Date & Time</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Calendar -->
                                <div class="flex items-start justify-center">
                                    <div id="reschedule-calendar" class="mb-4"></div>
                                </div>

                                <!-- Right inputs -->
                                <div class="flex flex-col justify-start">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Selected Date
                                        </label>
                                        <input
                                            type="text"
                                            id="reschedule-selected-date"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50"
                                            readonly
                                        >
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Time Slot
                                        </label>
                                        <select
                                            id="reschedule-time"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        >
                                            <option value="">Select Time</option>
                                            <option value="09:00">09:00 AM</option>
                                            <option value="10:00">10:00 AM</option>
                                            <option value="11:00">11:00 AM</option>
                                            <option value="13:00">01:00 PM</option>
                                            <option value="14:00">02:00 PM</option>
                                            <option value="15:00">03:00 PM</option>
                                            <option value="16:00">04:00 PM</option>
                                            <option value="17:00">05:00 PM</option>
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

                            <input type="hidden" name="scheduled_date" id="reschedule-date-time">
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
                                        Location/Platform
                                    </label>
                                    <input
                                        type="text"
                                        name="location"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Meeting Room, Video Call Link"
                                    >
                                </div>
                            </div>

                            <div class="mt-5">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Reason for Rescheduling
                                </label>
                                <textarea
                                    name="reschedule_reason"
                                    rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Why are you rescheduling this interview?"
                                    required
                                ></textarea>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                            <button type="button" class="btn btn-outline close-reschedule-modal">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-calendar-check mr-2"></i> Reschedule Interview
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

        // Tab Navigation
        document.querySelectorAll('.nav-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                document.querySelectorAll('.nav-tab').forEach(t => {
                    t.classList.remove('active');
                });
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                const tabType = this.getAttribute('data-tab');
                filterTableByTab(tabType);
            });
        });

        // Filter table by tab
        function filterTableByTab(tabType) {
            const today = new Date().toISOString().split('T')[0];
            const rows = document.querySelectorAll('#interviews-table-body tr');
            
            rows.forEach(row => {
                const status = row.getAttribute('data-status');
                const date = row.getAttribute('data-date');
                
                let show = true;
                
                switch(tabType) {
                    case 'today':
                        // Show only scheduled/rescheduled interviews for today
                        show = date === today && (status === 'scheduled' || status === 'rescheduled');
                        break;
                    case 'upcoming':
                        // Show only scheduled/rescheduled interviews for upcoming dates
                        show = date > today && (status === 'scheduled' || status === 'rescheduled');
                        break;
                    case 'all':
                    default:
                        // Show all scheduled/rescheduled interviews
                        show = status === 'scheduled' || status === 'rescheduled';
                        break;
                }
                
                row.style.display = show ? '' : 'none';
            });
        }

        // Search and Filter functionality
        const searchInput = document.getElementById('search-interviews');
        const filterStatus = document.getElementById('filter-status');
        const filterType = document.getElementById('filter-type');
        const filterDate = document.getElementById('filter-date');

        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusFilter = filterStatus.value;
            const typeFilter = filterType.value;
            const dateFilter = filterDate.value;

            document.querySelectorAll('#interviews-table-body tr').forEach(row => {
                const applicantName = row.cells[0].querySelector('.font-medium').textContent.toLowerCase();
                const position = row.cells[3].querySelector('.font-medium').textContent.toLowerCase();
                const status = row.getAttribute('data-status');
                const type = row.getAttribute('data-type');
                const date = row.getAttribute('data-date');

                const matchesSearch = applicantName.includes(searchTerm) || position.includes(searchTerm);
                const matchesStatus = !statusFilter || status === statusFilter;
                const matchesType = !typeFilter || type === typeFilter;
                const matchesDate = !dateFilter || date === dateFilter;

                row.style.display = matchesSearch && matchesStatus && matchesType && matchesDate ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterTable);
        filterStatus.addEventListener('change', filterTable);
        filterType.addEventListener('change', filterTable);
        filterDate.addEventListener('change', filterTable);

        // View Interview Details
        document.querySelectorAll('.view-interview').forEach(btn => {
            btn.addEventListener('click', async function(e) {
                e.preventDefault();
                const interviewId = this.getAttribute('data-id');
                
                try {
                    const response = await fetch(`/hrm/staff/interviews/${interviewId}`);
                    const interview = await response.json();
                    
                    // Format the date
                    const formatDate = (dateString) => {
                        if (!dateString) return 'N/A';
                        const date = new Date(dateString);
                        return date.toLocaleDateString('en-US', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    };
                    
                    // Populate modal
                    document.getElementById('interview-applicant-name').textContent = interview.applicant?.full_name || 'N/A';
                    
                    const detailsHtml = `
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-gray-50 p-5 rounded-xl">
                                <h4 class="font-bold text-gray-800 mb-3 text-lg border-b pb-2">Interview Information</h4>
                                <div class="space-y-3">
                                    <div>
                                        <span class="text-gray-600 text-sm">Scheduled Date & Time:</span>
                                        <p class="font-medium">${formatDate(interview.scheduled_date)}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Interview Type:</span>
                                        <p class="font-medium">${interview.interview_type === 'in_person' ? 'In-Person' : (interview.interview_type === 'video' ? 'Video Call' : 'Phone Call')}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Duration:</span>
                                        <p class="font-medium">${interview.duration || 60} minutes</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Location/Platform:</span>
                                        <p class="font-medium">${interview.location || 'Not specified'}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Status:</span>
                                        <span class="badge ${interview.status === 'scheduled' ? 'badge-scheduled' : interview.status === 'completed' ? 'badge-completed' : interview.status === 'rescheduled' ? 'badge-rescheduled' : 'badge-cancelled'}">
                                            ${interview.status.charAt(0).toUpperCase() + interview.status.slice(1)}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-5 rounded-xl">
                                <h4 class="font-bold text-gray-800 mb-3 text-lg border-b pb-2">Applicant Information</h4>
                                <div class="space-y-3">
                                    <div>
                                        <span class="text-gray-600 text-sm">Applicant Name:</span>
                                        <p class="font-medium">${interview.applicant?.full_name || 'N/A'}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Position Applied:</span>
                                        <p class="font-medium">${interview.applicant?.position_applied ? interview.applicant.position_applied.replace(/_/g, ' ') : 'N/A'}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Email:</span>
                                        <p class="font-medium">${interview.applicant?.email || 'N/A'}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Phone:</span>
                                        <p class="font-medium">${interview.applicant?.phone_number || 'N/A'}</p>
                                    </div>
                                    <div>
                                        <span class="text-gray-600 text-sm">Application Status:</span>
                                        <span class="badge ${interview.applicant?.status === 'pending' ? 'badge-pending' : interview.applicant?.status === 'under_review' ? 'badge-under-review' : interview.applicant?.status === 'interview_scheduled' ? 'badge-interview' : interview.applicant?.status === 'accepted' ? 'badge-accepted' : interview.applicant?.status === 'rejected' ? 'badge-rejected' : interview.applicant?.status === 'interview_passed' ? 'badge-completed' : interview.applicant?.status === 'interview_failed' ? 'badge-cancelled' : 'badge-pending'}">
                                            ${interview.applicant?.status ? interview.applicant.status.replace(/_/g, ' ') : 'N/A'}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            ${interview.notes ? `
                            <div class="bg-yellow-50 p-5 rounded-xl md:col-span-2">
                                <h4 class="font-bold text-gray-800 mb-3 text-lg border-b pb-2">Interview Notes</h4>
                                <p class="text-gray-700">${interview.notes}</p>
                            </div>
                            ` : ''}
                            
                            ${interview.feedback || interview.rating ? `
                            <div class="bg-green-50 p-5 rounded-xl md:col-span-2">
                                <h4 class="font-bold text-gray-800 mb-3 text-lg border-b pb-2">Interview Feedback</h4>
                                ${interview.feedback ? `
                                <div class="mb-3">
                                    <span class="text-gray-600 text-sm">Feedback:</span>
                                    <p class="text-gray-700">${interview.feedback}</p>
                                </div>
                                ` : ''}
                                ${interview.rating ? `
                                <div>
                                    <span class="text-gray-600 text-sm">Result:</span>
                                    <div class="flex items-center mt-1">
                                        <span class="badge ${interview.rating === 'pass' ? 'badge-completed' : 'badge-cancelled'}">
                                            ${interview.rating === 'pass' ? 'Passed' : 'Failed'}
                                        </span>
                                    </div>
                                </div>
                                ` : ''}
                            </div>
                            ` : ''}
                        </div>
                    `;
                    
                    document.getElementById('interview-details').innerHTML = detailsHtml;
                    document.getElementById('view-interview-modal').classList.add('active');
                    document.body.style.overflow = 'hidden';
                    
                } catch (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load interview details.'
                    });
                }
            });
        });

        // Interview Now Button
        document.querySelectorAll('.interview-now-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const interviewId = this.getAttribute('data-id');
                
                Swal.fire({
                    title: 'Start Interview Now?',
                    text: "This will override the scheduled interview time and start the interview immediately.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#2563eb',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, start interview',
                    cancelButtonText: 'Cancel'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            const response = await fetch(`/hrm/staff/interviews/${interviewId}/start-now`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            });
                            
                            const data = await response.json();
                            
                            if (data.success) {
                                // Show complete interview modal after starting
                                document.getElementById('complete-interview-id').value = interviewId;
                                document.getElementById('complete-applicant-id').value = data.interview.applicant_id;
                                
                                // Reset form
                                document.getElementById('feedback').value = '';
                                document.getElementById('notes').value = '';
                                document.getElementById('rating-value').value = '';
                                
                                // Remove active classes from result buttons
                                document.querySelectorAll('.result-btn').forEach(btn => {
                                    btn.classList.remove('active');
                                });
                                
                                document.getElementById('complete-interview-modal').classList.add('active');
                                document.body.style.overflow = 'hidden';
                                
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Interview Started!',
                                    text: 'Interview has been started. Please complete the interview details.',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Failed to start interview.'
                                });
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong. Please try again.'
                            });
                        }
                    }
                });
            });
        });

        // Result buttons for complete interview
        document.querySelectorAll('.result-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.result-btn').forEach(b => {
                    b.classList.remove('active');
                });
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Set the rating value
                const result = this.getAttribute('data-result');
                document.getElementById('rating-value').value = result;
            });
        });

        // Complete Interview Form Submission
        document.getElementById('complete-interview-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const interviewId = document.getElementById('complete-interview-id').value;
            const rating = document.getElementById('rating-value').value;
            
            if (!rating) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Please select a result (Pass or Fail) for the interview.'
                });
                return;
            }
            
            const formData = new FormData(this);
            
            try {
                const response = await fetch(`/hrm/staff/interviews/${interviewId}/complete`, {
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
                    
                    document.getElementById('complete-interview-modal').classList.remove('active');
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

        // Initialize Calendar for Reschedule Modal
        let rescheduleCalendar = null;
        let rescheduleSelectedDate = null;

        function initializeRescheduleCalendar() {
            const calendarEl = document.getElementById('reschedule-calendar');
            if (!calendarEl) return;
            
            // Destroy existing calendar if exists
            if (rescheduleCalendar) {
                rescheduleCalendar.destroy();
            }
            
            const today = new Date();
            const nextMonth = new Date(today);
            nextMonth.setMonth(today.getMonth() + 1);
            
            rescheduleCalendar = flatpickr(calendarEl, {
                inline: true,
                mode: "single",
                minDate: "today",
                maxDate: nextMonth,
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length > 0) {
                        rescheduleSelectedDate = selectedDates[0];
                        const formattedDate = rescheduleSelectedDate.toLocaleDateString('en-US', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        document.getElementById('reschedule-selected-date').value = formattedDate;
                        updateRescheduleDateTime();
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
            rescheduleCalendar.setDate(tomorrow, false);
            rescheduleSelectedDate = tomorrow;
            
            const formattedDate = tomorrow.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            document.getElementById('reschedule-selected-date').value = formattedDate;
            updateRescheduleDateTime();
        }

        // Reschedule Interview
        document.querySelectorAll('.reschedule-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const interviewId = this.getAttribute('data-id');
                const applicantId = this.getAttribute('data-applicant-id');
                const applicantName = this.getAttribute('data-name');
                
                document.getElementById('reschedule-interview-id').value = interviewId;
                document.getElementById('reschedule-applicant-id').value = applicantId;
                document.getElementById('reschedule-applicant-name').textContent = applicantName;
                
                // Initialize or reinitialize calendar
                initializeRescheduleCalendar();
                
                document.getElementById('reschedule-modal').classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        // Update reschedule date and time when changed
        function updateRescheduleDateTime() {
            if (!rescheduleSelectedDate) return;
            
            const timeSelect = document.getElementById('reschedule-time');
            const selectedTime = timeSelect.value;
            
            if (!selectedTime) {
                document.getElementById('reschedule-date-time').value = '';
                return;
            }
            
            // Fix date issue: Create date string in YYYY-MM-DD HH:MM:SS format
            const year = rescheduleSelectedDate.getFullYear();
            const month = String(rescheduleSelectedDate.getMonth() + 1).padStart(2, '0');
            const day = String(rescheduleSelectedDate.getDate()).padStart(2, '0');
            const dateTimeStr = `${year}-${month}-${day} ${selectedTime}:00`;
            
            document.getElementById('reschedule-date-time').value = dateTimeStr;
        }

        // Listen for time changes in reschedule modal
        document.getElementById('reschedule-time').addEventListener('change', updateRescheduleDateTime);

        // Reschedule Form Submission
        document.getElementById('reschedule-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const interviewId = document.getElementById('reschedule-interview-id').value;
            const dateTime = document.getElementById('reschedule-date-time').value;
            
            if (!dateTime) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Please select a date and time for the interview.'
                });
                return;
            }
            
            const formData = new FormData(this);
            
            try {
                const response = await fetch(`/hrm/staff/interviews/${interviewId}/reschedule`, {
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
                    
                    document.getElementById('reschedule-modal').classList.remove('active');
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

        // Cancel Interview
        document.querySelectorAll('.cancel-interview').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const interviewId = this.getAttribute('data-id');
                
                Swal.fire({
                    title: 'Cancel Interview',
                    text: "Are you sure you want to cancel this interview?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, cancel it!',
                    cancelButtonText: 'No, keep it'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            const response = await fetch(`/hrm/staff/interviews/${interviewId}/cancel`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            });
                            
                            const data = await response.json();
                            
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Cancelled!',
                                    text: data.message,
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                
                                // Reload page after 1 second
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1000);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Failed to cancel interview.'
                                });
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went wrong. Please try again.'
                            });
                        }
                    }
                });
            });
        });

        // Close Modals
        document.querySelectorAll('.close-view-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('view-interview-modal').classList.remove('active');
                document.body.style.overflow = '';
            });
        });

        document.getElementById('close-complete-modal').addEventListener('click', () => {
            document.getElementById('complete-interview-modal').classList.remove('active');
            document.body.style.overflow = '';
        });

        document.getElementById('cancel-complete').addEventListener('click', () => {
            document.getElementById('complete-interview-modal').classList.remove('active');
            document.body.style.overflow = '';
        });

        document.querySelectorAll('.close-reschedule-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('reschedule-modal').classList.remove('active');
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