<div class="flex items-center justify-between h-16 px-6 bg-white dark:bg-dark-800 transition-colors duration-300">
    <!-- Left Section - Mobile Menu Button & Page Title -->
    <div class="flex items-center space-x-4 rtl:space-x-reverse">
        <!-- Mobile Menu Button - More Prominent -->
        <button 
            class="lg:hidden p-3 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-dark-700 rounded-lg transition-colors border border-gray-300 dark:border-dark-600 shadow-sm"
            onclick="toggleSidebar()"
            aria-label="Toggle Sidebar"
            id="mobileMenuBtn"
        >
            <i class="fas fa-bars text-lg"></i>
        </button>
        
        <!-- Breadcrumb or Page Title -->
        <div class="hidden md:block">
            <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
                @yield('page-title', __('Dashboard'))
            </h1>
            <nav class="text-sm text-gray-500 dark:text-gray-400">
                @yield('breadcrumb')
            </nav>
        </div>
    </div>

    <!-- Right Section - User Menu & Actions -->
    <div class="flex items-center space-x-4 rtl:space-x-reverse">
        
        <!-- Language Dropdown -->
        <div class="relative" id="languageDropdown">
            <button 
                onclick="toggleDropdown('languageMenu')"
                class="flex items-center space-x-2 rtl:space-x-reverse px-3 py-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-dark-700 rounded-lg transition-colors"
            >
                <i class="fas fa-globe text-lg"></i>
                <span class="hidden md:block text-sm font-medium">
                    {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
                </span>
                <i class="fas fa-chevron-down text-xs"></i>
            </button>
            
            <div 
                id="languageMenu" 
                class="absolute {{ app()->getLocale() == 'ar' ? 'left-0' : 'right-0' }} mt-2 w-48 bg-white dark:bg-dark-800 rounded-xl shadow-lg border border-gray-200 dark:border-dark-600 py-2 hidden z-50"
            >
                <a href="{{ route('setLocale', 'en') }}" 
                   class="flex items-center space-x-3 rtl:space-x-reverse px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-dark-700 transition-colors {{ app()->getLocale() == 'en' ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400' : '' }}">
                    <span class="text-lg">🇺🇸</span>
                    <span class="font-medium">English</span>
                    @if(app()->getLocale() == 'en')
                        <i class="fas fa-check text-primary-600 dark:text-primary-400 ml-auto"></i>
                    @endif
                </a>
                <a href="{{ route('setLocale', 'ar') }}" 
                   class="flex items-center space-x-3 rtl:space-x-reverse px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-dark-700 transition-colors {{ app()->getLocale() == 'ar' ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400' : '' }}">
                    <span class="text-lg">🇸🇦</span>
                    <span class="font-medium">العربية</span>
                    @if(app()->getLocale() == 'ar')
                        <i class="fas fa-check text-primary-600 dark:text-primary-400 ml-auto"></i>
                    @endif
                </a>
            </div>
        </div>
        <!-- Theme Toggle Button -->
        <button onclick="toggleTheme()"
            class="p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-dark-700 rounded-lg transition-colors hidden md:block"
            id="themeToggle">
            <i class="fas fa-moon dark:hidden text-gray-600"></i>
            <i class="fas fa-sun hidden dark:block text-yellow-400"></i>
        </button>


        <!-- User Profile Dropdown -->
        <div class="relative" id="userDropdown">
            <button 
                onclick="toggleDropdown('userMenu')"
                class="flex items-center space-x-3 rtl:space-x-reverse px-3 py-2 hover:bg-gray-100 dark:hover:bg-dark-700 rounded-lg transition-colors"
            >
                <div class="relative">
                    <img 
                        src="{{ asset(auth('web')->user()->image ? auth('web')->user()->image : 'assets/img/profile.jpg') }}" 
                        alt="Profile" 
                        class="h-8 w-8 rounded-full object-cover ring-2 ring-gray-200 dark:ring-dark-600"
                    />
                    <span class="absolute -bottom-0.5 -right-0.5 h-3 w-3 bg-green-400 rounded-full ring-2 ring-white dark:ring-dark-800"></span>
                </div>
                <div class="hidden md:block text-left rtl:text-right">
                    <p class="text-sm font-medium text-gray-700 dark:text-gray-200">
                        {{ auth('web')->user()->name }}
                    </p>
                </div>
                <i class="fas fa-chevron-down text-xs text-gray-500 dark:text-gray-400"></i>
            </button>
            
            <div 
                id="userMenu" 
                class="absolute {{ app()->getLocale() == 'ar' ? 'left-0' : 'right-0' }} mt-2 w-64 bg-white dark:bg-dark-800 rounded-xl shadow-lg border border-gray-200 dark:border-dark-600 py-3 hidden z-50"
            >
                <!-- User Info Header -->
                <div class="px-4 py-3 border-b border-gray-200 dark:border-dark-600">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img 
                            src="{{ asset(auth('web')->user()->image ? auth('web')->user()->image : 'assets/img/profile.jpg') }}" 
                            alt="Profile" 
                            class="h-12 w-12 rounded-full object-cover"
                        />
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-800 dark:text-white truncate">
                                {{ auth('web')->user()->name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                {{ auth('web')->user()->email }}
                            </p>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400 mt-1">
                                {{ __('message.Online') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Menu Items -->
                <div class="py-2">
                    <a href="{{ route('admin.profileMe') }}" 
                       class="flex items-center space-x-3 rtl:space-x-reverse px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-dark-700 transition-colors">
                        <i class="fas fa-user text-gray-400 dark:text-gray-500"></i>
                        <span class="font-medium">{{ __('message.My Profile') }}</span>
                    </a>
                </div>

                <!-- Logout -->
                <div class="border-t border-gray-200 dark:border-dark-600 pt-2">
                    <a href="#" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="flex items-center space-x-3 rtl:space-x-reverse px-4 py-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="font-medium">{{ __('message.Logout') }}</span>
                    </a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>