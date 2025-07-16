@extends('admin.layouts.app')
@section('title', __('message.User Discount Details'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/detail-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Admin') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Discounts') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.User Discounts') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Details') }}</span>
@endsection

@section('content')
    <div class="space-y-6 animate-fadeInUp">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('message.User Discount Details') }}
                </h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('message.View user discount information') }}
                </p>
            </div>
            <div>
                <a href="{{ route('admin.discounts.users.index', $discountId) }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Back') }}
                </a>
                <a href="{{ route('admin.discounts.users.edit', [$discountCheck->id, $discountId]) }}"
                    class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105 ml-3 rtl:mr-3 rtl:ml-0">
                    <i class="fas fa-edit mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Edit') }}
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- User Information Card -->
            <div class="lg:col-span-2 space-y-6">
                <!-- User Details -->
                <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                            <i class="fas fa-user text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            User Information
                        </h3>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex items-start space-x-4 rtl:space-x-reverse">
                        <!-- User Avatar -->
                        <div class="flex-shrink-0">
                            <div class="w-20 h-20 rounded-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-4 ring-gray-200 dark:ring-gray-600 flex items-center justify-center">
                                @if($discountCheck->user->image)
                                    <img src="{{ asset($discountCheck->user->image) }}" 
                                         alt="{{ $discountCheck->user->name }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-user text-gray-400 text-2xl"></i>
                                @endif
                            </div>
                        </div>

                            <!-- User Details -->
                            <div class="flex-1 space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                            {{ __('message.Name') }}
                                        </label>
                                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                            {{ $discountCheck->user->name }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                            {{ __('message.Email') }}
                                        </label>
                                        <p class="text-lg text-gray-900 dark:text-white">
                                            {{ $discountCheck->user->email }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                            {{ __('message.Phone') }}
                                        </label>
                                        <p class="text-lg text-gray-900 dark:text-white">
                                            {{ $discountCheck->user->phone ?? '-' }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                            {{ __('message.User Type') }}
                                        </label>
                                        <p class="text-lg text-gray-900 dark:text-white capitalize">
                                            {{ $discountCheck->user->user_type ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Discount Details -->
                <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                            <i class="fas fa-percent text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ __('message.Discount Information') }}
                        </h3>
                    </div>
                </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    {{ __('message.Title') }}
                                </label>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ $discountCheck->discount->title }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    {{ __('message.Start Date') }}
                                </label>
                                <p class="text-lg text-gray-900 dark:text-white">
                                    {{ $discountCheck->discount->start_date }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    {{ __('message.End Date') }}
                                </label>
                                <p class="text-lg text-gray-900 dark:text-white">
                                    {{ $discountCheck->discount->end_date }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    {{ __('message.View Count') }}
                                </label>
                                <p class="text-lg text-gray-900 dark:text-white">
                                    {{ $discountCheck->discount->viwe_count ?? 0 }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                {{ __('message.Description') }}
                            </label>
                            <p class="text-gray-900 dark:text-white leading-relaxed">
                                {{ $discountCheck->discount->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Discount Check Details Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                            <i class="fas fa-toggle-on text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                            {{ __('message.Status') }}
                        </h3>
                    </div>
                </div>

                    <div class="p-6 text-center">
                        @if($discountCheck->status == 'pending')
                            <span class="inline-flex items-center px-6 py-3 rounded-full text-lg font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                <i class="fas fa-clock mr-2"></i>
                                {{ __('message.Pending') }}
                            </span>
                        @elseif($discountCheck->status == 'accepted')
                            <span class="inline-flex items-center px-6 py-3 rounded-full text-lg font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                <i class="fas fa-check mr-2"></i>
                                {{ __('message.Accepted') }}
                            </span>
                        @elseif($discountCheck->status == 'canceled')
                            <span class="inline-flex items-center px-6 py-3 rounded-full text-lg font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('message.Canceled') }}
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Pricing Information -->
                <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                            <i class="fas fa-dollar-sign text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                            {{ __('message.Pricing') }}
                        </h3>
                    </div>
                </div>

                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('message.Original Price') }}:</span>
                            <span class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $discountCheck->price ? number_format($discountCheck->price, 2) : '-' }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('message.Final Price') }}:</span>
                            <span class="text-lg font-semibold text-green-600 dark:text-green-400">
                                {{ $discountCheck->final_price ? number_format($discountCheck->final_price, 2) : '-' }}
                            </span>
                        </div>
                        @if($discountCheck->price && $discountCheck->final_price)
                            <div class="pt-3 border-t border-gray-200 dark:border-gray-600">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('message.Savings') }}:</span>
                                    <span class="text-lg font-semibold text-red-600 dark:text-red-400">
                                        {{ number_format($discountCheck->price - $discountCheck->final_price, 2) }}
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Comment -->
                @if($discountCheck->comment)
                <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                            <i class="fas fa-comment text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                            {{ __('message.Comment') }}
                        </h3>
                    </div>
                </div>

                    <div class="p-6">
                        <p class="text-gray-900 dark:text-white leading-relaxed">
                            {{ $discountCheck->comment }}
                        </p>
                    </div>
                </div>
                @endif

                <!-- Timestamps -->
                <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                            <i class="fas fa-clock text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                            {{ __('message.Timestamps') }}
                        </h3>
                    </div>
                </div>

                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                Created At
                            </label>
                            <p class="text-sm text-gray-900 dark:text-white">
                                {{ $discountCheck->created_at->format('M d, Y h:i A') }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                Updated At
                            </label>
                            <p class="text-sm text-gray-900 dark:text-white">
                                {{ $discountCheck->updated_at->format('M d, Y h:i A') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
