<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, user-scalable=yes">
    <title>{{ __('message.Sign in') }} | {{ config('app.name', 'Elnegma') }}</title>
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/app_logo.png') }}" type="image/x-icon" />

    <!-- External Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Flag Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css"/>

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
                        purple: {
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
                        red: {
                            500: '#BD3628'
                        }
                    },
                    animation: {
                        'fadeInUp': 'fadeInUp 0.5s ease-out',
                        'zoomIn': 'zoomIn 0.3s ease-out',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        zoomIn: {
                            '0%': { opacity: '0', transform: 'scale(0.95)' },
                            '100%': { opacity: '1', transform: 'scale(1)' }
                        }
                    }
                }
            }
        };
    </script>

    <style>
        body {
            font-family: 'Inter', 'Tajawal', sans-serif;
            background-color: #f3f4f6;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-rule='evenodd'%3E%3Cg fill='%236000c0' fill-opacity='0.05'%3E%3Cpath opacity='.5' d='M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .rtl {
            direction: rtl;
            text-align: right;
        }
        
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(96, 0, 192, 0.2);
        }
        
        .bg-gradient {
            background: linear-gradient(135deg, #6000C0 0%, #9F66FF 100%);
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .float-animation {
            animation: float 5s ease-in-out infinite;
        }
        
        /* Custom password toggle button styles */
        .position-relative {
            position: relative;
        }
        
        html[dir="rtl"] .position-relative .absolute.inset-y-0.right-3 {
            right: auto;
            left: 3px;
        }
        
        .password-toggle-btn {
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .password-toggle-btn:hover {
            background-color: rgba(124, 58, 237, 0.1);
            border-radius: 50%;
        }
        
        /* Dropdown improvements */
        [x-cloak] { 
            display: none !important; 
        }
        
        .dropdown-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Loading spinner animation */
        .spinner {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        
        /* Button loading state */
        .btn-loading {
            position: relative;
            pointer-events: none;
            opacity: 0.8;
        }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 min-h-screen font-sans">
    <!-- Modern notifications with SweetAlert2 -->
    @if(session('error') || session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if(session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: "{{ __('message.Error') }}",
                        text: "{{ session('error') }}",
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        showCloseButton: true,
                        timer: 4000,
                        timerProgressBar: true,
                        background: '#ffffff',
                        iconColor: '#BD3628',
                        customClass: {
                            popup: 'rounded-lg shadow-md'
                        }
                    });
                @endif

                @if(session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: "{{ __('message.Success') }}",
                        text: "{{ session('success') }}",
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        showCloseButton: true,
                        timer: 4000,
                        timerProgressBar: true,
                        background: '#ffffff',
                        iconColor: '#6000C1',
                        customClass: {
                            popup: 'rounded-lg shadow-md'
                        }
                    });
                @endif
            });
        </script>
    @endif

    <div class="min-h-screen flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-6 animate-fadeInUp">
            <!-- Language Selector -->
            <div class="flex justify-end mb-4">
                <div class="relative inline-block text-left" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200">
                        <i class="fas fa-globe mx-2 text-purple-600"></i>
                        {{ __('message.Language') }}
                        &nbsp;
                        <i class="fas fa-chevron-down ml-2 transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                    </button>
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-1 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-1 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         @click.away="open = false" 
                         class="origin-top-right absolute {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} mt-2 w-48 rounded-xl shadow-xl bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 dark:ring-gray-600 focus:outline-none z-50 border border-gray-200 dark:border-gray-600"
                         style="display: none;"
                         x-cloak>
                        <div class="py-2">
                            <a href="{{ route('setLocale', ['locale' => 'en']) }}" class="flex items-center px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-purple-50 dark:hover:bg-purple-900/20 hover:text-purple-700 dark:hover:text-purple-300 transition-all duration-200 {{ app()->getLocale() === 'en' ? 'bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-300' : '' }}">
                                {{ __('message.English') }}
                                @if(app()->getLocale() === 'en')
                                    <i class="fas fa-check ml-auto text-purple-600"></i>
                                @endif
                            </a>
                            <a href="{{ route('setLocale', ['locale' => 'ar']) }}" class="flex items-center px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-purple-50 dark:hover:bg-purple-900/20 hover:text-purple-700 dark:hover:text-purple-300 transition-all duration-200 {{ app()->getLocale() === 'ar' ? 'bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-300' : '' }}">
                                {{ __('message.Arabic') }}
                                @if(app()->getLocale() === 'ar')
                                    <i class="fas fa-check ml-auto text-purple-600"></i>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo and Title -->
            <div class="text-center">
                <div class="relative mx-auto h-20 w-20 mb-4">
                    <div class="absolute inset-0 bg-purple-100 dark:bg-purple-900/30 rounded-full opacity-50 animate-pulse-slow"></div>
                    <img class="relative mx-auto h-20 w-auto float-animation" src="{{ asset('assets/img/kaiadmin/app_logo.png') }}" alt="Logo">
                </div>
                <h2 class="mt-4 text-3xl font-extrabold text-gray-900 dark:text-white">
                    {{ __('message.Sign in') }}
                </h2>
                <p class="mt-2 text-base text-gray-600 dark:text-gray-400">
                    {{ __('message.Admin Panel') }}
                </p>
            </div>

            <!-- Login Form Card -->
            <div class="bg-white dark:bg-gray-800 py-8 px-4 shadow-xl sm:rounded-2xl sm:px-10 border border-gray-200 dark:border-gray-700">
                <form class="space-y-6" method="POST" action="{{ route('loginStore') }}" id="loginForm">
                    @csrf
                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-envelope mx-2 text-purple-600"></i>{{ __('message.Email') }}
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input id="email" name="email" type="email" autocomplete="email" required 
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('email') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                placeholder="{{ __('message.Enter email address') }}" value="{{ old('email') }}">
                        </div>
                        @if ($errors->has('email'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-lock mx-2 text-purple-600"></i>{{ __('message.Password') }}
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('password') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                placeholder="{{ __('message.Enter password') }}" autocomplete="current-password">
                            <button type="button"
                                class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center toggle-password password-toggle-btn"
                                data-target="password" onclick="togglePassword()">
                                <i id="eye-icon" class="fas fa-eye text-purple-500 hover:text-purple-700 transition-colors text-lg"></i>
                            </button>
                        </div>
                        @if ($errors->has('password'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="btn btn-primary relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-200">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i class="fas fa-sign-in-alt text-purple-300 group-hover:text-purple-200 transition duration-200"></i>
                            </span>
                            {{ __('message.Sign in') }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    @if(app()->getLocale() == 'ar')
                        {{ __('message.All Right Reserved') }} &copy; {{ date('Y') }} {{ "marketopiaTeam" }}
                    @else
                        &copy; {{ date('Y') }} {{ "marketopiaTeam" }}. {{ __('message.All Right Reserved') }}
                    @endif
                </p>
            </div>

        </div>
    </div>

    <script>
        function togglePassword() {
            let passwordInput = document.getElementById("password");
            let eyeIcon = document.getElementById("eye-icon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }

        // Form submission
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        // Prevent double submission
                        if (submitBtn.classList.contains('btn-loading')) {
                            e.preventDefault();
                            return false;
                        }
                        
                        // Add loading state
                        submitBtn.classList.add('btn-loading');
                        submitBtn.disabled = true;
                        
                        // Update button content with proper RTL support
                        const isRTL = document.documentElement.dir === 'rtl';
                        const loadingText = '{{ __("message.Signing in") }}';
                        
                        if (isRTL) {
                            submitBtn.innerHTML = `
                                <span class="flex items-center justify-center">
                                    <i class="fas fa-spinner spinner ml-2"></i>
                                    ${loadingText}...
                                </span>
                            `;
                        } else {
                            submitBtn.innerHTML = `
                                <span class="flex items-center justify-center">
                                    <i class="fas fa-spinner spinner mr-2"></i>
                                    ${loadingText}...
                                </span>
                            `;
                        }
                    }
                });
            }
        });
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>