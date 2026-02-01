<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recruitment & Onboarding - Monti Textile HRM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        @include('uno.hrm.hrm_manager.style')
    @endif

    <!-- Custom color overrides for gold/blue theme -->
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
        
        /* Recruitment specific styles */
        .recruitment-status {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-open {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .status-closed {
            background-color: #f1f5f9;
            color: #475569;
        }
        
        .status-pending {
            background-color: #fef9c3;
            color: #854d0e;
        }
        
        .status-urgent {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .applicant-status {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-pending {
            background-color: #dbeafe;
            color: #1e40af;
        }
        
        .status-under_review {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .status-interview_scheduled, .status-interview_rescheduled {
            background-color: #d1fae5;
            color: #065f46;
        }
        
        .status-interview_passed {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .status-interview_failed, .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .status-accepted {
            background-color: #e0e7ff;
            color: #3730a3;
        }
        
        .onboarding-step {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .onboarding-step.completed::before {
            content: '✓';
            position: absolute;
            left: 0;
            width: 20px;
            height: 20px;
            background-color: #10b981;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
        }
        
        .onboarding-step.pending::before {
            content: '';
            position: absolute;
            left: 0;
            width: 20px;
            height: 20px;
            background-color: #f3f4f6;
            border: 2px solid #d1d5db;
            border-radius: 50%;
        }
        
        .onboarding-step.current::before {
            content: '';
            position: absolute;
            left: 0;
            width: 20px;
            height: 20px;
            background-color: #3b82f6;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        
        /* Enhanced Kanban Board Styles */
        .kanban-column {
            min-height: 500px;
            background: linear-gradient(to bottom, #f8fafc, #f1f5f9);
            border-radius: 0.75rem;
            padding: 1.25rem;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .dark .kanban-column {
            background: linear-gradient(to bottom, #1e293b, #334155);
            border-color: #475569;
        }
        
        .kanban-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.25rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            cursor: move;
            border-left: 6px solid #3b82f6;
            position: relative;
            transition: all 0.2s ease;
        }
        
        .dark .kanban-card {
            background: #374151;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2), 0 2px 4px -1px rgba(0, 0, 0, 0.1);
        }
        
        .kanban-card.urgent {
            border-left-color: #ef4444;
            background: linear-gradient(to right, white, #fef2f2);
        }
        
        .dark .kanban-card.urgent {
            background: linear-gradient(to right, #4b5563, #7f1d1d);
        }
        
        .kanban-card.high-priority {
            border-left-color: #f59e0b;
            background: linear-gradient(to right, white, #fef3c7);
        }
        
        .dark .kanban-card.high-priority {
            background: linear-gradient(to right, #4b5563, #78350f);
        }
        
        .kanban-card.medium-priority {
            border-left-color: #10b981;
            background: linear-gradient(to right, white, #d1fae5);
        }
        
        .dark .kanban-card.medium-priority {
            background: linear-gradient(to right, #4b5563, #064e3b);
        }
        
        .drag-over {
            border: 2px dashed #3b82f6;
            background-color: rgba(59, 130, 246, 0.1);
            transform: scale(1.02);
        }
        
        .kanban-card.dragging {
            opacity: 0.5;
            transform: rotate(3deg) scale(1.05);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
        }
        
        .drag-placeholder {
            height: 120px;
            border: 2px dashed #3b82f6;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
            background: rgba(59, 130, 246, 0.05);
            transition: all 0.3s ease;
        }
        
        .kanban-column-header {
            position: relative;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .dark .kanban-column-header {
            border-bottom-color: #4b5563;
        }
        
        .kanban-column-header::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 2px;
            background: linear-gradient(to right, #3b82f6, #60a5fa);
        }
        
        .interview-schedule {
            border-left: 4px solid #8b5cf6;
        }
        
        .interview-schedule.completed {
            opacity: 0.7;
            border-left-color: #10b981;
        }
        
        .interview-schedule.upcoming {
            border-left-color: #f59e0b;
        }
        
        .score-badge {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: bold;
        }
        
        .score-high {
            background-color: #dcfce7;
            color: #166534;
        }
        
        .score-medium {
            background-color: #fef3c7;
            color: #92400e;
        }
        
        .score-low {
            background-color: #fee2e2;
            color: #991b1b;
        }
        
        .document-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-right: 0.5rem;
        }
        
        .document-complete {
            background-color: #10b981;
            color: white;
        }
        
        .document-pending {
            background-color: #f59e0b;
            color: white;
        }
        
        .document-missing {
            background-color: #ef4444;
            color: white;
        }
        
        .timeline-item {
            position: relative;
            padding-left: 2rem;
            padding-bottom: 1.5rem;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #3b82f6;
        }
        
        .timeline-item::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 12px;
            width: 2px;
            height: calc(100% - 12px);
            background: #e5e7eb;
        }
        
        .timeline-item:last-child::after {
            display: none;
        }
        
        .dark .timeline-item::after {
            background: #4b5563;
        }
        
        .custom-datepicker {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            width: 100%;
        }
        
        .dark .custom-datepicker {
            background-color: #374151;
            border-color: #4b5563;
            color: #f9fafb;
        }
        
        .application-card {
            transition: all 0.2s ease;
            border-left: 4px solid #3b82f6;
        }
        
        .application-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .application-card.highlight {
            border-left-color: #f59e0b;
            background: linear-gradient(to right, #fef3c7, white);
        }
        
        .dark .application-card.highlight {
            background: linear-gradient(to right, #78350f, #4b5563);
        }
        
        /* Enhanced drag and drop animations */
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
            50% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
        }
        
        .kanban-card.glow {
            animation: pulse-glow 2s infinite;
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
        
        /* Modal Overlay - Fixed */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        /* Hidden utility class */
        .hidden {
            display: none !important;
        }
        
        /* Kanban Board Loading Overlay */
        .kanban-loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            z-index: 100;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 0.75rem;
            backdrop-filter: blur(4px);
        }
        
        .dark .kanban-loading-overlay {
            background: rgba(17, 24, 39, 0.9);
        }
        
        .kanban-loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(59, 130, 246, 0.3);
            border-radius: 50%;
            border-top-color: #3b82f6;
            animation: spin 1s ease-in-out infinite;
            margin-bottom: 15px;
        }
        
        .kanban-loading-text {
            color: #4b5563;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .dark .kanban-loading-text {
            color: #d1d5db;
        }
        
        /* Lazy Loading Skeleton */
        .skeleton-loading {
            position: relative;
            overflow: hidden;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
        }
        
        .dark .skeleton-loading {
            background: linear-gradient(90deg, #374151 25%, #4b5563 50%, #374151 75%);
            background-size: 200% 100%;
        }
        
        @keyframes skeleton-loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        .skeleton-kanban-card {
            height: 100px;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
        }
        
        .skeleton-kanban-card-small {
            height: 80px;
            border-radius: 0.75rem;
            margin-bottom: 1rem;
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
        
        .dark .status-open {
            background-color: #14532d;
            color: #86efac;
        }
        
        .dark .status-closed {
            background-color: #334155;
            color: #cbd5e1;
        }
        
        .dark .status-pending {
            background-color: #713f12;
            color: #fde047;
        }
        
        .dark .status-urgent {
            background-color: #7f1d1d;
            color: #fca5a5;
        }
        
        .dark .status-pending {
            background-color: #1e3a8a;
            color: #93c5fd;
        }
        
        .dark .status-under_review {
            background-color: #78350f;
            color: #fde68a;
        }
        
        .dark .status-interview_scheduled, .dark .status-interview_rescheduled {
            background-color: #064e3b;
            color: #a7f3d0;
        }
        
        .dark .status-interview_passed {
            background-color: #14532d;
            color: #86efac;
        }
        
        .dark .status-interview_failed, .dark .status-rejected {
            background-color: #7f1d1d;
            color: #fca5a5;
        }
        
        .dark .status-accepted {
            background-color: #3730a3;
            color: #c7d2fe;
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
            
            .kanban-board {
                overflow-x: auto;
                display: flex;
                padding-bottom: 1rem;
            }
            
            .kanban-column {
                min-width: 280px;
                min-height: 400px;
                margin-right: 1rem;
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
        
        /* View Details Button Styles */
        .view-details-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background: transparent;
            border: none;
            color: #3b82f6;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        
        .view-details-btn:hover {
            background: rgba(59, 130, 246, 0.1);
            transform: scale(1.1);
        }
        
        .dark .view-details-btn {
            color: #60a5fa;
        }
        
        .dark .view-details-btn:hover {
            background: rgba(96, 165, 250, 0.1);
        }
        
        .kanban-card .view-details-btn {
            font-size: 0.875rem;
        }
        
        .kanban-card-header {
            position: relative;
            padding-right: 32px;
        }
        
        /* Simplified Kanban Card Styles */
        .simplified-kanban-card {
            padding: 1rem;
            margin-bottom: 1rem;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            cursor: move;
            border-left: 6px solid #3b82f6;
            position: relative;
            transition: all 0.2s ease;
            animation: cardSlideIn 0.3s ease-out;
        }
        
        @keyframes cardSlideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .dark .simplified-kanban-card {
            background: #374151;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2), 0 2px 4px -1px rgba(0, 0, 0, 0.1);
        }
        
        .simplified-kanban-card .applicant-info {
            padding-right: 32px;
        }
        
        .simplified-kanban-card h4 {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #1f2937;
        }
        
        .dark .simplified-kanban-card h4 {
            color: #f9fafb;
        }
        
        .simplified-kanban-card .position {
            font-size: 0.8rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }
        
        .dark .simplified-kanban-card .position {
            color: #9ca3af;
        }
        
        .simplified-kanban-card .applicant-status {
            font-size: 0.7rem;
            padding: 0.15rem 0.5rem;
        }
        
        /* Applicant Details Modal Styles */
        .applicant-details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .applicant-details-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .detail-item {
            margin-bottom: 1rem;
        }
        
        .detail-label {
            font-weight: 600;
            color: #4b5563;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }
        
        .dark .detail-label {
            color: #9ca3af;
        }
        
        .detail-value {
            color: #1f2937;
            font-size: 1rem;
        }
        
        .dark .detail-value {
            color: #f9fafb;
        }
        
        .detail-section {
            background: #f9fafb;
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .dark .detail-section {
            background: #374151;
        }
        
        .detail-section-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e5e7eb;
        }
        
        .dark .detail-section-title {
            color: #f9fafb;
            border-bottom-color: #4b5563;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <!-- Mobile Overlay -->
    <div class="mobile-sidebar-overlay" id="mobile-overlay"></div>

    <!-- Content Loading Overlay -->
    <div id="content-loading-overlay" class="content-loading-overlay">
        <div class="loading-spinner"></div>
        <div class="loading-content">
            <h3>Monti Textile HRM</h3>
            <p>Loading recruitment & onboarding dashboard...</p>
        </div>
        <div class="loading-progress-bar">
            <div id="loading-progress-fill" class="loading-progress-fill"></div>
        </div>
    </div>

    <!-- Sidebar -->
     @include('uno.hrm.hrm_manager.SideBarHrManager')

    <!-- Main Content -->
    <div class="main-content flex-1 ml-64 min-h-screen flex flex-col hidden" id="main-content">
        <!-- Top Header -->
        <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 py-4 px-8 flex items-center justify-between sticky top-0 z-10">
            <div class="header-content flex items-center justify-between w-full">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white header-title">Recruitment & Onboarding</h1>
                    <p class="text-gray-500 dark:text-gray-400 hidden md:block">Manage job openings, applicants, and onboarding processes</p>
                </div>
                
                <div class="flex items-center space-x-4 header-actions">
                    <div class="flex items-center space-x-3">
                        <button class="md:hidden p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300" id="mobile-search-toggle">
                            <i class="fas fa-search"></i>
                        </button>
                        
                        <button class="relative p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">0</span>
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
            <!-- Recruitment Stats Overview - UPDATED: Fixed statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 stats-grid">
                <div class="card p-6 flex items-center content-fade-in stagger-delay-1">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-4">
                        <i class="fas fa-user-clock text-blue-600 dark:text-blue-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">For Interview</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['for_interview'] }}</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center content-fade-in stagger-delay-2">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center mr-4">
                        <i class="fas fa-users text-emerald-600 dark:text-emerald-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Total Applicants</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total_applicants'] }}</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center content-fade-in stagger-delay-3">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900 flex items-center justify-center mr-4">
                        <i class="fas fa-calendar-check text-purple-600 dark:text-purple-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Interviews Scheduled</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['interviews_scheduled'] }}</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center content-fade-in stagger-delay-4">
                    <div class="w-12 h-12 rounded-xl bg-gold-100 dark:bg-gold-900 flex items-center justify-center mr-4">
                        <i class="fas fa-user-plus text-gold-600 dark:text-gold-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">New Hires This Month</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['new_hires'] }}</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Banner - UPDATED: Removed buttons -->
            <div class="featured-banner mb-8 content-fade-in">
                <div class="p-8">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <div class="featured-banner-content mb-6 md:mb-0">
                            <h2 class="text-2xl font-bold mb-3 text-white">Recruitment Command Center</h2>
                            <p class="text-blue-100 mb-6 max-w-lg">Manage applicants, schedule interviews, and track the entire hiring process from one dashboard.</p>
                        </div>
                        <div class="featured-banner-image animate-float">
                            <div class="w-48 h-32 bg-gradient-to-r from-emerald-400 to-emerald-300 dark:from-emerald-500 dark:to-emerald-400 rounded-lg shadow-xl flex items-center justify-center">
                                <i class="fas fa-user-tie text-white text-4xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 main-grid">
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Applicant Pipeline (Kanban Board) - UPDATED: Simplified cards -->
                    <div class="card p-6 content-fade-in stagger-delay-1">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-bold text-xl text-gray-900 dark:text-white">Applicant Pipeline</h3>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                <i class="fas fa-arrows-alt mr-2"></i>
                                <span>Drag and drop to move applicants between stages</span>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 kanban-board" id="kanban-board">
                            <!-- For Interview Column -->
                            <div class="kanban-column" data-status="interview_scheduled,interview_rescheduled">
                                <div class="kanban-column-header">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full bg-blue-500 mr-2"></div>
                                            <span class="font-semibold text-gray-700 dark:text-gray-300">For Interview</span>
                                        </div>
                                        <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 text-xs font-bold px-2 py-1 rounded-full">{{ $forInterviewApplicants->count() }}</span>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Initial screening completed</p>
                                </div>
                                <div id="for-interview-column">
                                    @foreach($forInterviewApplicants as $applicant)
                                    <div class="simplified-kanban-card" data-applicant-id="{{ $applicant->id }}" data-update-url="{{ route('hrm.manager.applicants.update-status', $applicant->id) }}" draggable="true">
                                        <div class="applicant-info">
                                            <h4 class="font-medium text-gray-900 dark:text-white">{{ $applicant->full_name }}</h4>
                                            <p class="position text-gray-500 dark:text-gray-400">{{ Str::limit($applicant->position_applied, 25) }}</p>
                                            <span class="applicant-status status-{{ $applicant->status }}">{{ $applicant->formatted_status }}</span>
                                        </div>
                                        <button class="view-details-btn" data-applicant-id="{{ $applicant->id }}" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="drag-placeholder hidden"></div>
                            </div>
                            
                            <!-- Final Interview Column -->
                            <div class="kanban-column" data-status="interview_passed">
                                <div class="kanban-column-header">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full bg-yellow-500 mr-2"></div>
                                            <span class="font-semibold text-gray-700 dark:text-gray-300">Final Interview</span>
                                        </div>
                                        <span class="bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-300 text-xs font-bold px-2 py-1 rounded-full">{{ $finalInterviewApplicants->count() }}</span>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Passed initial interview</p>
                                </div>
                                <div id="final-interview-column">
                                    @foreach($finalInterviewApplicants as $applicant)
                                    <div class="simplified-kanban-card" data-applicant-id="{{ $applicant->id }}" data-update-url="{{ route('hrm.manager.applicants.update-status', $applicant->id) }}" draggable="true">
                                        <div class="applicant-info">
                                            <h4 class="font-medium text-gray-900 dark:text-white">{{ $applicant->full_name }}</h4>
                                            <p class="position text-gray-500 dark:text-gray-400">{{ Str::limit($applicant->position_applied, 25) }}</p>
                                            <span class="applicant-status status-{{ $applicant->status }}">{{ $applicant->formatted_status }}</span>
                                        </div>
                                        <button class="view-details-btn" data-applicant-id="{{ $applicant->id }}" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="drag-placeholder hidden"></div>
                            </div>
                            
                            <!-- Onboarding Column -->
                            <div class="kanban-column" data-status="accepted">
                                <div class="kanban-column-header">
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                                            <span class="font-semibold text-gray-700 dark:text-gray-300">Onboarding</span>
                                        </div>
                                        <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 text-xs font-bold px-2 py-1 rounded-full">{{ $onboardingApplicants->count() }}</span>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Ready for onboarding process</p>
                                </div>
                                <div id="onboarding-column">
                                    @foreach($onboardingApplicants as $applicant)
                                    <div class="simplified-kanban-card" data-applicant-id="{{ $applicant->id }}" data-update-url="{{ route('hrm.manager.applicants.update-status', $applicant->id) }}" draggable="true">
                                        <div class="applicant-info">
                                            <h4 class="font-medium text-gray-900 dark:text-white">{{ $applicant->full_name }}</h4>
                                            <p class="position text-gray-500 dark:text-gray-400">{{ Str::limit($applicant->position_applied, 25) }}</p>
                                            <span class="applicant-status status-{{ $applicant->status }}">{{ $applicant->formatted_status }}</span>
                                        </div>
                                        <button class="view-details-btn" data-applicant-id="{{ $applicant->id }}" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="drag-placeholder hidden"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column - UPDATED: Removed recruitment metrics -->
                <div class="space-y-8">
                    <!-- Upcoming Interviews -->
                    <div class="card p-6 content-fade-in stagger-delay-3">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Upcoming Interviews</h3>
                            <a href="#" class="text-blue-theme text-sm font-medium hover:text-blue-700 dark:hover:text-blue-400">View All</a>
                        </div>
                        
                        <div class="space-y-4" id="upcoming-interviews">
                            @foreach($upcomingInterviews as $interview)
                            <div class="interview-schedule {{ $interview->isToday() ? 'upcoming' : '' }}">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h4 class="font-medium text-gray-900 dark:text-white">{{ $interview->applicant->full_name }}</h4>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $interview->applicant->position_applied }}</p>
                                    </div>
                                    <span class="text-sm font-medium {{ $interview->isToday() ? 'text-yellow-600 dark:text-yellow-400' : 'text-gray-500 dark:text-gray-400' }}">
                                        {{ $interview->scheduled_date->format('h:i A') }}
                                    </span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-2">
                                    <i class="fas fa-user-tie mr-2"></i>
                                    <span>{{ $interview->interviewer->name ?? 'TBD' }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-video mr-2"></i>
                                    <span>{{ $interview->interview_type_label }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Applications -->
            <div class="mt-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-xl text-gray-900 dark:text-white">Recent Applications</h3>
                    <div class="flex space-x-3">
                        <a href="{{ route('hrm.manager.export-csv') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-download mr-2"></i> Export CSV
                        </a>
                        <button class="px-4 py-2 bg-blue-theme hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors" id="add-applicant-btn">
                            <i class="fas fa-plus mr-2"></i> Add Applicant
                        </button>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" id="recent-applications">
                    @foreach($recentApplications as $applicant)
                    <div class="application-card card p-5 hover:shadow-lg transition-shadow duration-300 {{ $applicant->hasUpcomingInterview() ? 'highlight' : '' }}">
                        <div class="flex items-center mb-4 relative">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold mr-4">
                                {{ substr($applicant->first_name, 0, 1) }}{{ substr($applicant->last_name, 0, 1) }}
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 dark:text-white">{{ $applicant->full_name }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $applicant->position_applied }}</p>
                            </div>
                            <button class="view-details-btn" data-applicant-id="{{ $applicant->id }}" title="View Details">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-envelope mr-2"></i>
                                <span class="truncate">{{ $applicant->email }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-phone mr-2"></i>
                                <span>{{ $applicant->phone_number }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                <span>Applied: {{ $applicant->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="applicant-status status-{{ $applicant->status }}">{{ $applicant->formatted_status }}</span>
                            <span class="text-xs text-gray-500">
                                @if($applicant->hasUpcomingInterview())
                                    <i class="fas fa-clock text-yellow-500 mr-1"></i> Interview Scheduled
                                @endif
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </main>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Add Applicant Modal -->
    <div id="add-applicant-modal" class="modal-overlay fixed inset-0 bg-blue-900/40 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto shadow-2xl border border-blue-100 dark:border-gray-700">
            
            <!-- Header -->
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-blue-100 dark:border-gray-700">
                <h3 class="text-xl font-bold text-blue-900 dark:text-white flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                    Add New Applicant
                </h3>
                <button class="text-gray-400 hover:text-red-500 transition" id="close-applicant-modal">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            
            <form id="applicant-form" action="{{ route('hrm.manager.applicants.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    
                    <!-- Name -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">First Name *</label>
                            <input type="text" name="first_name" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" placeholder="First Name" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Middle Name</label>
                            <input type="text" name="middle_name" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" placeholder="Middle Name">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Last Name *</label>
                            <input type="text" name="last_name" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" placeholder="Last Name" required>
                        </div>
                    </div>

                    <!-- Birth / Position -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Birth Date *</label>
                            <input type="date" name="birth_date" class="custom-datepicker w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Position Applied *</label>
                            <select name="position_applied" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" required>
                                <option value="">Select Position</option>
                                <option value="HR Manager">HR Manager</option>
                                <option value="Production Supervisor">Production Supervisor</option>
                                <option value="Quality Control Inspector">Quality Control Inspector</option>
                                <option value="Textile Engineer">Textile Engineer</option>
                                <option value="Maintenance Technician">Maintenance Technician</option>
                                <option value="Sales Representative">Sales Representative</option>
                                <option value="Accountant">Accountant</option>
                                <option value="IT Support">IT Support</option>
                            </select>
                        </div>
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Street Address *</label>
                        <input type="text" name="street_address" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" placeholder="Street Address" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Street Address Line 2</label>
                        <input type="text" name="street_address_line2" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" placeholder="Apartment, Suite, Unit, etc.">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">City *</label>
                            <input type="text" name="city" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" placeholder="City" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">State/Province *</label>
                            <input type="text" name="state_province" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" placeholder="State/Province" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Postal/ZIP Code *</label>
                            <input type="text" name="postal_zip_code" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" placeholder="Postal/ZIP Code" required>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Email *</label>
                            <input type="email" name="email" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" placeholder="Email Address" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Phone Number *</label>
                            <input type="tel" name="phone_number" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" placeholder="Phone Number" required>
                        </div>
                    </div>

                    <!-- Interview Schedule Section -->
                    <div class="detail-section">
                        <h4 class="detail-section-title mb-4">Interview Schedule</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Interview Date *</label>
                                <input type="date" name="interview_date" class="custom-datepicker w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" id="interview-date-input">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Interview Time *</label>
                                <input type="time" name="interview_time" class="custom-datepicker w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" id="interview-time-input">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Interview Type *</label>
                                <select name="interview_type" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300">
                                    <option value="phone">Phone Interview</option>
                                    <option value="video">Video Interview</option>
                                    <option value="in_person">In-Person Interview</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Duration (minutes) *</label>
                                <input type="number" name="duration" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" placeholder="e.g., 60" min="15" max="240" value="60">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Location / Meeting Link</label>
                            <input type="text" name="location" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" placeholder="Conference Room A or Zoom link...">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Interview Notes</label>
                            <textarea name="interview_notes" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" rows="3" placeholder="Any special instructions for the interview..."></textarea>
                        </div>
                    </div>

                    <!-- Checkbox + Status -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center bg-blue-50 dark:bg-gray-700 p-4 rounded-xl">
                            <input type="checkbox" name="textile_experience" value="1" class="rounded border-gray-300 text-yellow-500 focus:ring-yellow-400">
                            <span class="ml-3 text-sm font-medium text-blue-900 dark:text-gray-300">
                                Textile Industry Experience
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Status</label>
                            <select name="status" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300">
                                <option value="interview_scheduled">Interview Scheduled</option>
                            </select>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-sm font-semibold text-blue-800 dark:text-gray-300 mb-1">Notes</label>
                        <textarea name="notes" class="input-field w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-300" rows="4" placeholder="Additional notes about the applicant..."></textarea>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex space-x-3">
                    <button type="button" id="cancel-applicant"
                        class="flex-1 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-xl font-semibold transition">
                        Cancel
                    </button>
                    <button type="submit"
                        class="flex-1 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-semibold transition shadow-lg shadow-blue-500/30">
                        Add Applicant
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- View Applicant Details Modal -->
    <div id="view-applicant-modal" class="modal-overlay fixed inset-0 bg-blue-900/40 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto shadow-2xl border border-blue-100 dark:border-gray-700">
            <div class="flex justify-between items-center mb-6 pb-4 border-b border-blue-100 dark:border-gray-700">
                <h3 class="text-xl font-bold text-blue-900 dark:text-white flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-green-400"></span>
                    Applicant Details
                </h3>
                <button class="text-gray-400 hover:text-red-500 transition" id="close-view-modal">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
            <div id="applicant-details-content">
                <!-- Details will be loaded here via AJAX -->
                <div class="text-center py-8">
                    <div class="loading-spinner" style="width: 40px; height: 40px; margin: 0 auto 20px;"></div>
                    <p class="text-gray-500 dark:text-gray-400">Loading applicant details...</p>
                </div>
            </div>
        </div>
    </div>

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
            
            // Initialize modal functionality
            initializeModal();
            initializeKanbanDragDrop();
            
            // Add event listeners for view details buttons
            initializeViewDetailsButtons();
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
        function initializeModal() {
            const addApplicantBtn = document.getElementById('add-applicant-btn');
            const addApplicantModal = document.getElementById('add-applicant-modal');
            const closeApplicantModal = document.getElementById('close-applicant-modal');
            const cancelApplicant = document.getElementById('cancel-applicant');
            const applicantForm = document.getElementById('applicant-form');
            const viewApplicantModal = document.getElementById('view-applicant-modal');
            const closeViewModal = document.getElementById('close-view-modal');
            
            // Set default interview date to tomorrow
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const interviewDateInput = document.getElementById('interview-date-input');
            const interviewTimeInput = document.getElementById('interview-time-input');
            
            if (interviewDateInput) {
                interviewDateInput.value = tomorrow.toISOString().split('T')[0];
            }
            
            if (interviewTimeInput) {
                // Set default time to 10:00 AM
                interviewTimeInput.value = '10:00';
            }
            
            // Add Applicant Modal
            addApplicantBtn.addEventListener('click', () => {
                addApplicantModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
            
            closeApplicantModal.addEventListener('click', () => {
                addApplicantModal.classList.remove('active');
                document.body.style.overflow = '';
            });
            
            cancelApplicant.addEventListener('click', () => {
                addApplicantModal.classList.remove('active');
                document.body.style.overflow = '';
            });
            
            // Close modal when clicking outside
            addApplicantModal.addEventListener('click', (e) => {
                if (e.target === addApplicantModal) {
                    addApplicantModal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
            
            // Form submission with AJAX
            applicantForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const formData = new FormData(applicantForm);
                
                // Combine interview date and time into a single datetime value
                const interviewDate = document.getElementById('interview-date-input').value;
                const interviewTime = document.getElementById('interview-time-input').value;
                
                if (interviewDate && interviewTime) {
                    const scheduledDate = `${interviewDate} ${interviewTime}:00`;
                    formData.append('scheduled_date', scheduledDate);
                }
                
                try {
                    const response = await fetch(applicantForm.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        addApplicantModal.classList.remove('active');
                        document.body.style.overflow = '';
                        showToast('Applicant added successfully!', 'success');
                        applicantForm.reset();
                        
                        // Reset date and time to defaults
                        if (interviewDateInput) {
                            const tomorrow = new Date();
                            tomorrow.setDate(tomorrow.getDate() + 1);
                            interviewDateInput.value = tomorrow.toISOString().split('T')[0];
                        }
                        if (interviewTimeInput) {
                            interviewTimeInput.value = '10:00';
                        }
                        
                        // Reload the page to see the new applicant
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        showToast('Error adding applicant', 'error');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showToast('Error adding applicant', 'error');
                }
            });
            
            // View Applicant Modal
            if (closeViewModal) {
                closeViewModal.addEventListener('click', () => {
                    viewApplicantModal.classList.add('hidden');
                    document.body.style.overflow = '';
                });
                
                viewApplicantModal.addEventListener('click', (e) => {
                    if (e.target === viewApplicantModal) {
                        viewApplicantModal.classList.add('hidden');
                        document.body.style.overflow = '';
                    }
                });
            }
            
            // Close modal with Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    if (addApplicantModal.classList.contains('active')) {
                        addApplicantModal.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                    if (!viewApplicantModal.classList.contains('hidden')) {
                        viewApplicantModal.classList.add('hidden');
                        document.body.style.overflow = '';
                    }
                }
            });
        }
        
        // Initialize view details buttons
        function initializeViewDetailsButtons() {
            // Add click event listeners to all view details buttons
            document.querySelectorAll('.view-details-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation(); // Prevent event bubbling
                    const applicantId = this.getAttribute('data-applicant-id');
                    viewApplicantDetails(applicantId);
                });
            });
            
            // Also add to the old view-applicant-btn class (if any still exist)
            document.querySelectorAll('.view-applicant-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const applicantId = this.getAttribute('data-applicant-id');
                    viewApplicantDetails(applicantId);
                });
            });
        }
        
        // Function to view applicant details
        async function viewApplicantDetails(applicantId) {
            const viewApplicantModal = document.getElementById('view-applicant-modal');
            const detailsContent = document.getElementById('applicant-details-content');
            
            // Show loading state
            detailsContent.innerHTML = `
                <div class="text-center py-8">
                    <div class="loading-spinner" style="width: 40px; height: 40px; margin: 0 auto 20px;"></div>
                    <p class="text-gray-500 dark:text-gray-400">Loading applicant details...</p>
                </div>
            `;
            
            // Show modal
            viewApplicantModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            try {
                const response = await fetch(`/hrm/manager/applicants/${applicantId}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    const applicant = data.applicant;
                    
                    // Format birth date
                    const birthDate = new Date(applicant.birth_date);
                    const formattedBirthDate = birthDate.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    
                    // Format interview date if exists
                    let interviewDateHtml = 'Not scheduled';
                    if (applicant.interview_date) {
                        const interviewDate = new Date(applicant.interview_date);
                        interviewDateHtml = interviewDate.toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    }
                    
                    // Format created date
                    const createdDate = new Date(applicant.created_at);
                    const formattedCreatedDate = createdDate.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                    
                    // Format address
                    let addressHtml = applicant.street_address;
                    if (applicant.street_address_line2) {
                        addressHtml += `<br>${applicant.street_address_line2}`;
                    }
                    addressHtml += `<br>${applicant.city}, ${applicant.state_province} ${applicant.postal_zip_code}`;
                    
                    // Generate interview history HTML
                    let interviewHistoryHtml = '<p class="text-gray-500 dark:text-gray-400">No interview history</p>';
                    if (applicant.interview_schedules && applicant.interview_schedules.length > 0) {
                        interviewHistoryHtml = '';
                        applicant.interview_schedules.forEach((interview, index) => {
                            const scheduledDate = new Date(interview.scheduled_date);
                            const formattedScheduledDate = scheduledDate.toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            });
                            
                            interviewHistoryHtml += `
                                <div class="detail-item border-l-2 border-blue-500 pl-3 py-2 mb-2">
                                    <div class="detail-value font-medium">${formattedScheduledDate}</div>
                                    <div class="flex items-center mt-1">
                                        <span class="applicant-status status-${interview.status}" style="font-size: 0.7rem; padding: 0.125rem 0.5rem;">${interview.status.replace('_', ' ').toUpperCase()}</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">${interview.interview_type_label}</span>
                                    </div>
                                    ${interview.notes ? `<p class="text-sm text-gray-600 dark:text-gray-400 mt-1">${interview.notes}</p>` : ''}
                                </div>
                            `;
                        });
                    }
                    
                    // Generate government documents HTML
                    let documentsHtml = '';
                    const documents = [
                        { name: 'SSS', path: applicant.sss_file_path },
                        { name: 'PhilHealth', path: applicant.philhealth_file_path },
                        { name: 'Pag-IBIG', path: applicant.pagibig_file_path }
                    ];
                    
                    documents.forEach(doc => {
                        const hasDocument = doc.path && doc.path.trim() !== '';
                        documentsHtml += `
                            <div class="flex items-center mb-2">
                                <span class="document-status ${hasDocument ? 'document-complete' : 'document-missing'}">
                                    <i class="fas fa-${hasDocument ? 'check' : 'times'} text-xs"></i>
                                </span>
                                <span class="text-sm ${hasDocument ? 'text-gray-700 dark:text-gray-300' : 'text-gray-500 dark:text-gray-500'}">${doc.name} Document</span>
                            </div>
                        `;
                    });
                    
                    // Build the details HTML
                    detailsContent.innerHTML = `
                        <div class="space-y-6">
                            <!-- Personal Information Section -->
                            <div class="detail-section">
                                <h4 class="detail-section-title">Personal Information</h4>
                                <div class="applicant-details-grid">
                                    <div class="detail-item">
                                        <div class="detail-label">Full Name</div>
                                        <div class="detail-value">${applicant.full_name}</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Birth Date</div>
                                        <div class="detail-value">${formattedBirthDate}</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Email Address</div>
                                        <div class="detail-value">${applicant.email}</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Phone Number</div>
                                        <div class="detail-value">${applicant.phone_number}</div>
                                    </div>
                                    ${applicant.linkedin_profile ? `
                                    <div class="detail-item">
                                        <div class="detail-label">LinkedIn Profile</div>
                                        <div class="detail-value">
                                            <a href="${applicant.linkedin_profile}" target="_blank" class="text-blue-theme hover:underline">View Profile</a>
                                        </div>
                                    </div>
                                    ` : ''}
                                </div>
                            </div>
                            
                            <!-- Application Details Section -->
                            <div class="detail-section">
                                <h4 class="detail-section-title">Application Details</h4>
                                <div class="applicant-details-grid">
                                    <div class="detail-item">
                                        <div class="detail-label">Position Applied</div>
                                        <div class="detail-value">${applicant.position_applied}</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Application Status</div>
                                        <div class="detail-value">
                                            <span class="applicant-status status-${applicant.status}">${applicant.formatted_status}</span>
                                        </div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Applied Date</div>
                                        <div class="detail-value">${formattedCreatedDate}</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Interview Date</div>
                                        <div class="detail-value">${interviewDateHtml}</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Referral Source</div>
                                        <div class="detail-value">${applicant.referral_source || 'N/A'}</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Available Start Date</div>
                                        <div class="detail-value">${applicant.available_start_date ? new Date(applicant.available_start_date).toLocaleDateString() : 'N/A'}</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Textile Experience</div>
                                        <div class="detail-value">${applicant.textile_experience ? 'Yes' : 'No'}</div>
                                    </div>
                                    ${applicant.expected_salary ? `
                                    <div class="detail-item">
                                        <div class="detail-label">Expected Salary</div>
                                        <div class="detail-value">₱${parseFloat(applicant.expected_salary).toLocaleString()}</div>
                                    </div>
                                    ` : ''}
                                    ${applicant.notice_period ? `
                                    <div class="detail-item">
                                        <div class="detail-label">Notice Period</div>
                                        <div class="detail-value">${applicant.notice_period} days</div>
                                    </div>
                                    ` : ''}
                                </div>
                            </div>
                            
                            <!-- Address Section -->
                            <div class="detail-section">
                                <h4 class="detail-section-title">Address</h4>
                                <div class="detail-item">
                                    <div class="detail-value" style="white-space: pre-line;">${addressHtml}</div>
                                </div>
                            </div>
                            
                            <!-- Government Documents Section -->
                            <div class="detail-section">
                                <h4 class="detail-section-title">Government Documents</h4>
                                ${documentsHtml}
                            </div>
                            
                            <!-- Interview History Section -->
                            <div class="detail-section">
                                <h4 class="detail-section-title">Interview History</h4>
                                ${interviewHistoryHtml}
                            </div>
                            
                            <!-- Notes Section -->
                            ${applicant.notes ? `
                            <div class="detail-section">
                                <h4 class="detail-section-title">Notes</h4>
                                <div class="detail-item">
                                    <div class="detail-value text-gray-600 dark:text-gray-400" style="white-space: pre-line;">${applicant.notes}</div>
                                </div>
                            </div>
                            ` : ''}
                        </div>
                    `;
                } else {
                    detailsContent.innerHTML = `
                        <div class="text-center py-8">
                            <i class="fas fa-exclamation-triangle text-yellow-500 text-4xl mb-4"></i>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Error Loading Details</h4>
                            <p class="text-gray-500 dark:text-gray-400">Unable to load applicant details. Please try again.</p>
                            <button class="mt-4 px-4 py-2 bg-blue-theme text-white rounded-lg hover:bg-blue-700 transition-colors" onclick="viewApplicantDetails(${applicantId})">
                                <i class="fas fa-redo mr-2"></i> Retry
                            </button>
                        </div>
                    `;
                }
            } catch (error) {
                console.error('Error:', error);
                detailsContent.innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Network Error</h4>
                        <p class="text-gray-500 dark:text-gray-400">Unable to connect to server. Please check your connection and try again.</p>
                        <button class="mt-4 px-4 py-2 bg-blue-theme text-white rounded-lg hover:bg-blue-700 transition-colors" onclick="viewApplicantDetails(${applicantId})">
                            <i class="fas fa-redo mr-2"></i> Retry
                        </button>
                    </div>
                `;
            }
        }
        
        // Enhanced Kanban board drag and drop functionality with page refresh after 1 second of lazy loading
        function initializeKanbanDragDrop() {
            let draggedCard = null;
            let draggedCardParent = null;
            let placeholder = null;
            let dragOverColumn = null;
            
            const kanbanCards = document.querySelectorAll('.simplified-kanban-card');
            const kanbanColumns = document.querySelectorAll('.kanban-column');
            const kanbanBoard = document.getElementById('kanban-board');
            
            // Create a placeholder element
            function createPlaceholder() {
                const placeholder = document.createElement('div');
                placeholder.className = 'drag-placeholder';
                placeholder.innerHTML = '<div class="text-center text-gray-400 py-4"><i class="fas fa-arrow-down mb-2"></i><p class="text-xs">Drop here</p></div>';
                return placeholder;
            }
            
            // Create loading overlay for kanban board
            function createKanbanLoadingOverlay() {
                const overlay = document.createElement('div');
                overlay.className = 'kanban-loading-overlay';
                overlay.innerHTML = `
                    <div class="kanban-loading-spinner"></div>
                    <div class="kanban-loading-text">Updating applicant status...</div>
                `;
                return overlay;
            }
            
            // Show lazy loading skeleton for kanban columns
            function showLazyLoadingSkeletons() {
                const columns = ['for-interview-column', 'final-interview-column', 'onboarding-column'];
                
                columns.forEach(columnId => {
                    const column = document.getElementById(columnId);
                    if (column) {
                        // Replace content with skeleton loading
                        column.innerHTML = '';
                        for (let i = 0; i < 4; i++) {
                            const skeleton = document.createElement('div');
                            skeleton.className = 'skeleton-loading skeleton-kanban-card-small';
                            column.appendChild(skeleton);
                        }
                    }
                });
            }
            
            // Handle drag start
            kanbanCards.forEach(card => {
                card.addEventListener('dragstart', (e) => {
                    draggedCard = card;
                    draggedCardParent = card.parentElement;
                    
                    // Add dragging class after a small delay for smoother transition
                    setTimeout(() => {
                        card.classList.add('dragging');
                    }, 0);
                    
                    // Set drag image
                    e.dataTransfer.setData('text/plain', card.dataset.applicantId);
                    e.dataTransfer.effectAllowed = 'move';
                    
                    // Create a custom drag image
                    const dragImage = card.cloneNode(true);
                    dragImage.style.width = card.offsetWidth + 'px';
                    dragImage.style.opacity = '0.8';
                    dragImage.style.position = 'absolute';
                    dragImage.style.top = '-1000px';
                    document.body.appendChild(dragImage);
                    e.dataTransfer.setDragImage(dragImage, 20, 20);
                    
                    // Remove the temporary drag image after a short delay
                    setTimeout(() => {
                        document.body.removeChild(dragImage);
                    }, 100);
                });
                
                card.addEventListener('dragend', (e) => {
                    if (draggedCard) {
                        draggedCard.classList.remove('dragging');
                        
                        // Remove any remaining placeholders
                        document.querySelectorAll('.drag-placeholder').forEach(ph => {
                            if (ph.parentElement) {
                                ph.parentElement.removeChild(ph);
                            }
                        });
                        
                        // Reset column drag-over state
                        kanbanColumns.forEach(col => {
                            col.classList.remove('drag-over');
                        });
                        
                        draggedCard = null;
                        draggedCardParent = null;
                        dragOverColumn = null;
                    }
                });
            });
            
            // Handle column drag events
            kanbanColumns.forEach(column => {
                column.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    
                    if (!draggedCard) return;
                    
                    dragOverColumn = column;
                    column.classList.add('drag-over');
                    
                    // Remove existing placeholder from this column
                    const existingPlaceholder = column.querySelector('.drag-placeholder');
                    if (existingPlaceholder && existingPlaceholder !== placeholder) {
                        column.removeChild(existingPlaceholder);
                    }
                    
                    // Create and add placeholder if not already present
                    if (!placeholder) {
                        placeholder = createPlaceholder();
                        column.appendChild(placeholder);
                    } else if (placeholder.parentElement !== column) {
                        // Move placeholder to this column
                        column.appendChild(placeholder);
                    }
                    
                    // Set drop effect
                    e.dataTransfer.dropEffect = 'move';
                });
                
                column.addEventListener('dragleave', (e) => {
                    // Only remove drag-over class if not dragging over a child element
                    if (!column.contains(e.relatedTarget)) {
                        column.classList.remove('drag-over');
                        
                        // Remove placeholder if leaving column
                        if (placeholder && placeholder.parentElement === column) {
                            column.removeChild(placeholder);
                            placeholder = null;
                        }
                    }
                });
                
                column.addEventListener('drop', async (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    if (!draggedCard || draggedCardParent === column) {
                        column.classList.remove('drag-over');
                        if (placeholder && placeholder.parentElement === column) {
                            column.removeChild(placeholder);
                            placeholder = null;
                        }
                        return;
                    }
                    
                    // Get the new status from column data
                    const newStatus = column.getAttribute('data-status').split(',')[0];
                    const applicantId = draggedCard.getAttribute('data-applicant-id');
                    const updateUrl = draggedCard.getAttribute('data-update-url');
                    const applicantName = draggedCard.querySelector('h4').textContent;
                    
                    // Show loading state on the card
                    const originalContent = draggedCard.innerHTML;
                    draggedCard.innerHTML = `
                        <div class="text-center py-4">
                            <div class="loading-spinner" style="width: 30px; height: 30px; margin: 0 auto 10px;"></div>
                            <p class="text-sm text-gray-500">Updating status...</p>
                        </div>
                    `;
                    
                    // Add loading overlay to the kanban board
                    const loadingOverlay = createKanbanLoadingOverlay();
                    kanbanBoard.appendChild(loadingOverlay);
                    
                    // Show lazy loading skeletons for 1 second
                    showLazyLoadingSkeletons();
                    
                    try {
                        const response = await fetch(updateUrl, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ status: newStatus })
                        });
                        
                        const data = await response.json();
                        
                        if (data.success) {
                            // Show success message
                            showToast(`Moved ${applicantName} to ${column.querySelector('.font-semibold').textContent}`, 'success');
                            
                            // Remove loading overlay after 1 second
                            setTimeout(() => {
                                if (loadingOverlay.parentElement) {
                                    loadingOverlay.parentElement.removeChild(loadingOverlay);
                                }
                            }, 1000);
                            
                            // Refresh the whole page after 1 second of lazy loading
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            // Restore original content on error
                            draggedCard.innerHTML = originalContent;
                            
                            // Remove loading overlay
                            if (loadingOverlay.parentElement) {
                                loadingOverlay.parentElement.removeChild(loadingOverlay);
                            }
                            
                            showToast('Error updating status', 'error');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        draggedCard.innerHTML = originalContent;
                        
                        // Remove loading overlay
                        if (loadingOverlay.parentElement) {
                            loadingOverlay.parentElement.removeChild(loadingOverlay);
                        }
                        
                        showToast('Error updating status', 'error');
                    }
                    
                    // Reset dragged card reference
                    draggedCard = null;
                    draggedCardParent = null;
                    dragOverColumn = null;
                });
            });
            
            // Prevent default drag behavior for card images and other elements
            document.addEventListener('dragstart', (e) => {
                if (e.target.tagName === 'IMG' || e.target.tagName === 'BUTTON') {
                    e.preventDefault();
                }
            });
        }
        
        // Toast notification function
        function showToast(message, type) {
            // Remove existing toasts
            document.querySelectorAll('.custom-toast').forEach(toast => toast.remove());
            
            const toast = document.createElement('div');
            toast.className = `custom-toast fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300 translate-x-full ${
                type === 'success' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 border-l-4 border-green-500' : 
                type === 'warning' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300 border-l-4 border-yellow-500' :
                'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300 border-l-4 border-red-500'
            }`;
            toast.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'exclamation-circle'} mr-3"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(toast);
            
            // Animate in
            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
            }, 10);
            
            // Remove after 3 seconds
            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.parentElement.removeChild(toast);
                    }
                }, 300);
            }, 3000);
        }

        // Initialize sidebar links
        document.querySelectorAll('.sidebar-item').forEach(l=>l.addEventListener('click',e=>{e.preventDefault();setTimeout(()=>window.location.href=l.getAttribute('href'),300)}));
    </script>
</body>
</html>