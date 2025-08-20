@extends('admin.layouts.app')
@section('title', __('message.Edit User Discount'))

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
    <span class="text-primary-600 dark:text-primary-400">
        <a href="{{ route('admin.users.discounts', $user->id) }}" class="hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            {{ __('message.User Discounts') }}
        </a>
    </span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Edit User Discount') }}</span>
@endsection

@section('content')
    <div class="space-y-6 animate-fadeInUp">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul class="mt-1 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('message.Edit User Discount') }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    {{ __('message.Update user discount details') }}
                </p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.users.discounts', $user->id) }}" 
                   class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0 rtl:rotate-180"></i>
                    {{ __('message.Back to User Discounts') }}
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
                </div>
            </div>
        </div>

        <!-- Discount Info Card -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">
                <i class="fas fa-tag mr-2"></i>
                {{ __('message.Discount Information') }}
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('message.Vendor') }}</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $discountCheck->discount->vendor->name ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('message.Discount Title') }}</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $discountCheck->discount->title ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('message.Created At') }}</label>
                    <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $discountCheck->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>
        </div>

        <!-- Edit Form Card -->
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center space-x-3 rtl:space-x-reverse">
                    <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                        <i class="fas fa-edit text-purple-600 dark:text-purple-400 text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ __('message.Edit Discount Details') }}
                    </h3>
                </div>
            </div>

            <form action="{{ route('admin.users.discounts.update', [$user->id, $discountCheck->id]) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Comment -->
                    <div class="md:col-span-2">
                        <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-comment mr-2"></i>
                            {{ __('message.Comment') }}
                        </label>
                        <textarea id="comment" name="comment" rows="3"
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="{{ __('message.Enter comment') }}">{{ old('comment', $discountCheck->comment) }}</textarea>
                        @error('comment')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-dollar-sign mr-2"></i>
                            {{ __('message.Price') }}
                        </label>
                        <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $discountCheck->price) }}"
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="0.00">
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Final Price -->
                    <div>
                        <label for="final_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-money-bill mr-2"></i>
                            {{ __('message.Final Price') }}
                        </label>
                        <input type="number" step="0.01" id="final_price" name="final_price" value="{{ old('final_price', $discountCheck->final_price) }}"
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="0.00">
                        @error('final_price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Discount Value -->
                    <div>
                        <label for="discount_value" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-percent mr-2"></i>
                            {{ __('message.Discount Value') }}
                        </label>
                        <input type="number" step="0.01" id="discount_value" name="discount_value" value="{{ old('discount_value', $discountCheck->discount_value) }}"
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="0.00">
                        @error('discount_value')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-toggle-on mr-2"></i>
                            {{ __('message.Status') }}
                        </label>
                        <select id="status" name="status" required
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="pending" {{ old('status', $discountCheck->status) == 'pending' ? 'selected' : '' }}>
                                {{ __('message.Pending') }}
                            </option>
                            <option value="accepted" {{ old('status', $discountCheck->status) == 'accepted' ? 'selected' : '' }}>
                                {{ __('message.Accepted') }}
                            </option>
                            <option value="cancelled" {{ old('status', $discountCheck->status) == 'cancelled' ? 'selected' : '' }}>
                                {{ __('message.Canceled') }}
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-3 rtl:space-x-reverse mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.users.discounts', $user->id) }}" 
                       class="px-6 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-200">
                        {{ __('message.Cancel') }}
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200 shadow-lg transform hover:scale-105">
                        <i class="fas fa-save mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Update Discount') }}
                    </button>
                </div>
            </form>
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
