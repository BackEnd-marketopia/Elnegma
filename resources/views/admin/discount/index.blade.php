@extends('admin.layouts.app')
@section('title', __('message.Discounts'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Admin') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Discounts') }}</span>
@endsection

@section('content')
    <div class="space-y-6 animate-fadeInUp">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('message.Discounts') }}
                </h1>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.vendors.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Back to Vendors') }}
                </a>
                <a href="{{ route('admin.discounts.create', $vendorId) }}"
                    class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-plus mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Add Discount') }}
                </a>  
            </div>
        </div>

        <!-- Discounts Table Card -->
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div
                class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                        <div class="flex items-center space-x-3 rtl:space-x-reverse">
                            <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                                <i class="fas fa-percent text-purple-600 dark:text-purple-400 text-xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ __('message.Discounts List') }}
                            </h3>
                        </div>
                        <form action="{{ route('admin.discounts.search', $vendorId) }}" method="GET">
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                                <div class="relative">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    </div>
                                    <input type="text" id="discountSearch" name="search" value="{{ request('search') }}"
                                        class="block w-full pr-10 pl-3 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent shadow-sm hover:shadow-md transition-all duration-200"
                                        placeholder="{{ __('message.Search in Discounts') }}...">
                                </div>
                                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                    <button id="testSearchBtn" type="submit"
                                        class="px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                        <i class="fas fa-search mr-2 rtl:ml-2 rtl:mr-0"></i>
                                        {{ __('message.Search') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table id="add-row" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-purple-600 to-purple-700">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-image mr-2"></i>
                                {{ __('message.Image') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-heading mr-2"></i>
                                {{ __('message.Title') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-align-left mr-2"></i>
                                {{ __('message.Description') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                {{ __('message.Start Date') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-calendar-times mr-2"></i>
                                {{ __('message.End Date') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-calendar-times mr-2"></i>
                                {{ __('message.View Count') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-users mr-2"></i>
                                {{ __('message.User Count Pending') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-user-check mr-2"></i>
                                {{ __('message.User Count Get Discount') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider">
                                <i class="fas fa-cogs mr-2"></i>
                                {{ __('message.Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($discounts as $discount)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center">
                                        <div class="w-16 h-16 rounded-xl overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-2 ring-gray-200 dark:ring-gray-600">
                                            @if($discount->image)
                                                <img src="{{ asset($discount->image) }}" 
                                                     alt="{{ $discount->title }}" 
                                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-200">
                                            @else
                                                <div class="flex items-center justify-center w-full h-full text-gray-400">
                                                    <i class="fas fa-percent text-2xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $discount->title }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="text-sm text-gray-600 dark:text-gray-300 max-w-xs mx-auto truncate">
                                        {{ Str::limit($discount->description, 50) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $discount->start_date }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $discount->end_date }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $discount->viwe_count }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $discount->discountChecks()->where('status', 'pending')->count() }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $discount->discountChecks()->where('status', 'accepted')->count() }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2 rtl:space-x-reverse">
                                        <a href="{{ route('admin.discounts.users.index', $discount->id) }}"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform hover:scale-105 transition-all duration-200 shadow-lg"
                                            data-bs-toggle="tooltip"
                                            title="{{ __('message.View Users') }}">
                                             <i class="fas fa-users"></i>
                                        </a>
                                        <a href="{{ route('admin.discounts.edit', [$discount->id, $vendorId]) }}"
                                           class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transform hover:scale-105 transition-all duration-200 shadow-lg"
                                           data-bs-toggle="tooltip" 
                                           title="{{ __('message.Edit Discount') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.discounts.destroy', [$discount->id, $vendorId]) }}"
                                              method="POST" 
                                              style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 delete-btn transform hover:scale-105 transition-all duration-200 shadow-lg"
                                                    data-bs-toggle="tooltip" 
                                                    title="{{ __('message.Delete Discount') }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>

                <!-- Pagination Section -->
                <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('message.Page') }}: {{ $discounts->currentPage() }} {{ __('message.of') }} {{ $discounts->lastPage() }}
                            <span class="mx-2">•</span>
                            {{ __('message.Total') }}: {{ $discounts->total() }} {{ __('message.discounts') }}
                        </div>
                        <div>
                            {{ $discounts->links() }}
                        </div>
                    </div>
                </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Discounts search script loaded'); // Debug log

        // إيقاف أي مستمعين للأحداث من admin-modern.js
        document.removeEventListener('click', function() {}, true);

        // Enhanced delete confirmation with better UX
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                const discountTitle = this.closest('tr').querySelector('td:nth-child(2) div');
                const discountTitleText = discountTitle ? discountTitle.textContent.trim() : 'هذا الخصم';

                Swal.fire({
                    title: '{{ __("message.Are you sure") }}?',
                    html: `{{ __("message.You will not be able to revert this") }}!<br><strong class="text-red-600">${discountTitleText}</strong>`,
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
                        // Add loading state
                        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                        this.disabled = true;

                        this.closest('form').submit();
                    }
                });
            });
        });

        // Initialize tooltips
        if (typeof bootstrap !== 'undefined') {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }
    });
    </script>
    @endpush
@endsection