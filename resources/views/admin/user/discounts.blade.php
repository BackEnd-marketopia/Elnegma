@extends('admin.layouts.app')
@section('title', __('message.User Discounts'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Dashboard') }}</span>
    <span class="mx-2">/</span>
    <span class="text-primary-600 dark:text-primary-400">
        <a href="{{ route('admin.users.index') }}" class="hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            {{ __('message.Users') }}
        </a>
    </span>
    <span class="mx-2">/</span>
    <span>{{ __('message.User Discounts') }} - {{ $user->name }}</span>
@endsection

@section('content')
    <div class="space-y-6 animate-fadeInUp">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('message.User Discounts') }} - {{ $user->name }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    {{ __('message.All discounts used by this user') }}
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.users.index') }}" 
                   class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0 rtl:rotate-180"></i>
                    {{ __('message.Back to Users') }}
                </a>
            </div>
        </div>

        <!-- User Info Card -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                <div class="w-16 h-16 rounded-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-2 ring-gray-200 dark:ring-gray-600">
                    @if($user->image)
                        <img src="{{ asset($user->image) }}" 
                             alt="{{ $user->name }}" 
                             class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center w-full h-full text-gray-400">
                            <i class="fas fa-user text-2xl"></i>
                        </div>
                    @endif
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $user->email ?? $user->phone }}</p>
                    <div class="flex items-center mt-2">
                        @if($user->status == 'active')
                            <span class="badge badge-success">
                                <i class="fas fa-check-circle mr-1"></i>
                                {{ __('message.Active') }}
                            </span>
                        @else
                            <span class="badge badge-danger">
                                <i class="fas fa-times-circle mr-1"></i>
                                {{ __('message.Inactive') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Discounts Table Card -->
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                            <i class="fas fa-percent text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ __('message.User Discounts List') }}
                        </h3>
                    </div>
                    <form action="{{ route('admin.users.discounts.search', $user->id) }}" method="GET">
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                            <div class="relative">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                </div>
                                <input type="text" id="discountSearch" name="search" value="{{ request('search') }}"
                                    class="block w-full pr-10 pl-3 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent shadow-sm hover:shadow-md transition-all duration-200"
                                    placeholder="{{ __('message.Search in User Discounts') }}...">
                            </div>
                            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                <button id="searchBtn" type="submit"
                                    class="px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <i class="fas fa-search mr-2 rtl:ml-2 rtl:mr-0"></i>
                                    {{ __('message.Search') }}
                                </button>
                                @if(request('search'))
                                    <a href="{{ route('admin.users.discounts', $user->id) }}"
                                        class="px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                        <i class="fas fa-times mr-2 rtl:ml-2 rtl:mr-0"></i>
                                        {{ __('message.Clear') }}
                                    </a>
                                @endif
                                <a href="{{ route('admin.users.discounts.export', $user->id) }}"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                                    <i class="fas fa-file-excel mr-2 rtl:ml-2 rtl:mr-0"></i>
                                    {{ __('message.Export Excel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-purple-600 to-purple-700">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-store mr-2"></i>
                                {{ __('message.Vendor') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-tag mr-2"></i>
                                {{ __('message.Discount Title') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-percent mr-2"></i>
                                {{ __('message.Discount Value') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-comment mr-2"></i>
                                {{ __('message.Comment') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-dollar-sign mr-2"></i>
                                {{ __('message.Price') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-money-bill mr-2"></i>
                                {{ __('message.Final Price') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-toggle-on mr-2"></i>
                                {{ __('message.Status') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-calendar mr-2"></i>
                                {{ __('message.Date') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider">
                                <i class="fas fa-cogs mr-2"></i>
                                {{ __('message.Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($discountChecks as $check)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($check->discount && $check->discount->vendor)
                                            <div class="w-10 h-10 rounded-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-2 ring-gray-200 dark:ring-gray-600 mr-3 rtl:ml-3 rtl:mr-0">
                                                @if($check->discount->vendor->user && $check->discount->vendor->user->image)
                                                    <img src="{{ asset($check->discount->vendor->user->image) }}" 
                                                         alt="{{ $check->discount->vendor->name }}" 
                                                         class="w-full h-full object-cover">
                                                @else
                                                    <div class="flex items-center justify-center w-full h-full text-gray-400">
                                                        <i class="fas fa-store"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $check->discount->vendor->name }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $check->discount->vendor->description_en ? Str::limit($check->discount->vendor->description_en, 30) : ($check->discount->vendor->description_ar ? Str::limit($check->discount->vendor->description_ar, 30) : '-') }}
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-gray-400">{{ __('message.Vendor not found') }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white font-medium">
                                        {{ $check->discount->title ?? '-' }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $check->discount->description ? Str::limit($check->discount->description, 40) : '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($check->discount_value && $check->discount_value > 0)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                            {{ number_format($check->discount_value, 2) }} {{ __('message.currency') }}
                                        </span>
                                    @elseif($check->discount_value === '0.00' || $check->discount_value === 0)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300">
                                            0.00 {{ __('message.currency') }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">
                                            -
                                            <!-- Debug: {{ $check->discount_value ?? 'NULL' }} -->
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="text-sm text-gray-600 dark:text-gray-300 max-w-xs mx-auto">
                                        {{ $check->comment ? Str::limit($check->comment, 50) : '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white font-medium">
                                        {{ $check->price ? number_format($check->price, 2) : '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white font-medium">
                                        {{ $check->final_price ? number_format($check->final_price, 2) : '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($check->status == 'pending')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                            <i class="fas fa-clock mr-1 rtl:ml-1 rtl:mr-0"></i>
                                            {{ __('message.Pending') }}
                                        </span>
                                    @elseif($check->status == 'accepted')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            <i class="fas fa-check mr-1 rtl:ml-1 rtl:mr-0"></i>
                                            {{ __('message.Accepted') }}
                                        </span>
                                    @elseif($check->status == 'cancelled')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                            <i class="fas fa-times mr-1 rtl:ml-1 rtl:mr-0"></i>
                                            {{ __('message.Canceled') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $check->created_at->format('Y-m-d') }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $check->created_at->format('H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2 rtl:space-x-reverse">
                                        <a href="{{ route('admin.users.discounts.edit', [$user->id, $check->id]) }}"
                                           class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transform hover:scale-105 transition-all duration-200 shadow-lg"
                                           data-bs-toggle="tooltip" 
                                           title="{{ __('message.Edit User Discount') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.users.discounts.destroy', [$user->id, $check->id]) }}"
                                              method="POST" 
                                              style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 delete-btn transform hover:scale-105 transition-all duration-200 shadow-lg"
                                                    data-bs-toggle="tooltip" 
                                                    title="{{ __('message.Delete User Discount') }}"
                                                    onclick="return confirm('{{ __('message.Are you sure you want to delete this discount?') }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-percent text-4xl text-gray-400 dark:text-gray-500"></i>
                                        </div>
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                                            {{ __('message.No Discounts Found') }}
                                        </h3>
                                        <p class="text-gray-500 dark:text-gray-400">
                                            {{ __('message.This user has not used any discounts yet') }}
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            @if($discountChecks->count() > 0)
                <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('message.Page') }}: {{ $discountChecks->currentPage() }} {{ __('message.of') }} {{ $discountChecks->lastPage() }}
                            <span class="mx-2">•</span>
                            {{ __('Total') }}: {{ $discountChecks->total() }} {{ __('discounts') }}
                        </div>
                        <div>
                            {{ $discountChecks->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
