@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('page-title', __('message.Dashboard'))
@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('Admin') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Dashboard') }}</span>
@endsection

@section('content')
<div class="space-y-6 animate-fadeInUp">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('message.Dashboard') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ __('Welcome back! Here\'s what\'s happening with your platform.') }}
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.vendors.create') }}" 
               class="btn-modern btn-primary">
                <i class="fas fa-plus mr-2 rtl:ml-2 rtl:mr-0"></i>
                {{ __('message.Add Vendor') }}
            </a>
            <button class="btn-modern btn-secondary">
                <i class="fas fa-download mr-2 rtl:ml-2 rtl:mr-0"></i>
                {{ __('Export Report') }}
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Users Card -->
        <div class="card-modern p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">
                        {{ __('message.Users') }}
                    </p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        {{ number_format($users) }}
                    </p>
                    <div class="flex items-center mt-2">
                        <span class="text-green-500 text-sm font-medium">
                            <i class="fas fa-arrow-up mr-1"></i>
                            +12%
                        </span>
                        <span class="text-gray-500 dark:text-gray-400 text-xs ml-2 rtl:mr-2 rtl:ml-0">
                            {{ __('vs last month') }}
                        </span>
                    </div>
                </div>
                <div class="bg-primary-100 dark:bg-primary-900/30 p-3 rounded-xl">
                    <i class="fas fa-users text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
            </div>
        </div>

        <!-- Vendors Card -->
        <div class="card-modern p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">
                        {{ __('message.Vendors') }}
                    </p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        {{ number_format($vendors) }}
                    </p>
                    <div class="flex items-center mt-2">
                        <span class="text-green-500 text-sm font-medium">
                            <i class="fas fa-arrow-up mr-1"></i>
                            +8%
                        </span>
                        <span class="text-gray-500 dark:text-gray-400 text-xs ml-2 rtl:mr-2 rtl:ml-0">
                            {{ __('vs last month') }}
                        </span>
                    </div>
                </div>
                <div class="bg-primary-100 dark:bg-primary-900/30 p-3 rounded-xl">
                    <i class="fas fa-store text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
            </div>
        </div>

        <!-- Providers Card -->
        <div class="card-modern p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">
                        {{ __('message.Providers') }}
                    </p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        {{ number_format($providers) }}
                    </p>
                    <div class="flex items-center mt-2">
                        <span class="text-orange-500 text-sm font-medium">
                            <i class="fas fa-arrow-down mr-1"></i>
                            -3%
                        </span>
                        <span class="text-gray-500 dark:text-gray-400 text-xs ml-2 rtl:mr-2 rtl:ml-0">
                            {{ __('vs last month') }}
                        </span>
                    </div>
                </div>
                <div class="bg-primary-100 dark:bg-primary-900/30 p-3 rounded-xl">
                    <i class="fas fa-chalkboard-teacher text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
            </div>
        </div>

        <!-- Subscribed Users Card -->
        <div class="card-modern p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">
                        {{ __('message.Subscribed Users') }}
                    </p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                        {{ number_format($codesPaied) }}
                    </p>
                    <div class="flex items-center mt-2">
                        <span class="text-green-500 text-sm font-medium">
                            <i class="fas fa-arrow-up mr-1"></i>
                            +25%
                        </span>
                        <span class="text-gray-500 dark:text-gray-400 text-xs ml-2 rtl:mr-2 rtl:ml-0">
                            {{ __('vs last month') }}
                        </span>
                    </div>
                </div>
                <div class="bg-primary-100 dark:bg-primary-900/30 p-3 rounded-xl">
                    <i class="fas fa-user-check text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Paid Codes Card -->
        <div class="card-modern p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('message.Codes Paied') }}
                </h3>
                <div class="bg-green-100 dark:bg-green-900/30 p-2 rounded-lg">
                    <i class="fas fa-credit-card text-green-600 dark:text-green-400"></i>
                </div>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ number_format($codesPaied) }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        {{ __('Total paid codes') }}
                    </p>
                </div>
                <div class="text-right rtl:text-left">
                    <span class="text-green-500 text-sm font-medium">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +15%
                    </span>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ __('This week') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Unpaid Codes Card -->
        <div class="card-modern p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('message.Codes Unpaid') }}
                </h3>
                <div class="bg-red-100 dark:bg-red-900/30 p-2 rounded-lg">
                    <i class="fas fa-times-circle text-red-600 dark:text-red-400"></i>
                </div>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-white">
                        {{ number_format($codesUnpaied) }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        {{ __('Total unpaid codes') }}
                    </p>
                </div>
                <div class="text-right rtl:text-left">
                    <span class="text-red-500 text-sm font-medium">
                        <i class="fas fa-arrow-down mr-1"></i>
                        -5%
                    </span>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ __('This week') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- User Statistics Chart -->
        <div class="card-modern p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('message.User Statistics') }}
                </h3>
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <button class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 px-3 py-1 rounded-lg hover:bg-gray-100 dark:hover:bg-dark-700">
                        {{ __('7D') }}
                    </button>
                    <button class="text-sm bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 px-3 py-1 rounded-lg">
                        {{ __('30D') }}
                    </button>
                    <button class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 px-3 py-1 rounded-lg hover:bg-gray-100 dark:hover:bg-dark-700">
                        {{ __('90D') }}
                    </button>
                </div>
            </div>
            <div class="h-80">
                <canvas id="userStatsChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <!-- Revenue Chart -->
        <div class="card-modern p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('Revenue Overview') }}
                </h3>
                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                    <span class="text-2xl font-bold text-gray-900 dark:text-white">
                        ${{ number_format(42580) }}
                    </span>
                    <span class="text-green-500 text-sm">
                        <i class="fas fa-arrow-up"></i>
                        +18%
                    </span>
                </div>
            </div>
            <div class="h-80">
                <canvas id="revenueChart" class="w-full h-full"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card-modern">
        <div class="p-6 border-b border-gray-200 dark:border-dark-600">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('Recent Activity') }}
                </h3>
                <a href="#" class="text-sm text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                    {{ __('View All') }}
                </a>
            </div>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <!-- Activity Item -->
                <div class="flex items-start space-x-4 rtl:space-x-reverse">
                    <div class="bg-primary-100 dark:bg-primary-900/30 p-2 rounded-lg">
                        <i class="fas fa-user-plus text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-900 dark:text-white">
                            {{ __('New user registered') }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            John Doe joined the platform
                        </p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                            2 minutes ago
                        </p>
                    </div>
                </div>

                <!-- Activity Item -->
                <div class="flex items-start space-x-4 rtl:space-x-reverse">
                    <div class="bg-green-100 dark:bg-green-900/30 p-2 rounded-lg">
                        <i class="fas fa-credit-card text-green-600 dark:text-green-400"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-900 dark:text-white">
                            {{ __('Payment received') }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            $150 payment from premium subscription
                        </p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                            15 minutes ago
                        </p>
                    </div>
                </div>

                <!-- Activity Item -->
                <div class="flex items-start space-x-4 rtl:space-x-reverse">
                    <div class="bg-primary-100 dark:bg-primary-900/30 p-2 rounded-lg">
                        <i class="fas fa-store text-primary-600 dark:text-primary-400"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-900 dark:text-white">
                            {{ __('New vendor application') }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Tech Solutions Inc. submitted application
                        </p>
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                            1 hour ago
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
      </div>
    </div>
    </div>
  </div>
  <!-- Chart.js for enhanced charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check if elements exist before creating charts
    const userStatsElement = document.getElementById('userStatsChart');
    const revenueElement = document.getElementById('revenueChart');
    
    if (userStatsElement) {
        const userStatsCtx = userStatsElement.getContext('2d');
        const isDarkMode = document.documentElement.classList.contains('dark');
        
        new Chart(userStatsCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: '{{ __("Users") }}',
                    data: [120, 190, 300, 500, 200, 300, 450, 600, 750, 850, 950, {{ $users }}],
                    borderColor: '#6000C0',
                    backgroundColor: 'rgba(96, 0, 192, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: isDarkMode ? '#f1f5f9' : '#374151'
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: isDarkMode ? '#94a3b8' : '#6b7280' }
                    },
                    y: {
                        ticks: { color: isDarkMode ? '#94a3b8' : '#6b7280' }
                    }
                }
            }
        });
    }
    
    if (revenueElement) {
        const revenueCtx = revenueElement.getContext('2d');
        const isDarkMode = document.documentElement.classList.contains('dark');
        
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: '{{ __("Revenue") }}',
                    data: [12000, 19000, 15000, 25000, 22000, 30000],
                    backgroundColor: [
                        'rgba(96, 0, 192, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(139, 92, 246, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(236, 72, 153, 0.8)'
                    ],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        ticks: { color: isDarkMode ? '#94a3b8' : '#6b7280' }
                    },
                    y: {
                        ticks: { 
                            color: isDarkMode ? '#94a3b8' : '#6b7280',
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endsection