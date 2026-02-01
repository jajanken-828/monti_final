<div class="sidebar bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col py-6 px-4 fixed h-full z-10" id="sidebar">
    <div class="flex items-center justify-between px-2 mb-8">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-gold-theme flex items-center justify-center">
                <i class="fas fa-crown text-white text-xl"></i>
            </div>
            <span class="font-bold text-xl text-gray-900 dark:text-white">Monti Textile</span>
        </div>
        
        <button class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500 dark:text-gray-400" id="sidebar-toggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    
    <nav class="flex-1 space-y-1">
        <!-- Employee Information -->
        <a href="{{ route('hrm.manager.dashboard') }}" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
            <div class="sidebar-icon w-6 text-center">
                <i class="fas fa-users"></i>
            </div>
            <span class="sidebar-text font-medium">Employee Information</span>
        </a>
        
        <!-- Recruitment & Onboarding -->
        <a href="{{ route('hrm.manager.onboarding') }}" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
            <div class="sidebar-icon w-6 text-center">
                <i class="fas fa-user-plus"></i>
            </div>
            <span class="sidebar-text font-medium">Recruitment & Onboarding</span>
        </a>
        
        <!-- Payroll Management -->
        <a href="{{ route('hrm.manager.payroll') }}" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
            <div class="sidebar-icon w-6 text-center">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <span class="sidebar-text font-medium">Payroll Management</span>
        </a>
        
        <!-- HR Analytics & Reports -->
        <a href="{{ route('hrm.manager.analytics') }}" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
            <div class="sidebar-icon w-6 text-center">
                <i class="fas fa-chart-line"></i>
            </div>
            <span class="sidebar-text font-medium">HR Analytics & Reports</span>
        </a>
        
        <div class="py-4 px-4">
            <div class="border-t border-gray-200 dark:border-gray-700"></div>
        </div>
        
        <!-- Settings -->
        <a href="#" class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
            <div class="sidebar-icon w-6 text-center">
                <i class="fas fa-sliders-h"></i>
            </div>
            <span class="sidebar-text font-medium">Settings</span>
        </a>
        
        <!-- Logout -->
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
           class="sidebar-item flex items-center space-x-3 py-3 px-4 rounded-xl text-gray-600 dark:text-gray-300 hover:text-blue-theme">
            <div class="sidebar-icon w-6 text-center">
                <i class="fas fa-right-from-bracket"></i>
            </div>
            <span class="sidebar-text font-medium">Logout</span>
        </a>
    </nav>
    
   <div class="px-4 pt-6 border-t border-gray-200 dark:border-gray-700">
        <div class="bg-blue-50 dark:bg-blue-900 rounded-xl p-4">
        <div class="text-blue-800 dark:text-blue-200 font-medium text-sm mb-1">
            Human Resource {{ auth()->user()->position }}
        </div>

        <p class="text-blue-700 dark:text-blue-300 text-sm font-semibold">
            {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
        </p>

        <p class="text-blue-600 dark:text-blue-400 text-xs mt-1">
            {{ auth()->user()->email }}
        </p>
    </div>
</div>
</div>
