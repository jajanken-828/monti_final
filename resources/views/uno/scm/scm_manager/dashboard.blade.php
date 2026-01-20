<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SCM Manager Dashboard - Monti Textile SCM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <!-- Include the same CSS as HRM manager dashboard -->
        <style>
            /* Copy all the CSS from your HRM manager dashboard */
            .bg-blue-theme { background-color: #2563eb; }
            .bg-gold-theme { background-color: #d4af37; }
            .bg-emerald-theme { background-color: #059669; }
            /* ... include all other CSS ... */
        </style>
    @endif

    <!-- Custom SCM Manager Styles -->
    <style>
        .bg-scm-blue { background-color: #1e40af; }
        .text-scm-blue { color: #1e40af; }
        .border-scm-blue { border-color: #1e40af; }
        
        .sidebar-item.active {
            background-color: rgba(30, 64, 175, 0.1);
        }
        
        .sidebar-item.active .sidebar-icon {
            color: #1e40af;
        }
        
        .featured-banner {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <!-- Mobile Overlay -->
    <div class="mobile-sidebar-overlay" id="mobile-overlay"></div>

    <!-- Sidebar -->
    <div class="sidebar bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col py-6 px-4 fixed h-full z-10" id="sidebar">
        <div class="flex items-center justify-between px-2 mb-8">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-scm-blue flex items-center justify-center">
                    <i class="fas fa-box text-white text-xl"></i>
                </div>
                <span class="font-bold text-xl text-gray-900 dark:text-white">Monti Textile</span>
            </div>
            
            <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400" id="sidebar-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <nav class="flex-1 space-y-1">
            <a href="{{ route('scm.manager.dashboard') }}" class="sidebar-item active flex items-center space-x-3 py-3 px-4 rounded-xl text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <span class="sidebar-text font-medium">SCM Manager Dashboard</span>
            </a>
            
            <a href="#" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-warehouse"></i>
                </div>
                <span class="sidebar-text font-medium">Inventory Management</span>
            </a>
            
            <a href="#" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <span class="sidebar-text font-medium">Logistics & Shipping</span>
            </a>
            
            <a href="#" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-user-tie"></i>
                </div>
                <span class="sidebar-text font-medium">SCM Staff Management</span>
                <span class="ml-auto bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 text-xs font-medium px-2 py-0.5 rounded-full">2</span>
            </a>
            
            <div class="py-4 px-4">
                <div class="border-t border-gray-200 dark:border-gray-700"></div>
            </div>
            
            <a href="#" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-cog"></i>
                </div>
                <span class="sidebar-text font-medium">Settings</span>
            </a>
            
            <!-- Logout Button -->
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
                <div class="sidebar-icon w-6 text-center">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <span class="sidebar-text font-medium">Logout</span>
            </a>
        </nav>
        
        <div class="px-4 pt-6 border-t border-gray-200 dark:border-gray-700">
            <div class="bg-blue-50 dark:bg-blue-900 rounded-xl p-4">
                <div class="text-blue-800 dark:text-blue-200 font-medium text-sm mb-2">SCM Manager Tools</div>
                <p class="text-blue-600 dark:text-blue-300 text-xs mb-3">Access advanced SCM management features</p>
                <button class="w-full bg-scm-blue hover:bg-blue-800 text-white py-2 rounded-lg text-xs font-medium transition-colors">
                    Manager Panel
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content flex-1 ml-64 min-h-screen flex flex-col" id="main-content">
        <!-- Top Header -->
        <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 py-4 px-8 flex items-center justify-between sticky top-0 z-10">
            <div class="header-content flex items-center justify-between w-full">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white header-title">SCM Manager Dashboard</h1>
                    <p class="text-gray-500 dark:text-gray-400 hidden md:block">Supply Chain Management & Staff Authority</p>
                </div>
                
                <div class="flex items-center space-x-4 header-actions">
                    <div class="flex items-center space-x-3">
                        <!-- Welcome message -->
                        <span class="text-gray-600 dark:text-gray-400 hidden md:inline">
                            Welcome, {{ auth()->user()->first_name }} (Manager)
                        </span>
                        
                        <button class="relative p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300">
                            <i class="fas fa-bell"></i>
                            <span class="notification-badge">2</span>
                        </button>
                        
                        <button class="md:hidden p-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300" id="mobile-menu-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                        <div class="w-10 h-10 rounded-xl bg-scm-blue flex items-center justify-center text-white font-medium hidden md:flex">
                            SM
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-8 overflow-y-auto custom-scrollbar">
            <!-- SCM Manager Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 stats-grid">
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-4">
                        <i class="fas fa-users text-blue-600 dark:text-blue-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Total SCM Staff</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">18</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center mr-4">
                        <i class="fas fa-arrow-up text-emerald-600 dark:text-emerald-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Eligible for Promotion</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">5</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900 flex items-center justify-center mr-4">
                        <i class="fas fa-chart-bar text-purple-600 dark:text-purple-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Supply Efficiency</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">92%</div>
                    </div>
                </div>
                
                <div class="card p-6 flex items-center">
                    <div class="w-12 h-12 rounded-xl bg-gold-100 dark:bg-gold-900 flex items-center justify-center mr-4">
                        <i class="fas fa-award text-gold-600 dark:text-gold-300 text-xl"></i>
                    </div>
                    <div>
                        <div class="text-gray-500 dark:text-gray-400 text-sm">Avg. Experience</div>
                        <div class="text-2xl font-bold text-gray-900 dark:text-white">4.2 yrs</div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="card p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">SCM Staff Management</h2>
                
                <!-- SCM Staff List -->
                <div class="overflow-x-auto">
                    <table class="w-full min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-700">
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Staff Member</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Department</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Position</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Experience</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($staff as $member)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 font-medium">
                                            {{ strtoupper(substr($member->first_name, 0, 1) . substr($member->last_name, 0, 1)) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $member->first_name }} {{ $member->last_name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $member->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $member->department ?? 'Supply Chain' }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    {{ $member->position === 'staff' ? 'SCM Staff' : 'SCM Manager' }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                    3.5 years
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    @if($member->position === 'staff')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                        Eligible for Promotion
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                        Manager
                                    </span>
                                    @endif
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($member->position === 'staff')
                                    <form action="{{ route('scm.promote', $member) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="text-gold-600 hover:text-gold-900 dark:text-gold-400 dark:hover:text-gold-300 mr-3" onclick="return confirm('Promote {{ $member->first_name }} to SCM Manager?')">
                                            <i class="fas fa-arrow-up mr-1"></i> Promote to Manager
                                        </button>
                                    </form>
                                    @endif
                                    <a href="#" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if(session('success'))
                <div class="mt-4 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 rounded-lg">
                    {{ session('success') }}
                </div>
                @endif
                
                @if(session('error'))
                <div class="mt-4 p-4 bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-300 rounded-lg">
                    {{ session('error') }}
                </div>
                @endif
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <div class="card p-6">
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-4">Recent Promotions</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 text-sm font-medium mr-3">
                                    JD
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">John Doe</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Promoted: Oct 20, 2023</div>
                                </div>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Staff → Manager</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center text-purple-600 dark:text-purple-300 text-sm font-medium mr-3">
                                    SJ
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">Sarah Johnson</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Promoted: Sep 15, 2023</div>
                                </div>
                            </div>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Staff → Manager</span>
                        </div>
                    </div>
                </div>
                
                <div class="card p-6">
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-4">Manager Actions</h3>
                    <div class="space-y-3">
                        <a href="#" class="flex items-center p-3 bg-blue-50 dark:bg-blue-900 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-800 transition-colors">
                            <i class="fas fa-user-plus text-blue-600 dark:text-blue-300 mr-3"></i>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Add New SCM Staff</span>
                        </a>
                        <a href="#" class="flex items-center p-3 bg-green-50 dark:bg-green-900 rounded-lg hover:bg-green-100 dark:hover:bg-green-800 transition-colors">
                            <i class="fas fa-chart-line text-green-600 dark:text-green-300 mr-3"></i>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">View Performance Reports</span>
                        </a>
                        <a href="#" class="flex items-center p-3 bg-purple-50 dark:bg-purple-900 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-800 transition-colors">
                            <i class="fas fa-cog text-purple-600 dark:text-purple-300 mr-3"></i>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Manage Permissions</span>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script>
        // Toggle sidebar
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileOverlay = document.getElementById('mobile-overlay');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        
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
        
        function closeSidebar() {
            if (window.innerWidth < 1024) {
                sidebar.classList.remove('active');
                mobileOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        }
        
        sidebarToggle.addEventListener('click', toggleSidebar);
        mobileMenuToggle.addEventListener('click', toggleSidebar);
        mobileOverlay.addEventListener('click', closeSidebar);
        
        // Handle responsive behavior
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
        
        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            if (window.innerWidth < 1024) {
                mainContent.style.marginLeft = '0';
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>