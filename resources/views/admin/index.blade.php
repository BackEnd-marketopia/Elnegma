@extends('admin.layouts.app')
@section('title', __('message.Dashboard'))
@section('page-title', __('message.Dashboard'))
@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Admin') }}</span>
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
                    {{ __('message.Welcome back! Here\'s what\'s happening with your platform.') }}
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.vendors.create') }}" 
                   class="btn-modern btn-primary">
                    <i class="fas fa-plus mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Add Vendor') }}
                </a>
            </div>
        </div>

        <!-- Main Stats Cards -->
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
                                +{{ number_format($usersThisMonth) }}
                            </span>
                                                        <span class="text-gray-500 dark:text-gray-400 text-xs ml-2 rtl:mr-2 rtl:ml-0">
                                {{ __('message.this month') }}
                            </span>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            {{ __('message.Active') }}: {{ number_format($activeUsers) }}
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
                                +{{ number_format($vendorsThisMonth) }}
                            </span>
                            <span class="text-gray-500 dark:text-gray-400 text-xs ml-2 rtl:mr-2 rtl:ml-0">
                                {{ __('message.this month') }}
                            </span>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            {{ __('message.Active') . ': ' }} {{ number_format($activeVendors) }} | {{ __('message.Pending') . ': ' }} {{ number_format($pendingVendors) }}
                        </div>
                    </div>
                    <div class="bg-primary-100 dark:bg-primary-900/30 p-3 rounded-xl">
                        <i class="fas fa-store text-2xl text-primary-600 dark:text-primary-400"></i>
                    </div>
                </div>
            </div>

            <!-- Discounts Card -->
            <div class="card-modern p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">
                            {{ __('message.Discounts') }}
                        </p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                            {{ number_format($totalDiscounts) }}
                        </p>
                        <div class="flex items-center mt-2">
                            <span class="text-blue-500 text-sm font-medium">
                                <i class="fas fa-clock mr-1"></i>
                                {{ number_format($activeDiscounts) }}
                            </span>
                            <span class="text-gray-500 dark:text-gray-400 text-xs ml-2 rtl:mr-2 rtl:ml-0">
                                {{ __('message.Active') }}
                            </span>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            {{ __('message.Views') . ': ' }} {{ number_format($totalDiscountViews) }}
                        </div>
                    </div>
                    <div class="bg-primary-100 dark:bg-primary-900/30 p-3 rounded-xl">
                        <i class="fas fa-percentage text-2xl text-primary-600 dark:text-primary-400"></i>
                    </div>
                </div>
            </div>

            <!-- Discount Requests Card -->
            <div class="card-modern p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">
                            {{ __('message.Discount Requests') }}
                        </p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">
                            {{ number_format($totalDiscountRequests) }}
                        </p>
                        <div class="flex items-center mt-2">
                            <span class="text-orange-500 text-sm font-medium">
                                <i class="fas fa-hourglass-half mr-1"></i>
                                {{ number_format($pendingDiscountRequests) }}
                            </span>
                            <span class="text-gray-500 dark:text-gray-400 text-xs ml-2 rtl:mr-2 rtl:ml-0">
                                {{ __('message.Pending') }}
                            </span>
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            {{ __('message.Accepted') . ': '}} {{ number_format($acceptedDiscountRequests) }}
                        </div>
                    </div>
                    <div class="bg-primary-100 dark:bg-primary-900/30 p-3 rounded-xl">
                        <i class="fas fa-clipboard-check text-2xl text-primary-600 dark:text-primary-400"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secondary Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Vendor Stores Status -->
            <div class="card-modern p-6">
                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('message.Vendor Stores') }}
                </h3>
                    <div class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-lg">
                        <i class="fas fa-store-alt text-blue-600 dark:text-blue-400"></i>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('message.Accepted') }}</span>
                        <span class="text-lg font-bold text-green-600">{{ number_format($acceptedVendors) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('message.Pending') }}</span>
                        <span class="text-lg font-bold text-orange-600">{{ number_format($pendingVendorsStore) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('message.Rejected') }}</span>
                        <span class="text-lg font-bold text-red-600">{{ number_format($rejectedVendors) }}</span>
                    </div>
                </div>
            </div>

            <!-- Discount Status -->
            <div class="card-modern p-6">
                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('message.Discount Status') }}
                </h3>
                    <div class="bg-purple-100 dark:bg-purple-900/30 p-2 rounded-lg">
                        <i class="fas fa-chart-pie text-purple-600 dark:text-purple-400"></i>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('message.Active') }}</span>
                        <span class="text-lg font-bold text-green-600">{{ number_format($activeDiscounts) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('message.Upcoming') }}</span>
                        <span class="text-lg font-bold text-blue-600">{{ number_format($upcomingDiscounts) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('message.Expired') }}</span>
                        <span class="text-lg font-bold text-gray-600">{{ number_format($expiredDiscounts) }}</span>
                    </div>
                </div>
            </div>

            <!-- Platform Content -->
            <div class="card-modern p-6">
                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('message.Platform Content') }}
                </h3>
                    <div class="bg-green-100 dark:bg-green-900/30 p-2 rounded-lg">
                        <i class="fas fa-layer-group text-green-600 dark:text-green-400"></i>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('message.Categories') }}</span>
                        <span class="text-lg font-bold text-primary-600">{{ number_format($totalCategories) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('message.Cities') }}</span>
                        <span class="text-lg font-bold text-primary-600">{{ number_format($totalCities) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('message.Banners') }}</span>
                        <span class="text-lg font-bold text-primary-600">{{ number_format($totalBanners) }}</span>
                    </div>
                </div>
            </div>

            <!-- Advertisements -->
            <div class="card-modern p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ __('message.Advertisements') }}
                    </h3>
                    <div class="bg-red-100 dark:bg-red-900/30 p-2 rounded-lg">
                        <i class="fas fa-bullhorn text-red-600 dark:text-red-400"></i>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('message.Total Ads') }}</span>
                        <span class="text-lg font-bold text-primary-600">{{ number_format($totalAds) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('message.Views') }}</span>
                        <span class="text-lg font-bold text-blue-600">{{ number_format($totalAdsViews) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ __('message.Clicks') }}</span>
                        <span class="text-lg font-bold text-green-600">{{ number_format($totalAdsClicks) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Activity Statistics Chart -->
            <div class="card-modern p-6">
                <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('message.Activity Statistics') }}
                </h3>
                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                        <button id="chart-7d" class="chart-period-btn text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 px-3 py-1 rounded-lg hover:bg-gray-100 dark:hover:bg-dark-700">
                            7D
                        </button>
                        <button id="chart-30d" class="chart-period-btn text-sm bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 px-3 py-1 rounded-lg">
                            30D
                        </button>
                        <button id="chart-90d" class="chart-period-btn text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 px-3 py-1 rounded-lg hover:bg-gray-100 dark:hover:bg-dark-700">
                            90D
                        </button>
                    </div>
                </div>
                <div class="h-80">
                    <canvas id="activityChart" class="w-full h-full"></canvas>
                </div>
            </div>

            <!-- Top Vendors -->
            <div class="card-modern p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ __('message.Top Vendors') }}
                    </h3>
                    <a href="{{ route('admin.vendors.index') }}" class="text-sm text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                        {{ __('message.View All') }}
                    </a>
                </div>
                <div class="space-y-4">
                    @forelse($topVendors as $index => $vendor)
                        <div class="flex items-center space-x-4 rtl:space-x-reverse p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-dark-700 transition-colors">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                                    <span class="text-sm font-bold text-primary-600 dark:text-primary-400">
                                        #{{ $index + 1 }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                    {{ $vendor->name ?? $vendor->vendor_name }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ number_format($vendor->discounts_count) }} {{ __('message.Discounts') }}
                                </p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $vendor->status === 'accepted' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400' }}">
                                    {{ ucfirst($vendor->status) }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="fas fa-store text-4xl text-gray-400 dark:text-gray-600 mb-3"></i>
                            <p class="text-gray-500 dark:text-gray-400">{{ __('message.No vendors found') }}</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="card-modern">
            <div class="p-6 border-b border-gray-200 dark:border-dark-600">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ __('message.Recent Activity') }}
                    </h3>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-6">
                    <!-- Recent Discount Requests -->
                    @if($recentRequests->count() > 0)
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">{{ __('message.Recent Discount Requests') }}</h4>
                            <div class="space-y-3">
                                @foreach($recentRequests->take(3) as $request)
                                    <div class="flex items-start space-x-4 rtl:space-x-reverse">
                                        <div class="bg-{{ $request->status === 'accepted' ? 'green' : ($request->status === 'pending' ? 'orange' : 'red') }}-100 dark:bg-{{ $request->status === 'accepted' ? 'green' : ($request->status === 'pending' ? 'orange' : 'red') }}-900/30 p-2 rounded-lg">
                                            <i class="fas fa-{{ $request->status === 'accepted' ? 'check' : ($request->status === 'pending' ? 'clock' : 'times') }} text-{{ $request->status === 'accepted' ? 'green' : ($request->status === 'pending' ? 'orange' : 'red') }}-600 dark:text-{{ $request->status === 'accepted' ? 'green' : ($request->status === 'pending' ? 'orange' : 'red') }}-400"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-gray-900 dark:text-white">
                                                {{ $request->user->name ?? 'Unknown User' }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ __('message.Requested discount from') }} {{ $request->discount->vendor->name ?? 'Unknown Vendor' }}
                                            </p>
                                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                                {{ $request->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $request->status === 'accepted' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : ($request->status === 'pending' ? 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400') }}">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Recent Vendors -->
                    @if($recentVendors->count() > 0)
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">{{ __('message.New Vendors') }}</h4>
                            <div class="space-y-3">
                                @foreach($recentVendors->take(3) as $vendor)
                                    <div class="flex items-start space-x-4 rtl:space-x-reverse">
                                        <div class="bg-primary-100 dark:bg-primary-900/30 p-2 rounded-lg">
                                            <i class="fas fa-store text-primary-600 dark:text-primary-400"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-gray-900 dark:text-white">
                                                {{ $vendor->name }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ __('message.New vendor registered') }}
                                            </p>
                                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                                {{ $vendor->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Recent Users -->
                    @if($recentUsers->count() > 0)
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">{{ __('message.New Users') }}</h4>
                            <div class="space-y-3">
                                @foreach($recentUsers->take(2) as $user)
                                    <div class="flex items-start space-x-4 rtl:space-x-reverse">
                                        <div class="bg-blue-100 dark:bg-blue-900/30 p-2 rounded-lg">
                                            <i class="fas fa-user-plus text-blue-600 dark:text-blue-400"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-gray-900 dark:text-white">
                                                {{ $user->name }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ __('message.New user joined the platform') }}
                                            </p>
                                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                                {{ $user->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Chart.js for enhanced charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if elements exist before creating charts
        const activityChartElement = document.getElementById('activityChart');
        let activityChart = null;

        // Prepare all data periods
        const chartData = {
            '7d': @json($last7Days),
            '30d': @json($last30Days),
            '90d': @json($last90Days)
        };

        // Function to update chart
        function updateChart(period) {
            if (!activityChartElement || !chartData[period]) return;

            const isDarkMode = document.documentElement.classList.contains('dark');
            const data = chartData[period];
            
            const labels = data.map(item => item.day);
            const usersData = data.map(item => item.users);
            const vendorsData = data.map(item => item.vendors);
            const discountsData = data.map(item => item.discounts);
            const requestsData = data.map(item => item.requests);

            // Destroy existing chart
            if (activityChart) {
                activityChart.destroy();
            }

            const activityCtx = activityChartElement.getContext('2d');
            
            activityChart = new Chart(activityCtx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: '{{ __("message.Users") }}',
                            data: usersData,
                            borderColor: '#6000C0',
                            backgroundColor: 'rgba(96, 0, 192, 0.1)',
                            borderWidth: 3,
                            fill: false,
                            tension: 0.4
                        },
                        {
                            label: '{{ __("message.Vendors") }}',
                            data: vendorsData,
                            borderColor: '#10B981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            borderWidth: 3,
                            fill: false,
                            tension: 0.4
                        },
                        {
                            label: '{{ __("message.Discounts") }}',
                            data: discountsData,
                            borderColor: '#F59E0B',
                            backgroundColor: 'rgba(245, 158, 11, 0.1)',
                            borderWidth: 3,
                            fill: false,
                            tension: 0.4
                        },
                        {
                            label: '{{ __("message.Requests") }}',
                            data: requestsData,
                            borderColor: '#EF4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            borderWidth: 3,
                            fill: false,
                            tension: 0.4
                        }
                    ]
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
                            ticks: { 
                                color: isDarkMode ? '#94a3b8' : '#6b7280',
                                maxTicksLimit: period === '90d' ? 8 : (period === '30d' ? 10 : 7)
                            }
                        },
                        y: {
                            ticks: { color: isDarkMode ? '#94a3b8' : '#6b7280' }
                        }
                    }
                }
            });
        }

        // Function to update button styles
        function updateButtonStyles(activeButton) {
            const buttons = document.querySelectorAll('.chart-period-btn');
            buttons.forEach(btn => {
                btn.className = 'chart-period-btn text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 px-3 py-1 rounded-lg hover:bg-gray-100 dark:hover:bg-dark-700';
            });
            activeButton.className = 'chart-period-btn text-sm bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 px-3 py-1 rounded-lg';
        }

        // Add event listeners for chart period buttons
        const chart7dBtn = document.getElementById('chart-7d');
        const chart30dBtn = document.getElementById('chart-30d');
        const chart90dBtn = document.getElementById('chart-90d');

        if (chart7dBtn) {
            chart7dBtn.addEventListener('click', function() {
                updateChart('7d');
                updateButtonStyles(this);
            });
        }

        if (chart30dBtn) {
            chart30dBtn.addEventListener('click', function() {
                updateChart('30d');
                updateButtonStyles(this);
            });
        }

        if (chart90dBtn) {
            chart90dBtn.addEventListener('click', function() {
                updateChart('90d');
                updateButtonStyles(this);
            });
        }

        // Initialize with 30d data by default
        if (activityChartElement) {
            updateChart('30d');
        }
    });
    </script>
@endsection