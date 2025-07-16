@extends('admin.layouts.app')
@section('title', __('message.User Discounts'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Admin') }}</span>
    <span class="mx-2">/</span>
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Vendors') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Discounts') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.User Discounts') }}</span>
@endsection

@section('content')
    <div class="space-y-6 animate-fadeInUp">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('message.User Discounts') }}
                </h1>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.discounts.users.create', $discountId) }}"
                    class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-plus mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Add User Discount') }}
                </a>
            </div>
        </div>

        <!-- User Discounts Table Card -->
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                            <i class="fas fa-users text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ __('message.User Discounts List') }}
                        </h3>
                    </div>
                    <form action="{{ route('admin.discounts.users.search', $discountId) }}" method="GET">
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                            <div class="relative">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                </div>
                                <input type="text" id="userSearch" name="search" value="{{ request('search') }}"
                                    class="block w-full pr-10 pl-3 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent shadow-sm hover:shadow-md transition-all duration-200"
                                    placeholder="{{ __('message.Search in Users') }}...">
                            </div>
                            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                <button id="searchBtn" type="submit"
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
                <table id="user-discounts-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-purple-600 to-purple-700">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-user mr-2"></i>
                                {{ __('message.User') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-envelope mr-2"></i>
                                {{ __('message.Email') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-phone mr-2"></i>
                                {{ __('message.Phone') }}
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
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider">
                                <i class="fas fa-cogs mr-2"></i>
                                {{ __('message.Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($users as $user)
                            @php
    $discountCheck = $user->discountChecks()->where('discount_id', $discountId)->first();
                            @endphp
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-2 ring-gray-200 dark:ring-gray-600 mr-3 rtl:ml-3 rtl:mr-0">
                                            @if($user->image)
                                                <img src="{{ asset($user->image) }}" 
                                                     alt="{{ $user->name }}" 
                                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-200">
                                            @else
                                                <div class="flex items-center justify-center w-full h-full text-gray-400">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $user->name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $user->email ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $user->phone ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="text-sm text-gray-600 dark:text-gray-300 max-w-xs mx-auto truncate">
                                        {{ $discountCheck->comment ? Str::limit($discountCheck->comment, 30) : '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $discountCheck && $discountCheck->price ? number_format($discountCheck->price, 2) : '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $discountCheck && $discountCheck->final_price ? number_format($discountCheck->final_price, 2) : '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($discountCheck)
                                        @if($discountCheck->status == 'pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                                <i class="fas fa-clock mr-1 rtl:ml-1 rtl:mr-0"></i>
                                                {{ __('message.Pending') }}
                                            </span>
                                        @elseif($discountCheck->status == 'accepted')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                                <i class="fas fa-check mr-1 rtl:ml-1 rtl:mr-0"></i>
                                                {{ __('message.Accepted') }}
                                            </span>
                                        @elseif($discountCheck->status == 'canceled')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                                <i class="fas fa-times mr-1 rtl:ml-1 rtl:mr-0"></i>
                                                {{ __('message.Canceled') }}
                                            </span>
                                        @endif
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($discountCheck)
                                        <div class="flex items-center justify-center space-x-2 rtl:space-x-reverse">
                                            <a href="{{ route('admin.discounts.users.edit', [$discountCheck->id, $discountId]) }}"
                                               class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transform hover:scale-105 transition-all duration-200 shadow-lg"
                                               data-bs-toggle="tooltip" 
                                               title="{{ __('message.Edit User Discount') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.discounts.users.destroy', [$discountCheck->id, $discountId]) }}"
                                                  method="POST" 
                                                  style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 delete-btn transform hover:scale-105 transition-all duration-200 shadow-lg"
                                                        data-bs-toggle="tooltip" 
                                                        title="{{ __('message.Delete User Discount') }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-12 text-center">
                                    <div class="text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-percentage text-4xl mb-4 text-purple-400"></i>
                                        <p class="text-lg font-medium">{{ __('message.No user discounts found') }}</p>
                                        <p class="text-sm mt-2">{{ __('message.Try adjusting your search criteria') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination Section -->
                <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('message.Page') }}: {{ $users->currentPage() }} {{ __('message.of') }} {{ $users->lastPage() }}
                            <span class="mx-2">•</span>
                            {{ __('message.Total') }}: {{ $users->total() }} {{ __('message.users') }}
                        </div>
                        <div>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('User discounts search script loaded'); // Debug log

        // إيقاف أي مستمعين للأحداث من admin-modern.js
        document.removeEventListener('click', function() {}, true);

        // Enhanced delete confirmation with better UX
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                const userName = this.closest('tr').querySelector('td:nth-child(1) .text-sm.font-medium');
                const userNameText = userName ? userName.textContent.trim() : 'هذا المستخدم';

                Swal.fire({
                    title: '{{ __("message.Are you sure") }}?',
                    html: '{{ __("message.You will not be able to revert this") }}!<br><strong class="text-red-600">' + userNameText + '</strong>',
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