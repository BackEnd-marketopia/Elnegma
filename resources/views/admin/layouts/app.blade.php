<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, user-scalable=yes" />
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/app_logo.png') }}" type="image/x-icon" />

    <!-- External Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin-modern.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/admin-custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/admin-tables.css') }}" />

    <!-- Tailwind CSS Configuration -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'Tajawal', 'system-ui', 'sans-serif'],
                        'arabic': ['Tajawal', 'system-ui', 'sans-serif']
                    },
                    colors: {
                        primary: {
                            50: '#F5F0FF',
                            100: '#E6D9FF',
                            200: '#D4C5FF',
                            300: '#B68AFF',
                            400: '#9F66FF',
                            500: '#6000C0',
                            600: '#4A0099',
                            700: '#330066',
                            800: '#220044',
                            900: '#110022'
                        },
                        dark: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a'
                        }
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS moved to separate files -->
    @yield('styles')
</head>

<body class="bg-gray-50 dark:bg-dark-900 font-sans antialiased transition-colors duration-300" id="body">

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 w-64 bg-white dark:bg-dark-800 shadow-xl transition-transform duration-300 z-50 lg:static lg:inset-0" id="sidebar" style="{{ app()->getLocale() == 'ar' ? 'right: 0; transform: translateX(100%);' : 'left: 0; transform: translateX(-100%);' }}">
            @include('admin.layouts.sidebar')
        </aside>

        <!-- Sidebar Overlay for Mobile -->
        <div class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden" id="sidebarOverlay"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 lg:ml-0">
            <!-- Header -->
            <header class="bg-white dark:bg-dark-800 shadow-sm border-b border-gray-200 dark:border-dark-700 transition-colors duration-300 relative z-20">
                @include('admin.layouts.header')
            </header>

            <!-- Alert Messages -->
            @if(session()->has('success'))
                <div class="alert-slide-down mx-2 md:mx-4 mt-4 p-3 md:p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 dark:text-green-400 mr-3 rtl:ml-3 rtl:mr-0 flex-shrink-0"></i>
                        <div class="text-green-800 dark:text-green-200 font-medium text-sm md:text-base flex-1 min-w-0">
                            {{ session()->get('success') }}
                        </div>
                        <button class="ml-2 rtl:mr-2 rtl:ml-0 text-green-500 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 flex-shrink-0" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert-slide-down mx-2 md:mx-4 mt-4 p-3 md:p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-500 dark:text-red-400 mr-3 rtl:ml-3 rtl:mr-0 flex-shrink-0"></i>
                        <div class="text-red-800 dark:text-red-200 font-medium text-sm md:text-base flex-1 min-w-0">
                            {{ session()->get('error') }}
                        </div>
                        <button class="ml-2 rtl:mr-2 rtl:ml-0 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 flex-shrink-0" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            @endif

            <!-- Main Content Area -->
            <main class="flex-1 p-4 md:p-6 bg-gray-50 dark:bg-dark-900 transition-colors duration-300 fade-in overflow-x-auto">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white dark:bg-dark-800 border-t border-gray-200 dark:border-dark-700 transition-colors duration-300">
                @include('admin.layouts.footer')
            </footer>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-300">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-2xl transform scale-95 transition-transform duration-300">
            <div class="flex flex-col items-center">
                <div class="animate-spin rounded-full h-12 w-12 border-4 border-purple-200 border-t-purple-600 mb-4"></div>
                <p class="text-gray-600 dark:text-gray-300 font-medium">{{ __('message.Loading') }}...</p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/admin-modern.js') }}"></script>
    
    <!-- Global Delete Confirmation Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Global delete confirmation for all delete buttons
        function initializeDeleteConfirmation() {
            document.querySelectorAll('.delete-btn').forEach(btn => {
                // Remove existing listeners to avoid duplicates
                btn.removeEventListener('click', handleDeleteClick);
                btn.addEventListener('click', handleDeleteClick);
            });
        }
        
        function handleDeleteClick(e) {
            e.preventDefault();
            
            // Try to get the item name from different possible locations
            let itemName = '';
            const row = this.closest('tr');
            const card = this.closest('.card, .bg-white, .bg-gray-50');
            
            if (row) {
                // For table rows - try to get name from first cell with text
                const firstCell = row.querySelector('td:nth-child(1) div, td:nth-child(1)');
                if (firstCell) {
                    itemName = firstCell.textContent.trim();
                }
            } else if (card) {
                // For cards - try to get name from title or heading
                const title = card.querySelector('h1, h2, h3, h4, h5, h6, .title, .name');
                if (title) {
                    itemName = title.textContent.trim();
                }
            }
            
            // If we couldn't find a name, try data attributes
            if (!itemName) {
                itemName = this.getAttribute('data-name') || 
                          this.getAttribute('data-title') || 
                          this.closest('form').getAttribute('data-name') ||
                          '{{ __("message.this item") }}';
            }
            
            Swal.fire({
                title: '{{ __("message.Are you sure") }}?',
                html: `{{ __("message.You will not be able to revert this") }}!<br><strong class="text-red-600">${itemName}</strong>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '{{ __("message.Yes delete it") }}!',
                cancelButtonText: '{{ __("message.Cancel") }}',
                reverseButtons: true,
                customClass: {
                    popup: 'animate-zoomIn',
                    confirmButton: 'hover:bg-red-700 transition-colors',
                    cancelButton: 'hover:bg-gray-600 transition-colors'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    const submitBtn = this;
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>{{ __("message.Deleting") }}...';
                    submitBtn.disabled = true;
                    
                    // Submit the form
                    this.closest('form').submit();
                }
            });
        }
        
        // Initialize on page load
        initializeDeleteConfirmation();
        
        // Re-initialize when new content is loaded (for AJAX updates)
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.addedNodes.length > 0) {
                    initializeDeleteConfirmation();
                }
            });
        });
        
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    });
    </script>
    
    @yield('scripts')
    @stack('scripts')
</body>
</html>