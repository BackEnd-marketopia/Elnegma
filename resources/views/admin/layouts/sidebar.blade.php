<div class="h-full flex flex-col bg-white dark:bg-dark-800 transition-colors duration-300">
    <!-- Logo Section -->
    <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-dark-700">
        <a href="{{ route('admin.index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('assets/img/kaiadmin/app_logo.png') }}" alt="Negma" class="h-10 w-auto" />
            <span class="text-xl font-bold text-gray-800 dark:text-white">{{ __('message.Admin Panel') }}</span>
        </a>
        
        <!-- Mobile Sidebar Close Button -->
        <button 
            class="lg:hidden p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-dark-700 rounded-lg transition-colors z-50 relative"
            onclick="window.toggleSidebar()"
            id="sidebarCloseBtn"
            style="z-index: 9999;"
        >
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('admin.index') }}" 
           class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 group {{ Route::currentRouteName() == 'admin.index' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 shadow-sm' : '' }}">
            <i class="fas fa-home text-lg mr-3 rtl:ml-3 rtl:mr-0 group-hover:scale-110 transition-transform"></i>
            <span class="font-medium">{{ __('message.Dashboard') }}</span>
        </a>

        <!-- Categories -->
        <div class="nav-group">
            <button onclick="toggleNavGroup('Categories')" 
                    class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 group {{ in_array(Route::currentRouteName(), ['admin.categories.index', 'admin.categories.create']) ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400' : '' }}">
                <div class="flex items-center">
                    <i class="fas fa-tags text-lg mr-3 rtl:ml-3 rtl:mr-0 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">{{ __('message.Categories') }}</span>
                </div>
                <i class="fas fa-chevron-down text-sm transition-transform duration-200 group-hover:rotate-180" id="Categories-icon"></i>
            </button>
            <div class="mt-2 ml-7 rtl:mr-7 rtl:ml-0 space-y-1 hidden" id="Categories-menu">
                <a href="{{ route('admin.categories.create') }}" 
                   class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/10 rounded-lg transition-all duration-200">
                    <i class="fas fa-plus text-xs mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Add') }}
                </a>
                <a href="{{ route('admin.categories.index') }}" 
                   class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/10 rounded-lg transition-all duration-200">
                    <i class="fas fa-list text-xs mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.List') }}
                </a>
            </div>
        </div>

        <!-- Banners -->
        <div class="nav-group">
            <button onclick="toggleNavGroup('Banners')" 
                    class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 group {{ in_array(Route::currentRouteName(), ['admin.banners.index', 'admin.banners.create']) ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400' : '' }}">
                <div class="flex items-center">
                    <i class="fas fa-image text-lg mr-3 rtl:ml-3 rtl:mr-0 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">{{ __('message.Banners') }}</span>
                </div>
                <i class="fas fa-chevron-down text-sm transition-transform duration-200 group-hover:rotate-180" id="Banners-icon"></i>
            </button>
            <div class="mt-2 ml-7 rtl:mr-7 rtl:ml-0 space-y-1 hidden" id="Banners-menu">
                <a href="{{ route('admin.banners.create') }}" 
                   class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/10 rounded-lg transition-all duration-200">
                    <i class="fas fa-plus text-xs mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Add') }}
                </a>
                <a href="{{ route('admin.banners.index') }}" 
                   class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/10 rounded-lg transition-all duration-200">
                    <i class="fas fa-list text-xs mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.List') }}
                </a>
            </div>
        </div>

        <!-- User Types -->
        <div class="nav-group">
            <button onclick="toggleNavGroup('UserTypes')" 
                    class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 group {{ in_array(Route::currentRouteName(), ['admin.users.index', 'admin.users.create', 'admin.admins.index', 'admin.admins.create', 'admin.providers.index', 'admin.providers.create', 'admin.vendors.index', 'admin.vendors.create']) ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400' : '' }}">
                <div class="flex items-center">
                    <i class="fas fa-users text-lg mr-3 rtl:ml-3 rtl:mr-0 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">{{ __('message.User Types') }}</span>
                </div>
                <i class="fas fa-chevron-down text-sm transition-transform duration-200 group-hover:rotate-180" id="UserTypes-icon"></i>
            </button>
            <div class="mt-2 ml-7 rtl:mr-7 rtl:ml-0 space-y-1 hidden" id="UserTypes-menu">
                <a href="{{ route('admin.admins.index') }}" 
                   class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/10 rounded-lg transition-all duration-200">
                    <i class="fas fa-user-shield text-xs mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Admins') }}
                </a>
                <a href="{{ route('admin.vendors.index') }}" 
                   class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/10 rounded-lg transition-all duration-200">
                    <i class="fas fa-store text-xs mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Vendos') }}
                </a>
                <a href="{{ route('admin.users.index') }}" 
                   class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/10 rounded-lg transition-all duration-200">
                    <i class="fas fa-user text-xs mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Users') }}
                </a>
            </div>
        </div>

        <!-- Notifications -->
        <div class="nav-group">
            <button onclick="toggleNavGroup('Notifications')" 
                    class="w-full flex items-center justify-between px-4 py-3 text-gray-700 dark:text-gray-200 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 group {{ in_array(Route::currentRouteName(), ['admin.notifications.index', 'admin.notifications.create']) ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400' : '' }}">
                <div class="flex items-center">
                    <i class="fas fa-bell text-lg mr-3 rtl:ml-3 rtl:mr-0 group-hover:scale-110 transition-transform"></i>
                    <span class="font-medium">{{ __('message.Notifications') }}</span>
                </div>
                <i class="fas fa-chevron-down text-sm transition-transform duration-200 group-hover:rotate-180" id="Notifications-icon"></i>
            </button>
            <div class="mt-2 ml-7 rtl:mr-7 rtl:ml-0 space-y-1 hidden" id="Notifications-menu">
                <a href="{{ route('admin.notifications.create') }}" 
                   class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/10 rounded-lg transition-all duration-200">
                    <i class="fas fa-plus text-xs mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Add') }}
                </a>
                <a href="{{ route('admin.notifications.index') }}" 
                   class="block px-4 py-2 text-sm text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/10 rounded-lg transition-all duration-200">
                    <i class="fas fa-list text-xs mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.List') }}
                </a>
            </div>
        </div>

        <!-- Single Menu Items -->
        <a href="{{ route('admin.ads.index') }}" 
           class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 group {{ Route::currentRouteName() == 'admin.ads.index' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 shadow-sm' : '' }}">
            <i class="fas fa-bullhorn text-lg mr-3 rtl:ml-3 rtl:mr-0 group-hover:scale-110 transition-transform"></i>
            <span class="font-medium">{{ __('message.Advertisements') }}</span>
        </a>

        <a href="{{ route('admin.cities.index') }}" 
           class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 group {{ Route::currentRouteName() == 'admin.cities.index' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 shadow-sm' : '' }}">
            <i class="fas fa-globe text-lg mr-3 rtl:ml-3 rtl:mr-0 group-hover:scale-110 transition-transform"></i>
            <span class="font-medium">{{ __('message.Cities') }}</span>
        </a>

        <a href="{{ route('admin.payments.index') }}" 
           class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 group {{ Route::currentRouteName() == 'admin.payments.index' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 shadow-sm' : '' }}">
            <i class="fas fa-hand-holding-usd text-lg mr-3 rtl:ml-3 rtl:mr-0 group-hover:scale-110 transition-transform"></i>
            <span class="font-medium">{{ __('message.Payments') }}</span>
        </a>

        <a href="{{ route('admin.config') }}" 
           class="flex items-center px-4 py-3 text-gray-700 dark:text-gray-200 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/20 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-200 group {{ Route::currentRouteName() == 'admin.config' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 shadow-sm' : '' }}">
            <i class="fas fa-cog text-lg mr-3 rtl:ml-3 rtl:mr-0 group-hover:scale-110 transition-transform"></i>
            <span class="font-medium">{{ __('message.Configurations') }}</span>
        </a>
    </nav>
</div>

<script>
    function toggleNavGroup(groupName) {
        const menu = document.getElementById(groupName + '-menu');
        const icon = document.getElementById(groupName + '-icon');
        
        if (menu.classList.contains('hidden')) {
            // Close all other menus
            document.querySelectorAll('[id$="-menu"]').forEach(m => {
                if (m !== menu) {
                    m.classList.add('hidden');
                }
            });
            document.querySelectorAll('[id$="-icon"]').forEach(i => {
                if (i !== icon) {
                    i.classList.remove('rotate-180');
                }
            });
            
            // Open this menu
            menu.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            menu.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }

    // Auto-expand active menu on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Check if any submenu item is active
        const activeSubmenuItems = document.querySelectorAll('[id$="-menu"] a');
        activeSubmenuItems.forEach(item => {
            if (item.href === window.location.href) {
                const menu = item.closest('[id$="-menu"]');
                const groupName = menu.id.replace('-menu', '');
                const icon = document.getElementById(groupName + '-icon');
                menu.classList.remove('hidden');
                icon.classList.add('rotate-180');
            }
        });
    });
</script>