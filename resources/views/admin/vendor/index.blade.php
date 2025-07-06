@extends('admin.layouts.app')
@section('title', __('message.Vendors'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Admin') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Vendors') }}</span>
@endsection

@section('content')
        <div class="space-y-6 animate-fadeInUp">
            <!-- Header Section -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ __('message.Vendors') }}
                    </h1>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('admin.vendors.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                        <i class="fas fa-plus mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Add Vendor') }}
                    </a>  
                </div>
            </div>

            <!-- Vendors Table Card -->
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                        <div class="flex items-center space-x-3 rtl:space-x-reverse">
                            <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                                <i class="fas fa-store text-purple-600 dark:text-purple-400 text-xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                {{ __('message.Vendors List') }}
                            </h3>
                        </div>
                        <form action="{{ route('admin.vendors.search') }}" method="GET">
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                                <div class="relative">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    </div>
                                    <input type="text" id="citySearch" name="search" value="{{ request('search') }}"
                                        class="block w-full pr-10 pl-3 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent shadow-sm hover:shadow-md transition-all duration-200"
                                        placeholder="{{ __('message.Search in vendors') }}...">
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
                                    <i class="fas fa-store mr-2"></i>
                                    {{ __('message.Name') }}
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
                                    <i class="fas fa-tags mr-2"></i>
                                    {{ __('message.Category') }}
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
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 rounded-lg overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-2 ring-gray-200 dark:ring-gray-600 mr-3 rtl:ml-3 rtl:mr-0">
                                                @if($user->vendor?->logo)
                                                    <img src="{{ asset($user->vendor->logo) }}" 
                                                         alt="{{ $user->vendor?->name }}" 
                                                         title="{{ __('message.Logo') }}"
                                                         class="w-full h-full hover:scale-105 transition-transform duration-200">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <i class="fas fa-store text-2xl text-gray-400 dark:text-gray-500"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="text-lg font-bold text-gray-900 dark:text-white">
                                                    {{ Str::limit($user->vendor?->name, 30) }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-md text-gray-600 dark:text-gray-400">
                                            {{ Str::limit($user->email, 30) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="text-md text-gray-600 dark:text-gray-400">
                                            {{ Str::limit($user->phone, 15) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($user->vendor?->category)
                                            <div class="inline-flex items-center px-3 py-1 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 text-sm font-medium">
                                                <i class="fas fa-tag mr-1.5 rtl:ml-1.5 rtl:mr-0"></i>
                                                {{ app()->getLocale() == 'ar' ? $user->vendor?->category?->name_arabic : $user->vendor?->category?->name_english }}
                                            </div>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs">
                                                <i class="fas fa-exclamation-circle mr-1"></i>
                                                {{ __('message.No Category') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if($user->vendor?->status == 'accepted')
                                            <span class="px-3 py-1 inline-flex items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-sm font-medium">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                {{ __('message.Accepted') }}
                                            </span>
                                        @elseif($user->vendor?->status == 'pending')
                                            <span class="px-3 py-1 inline-flex items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 text-sm font-medium">
                                                <i class="fas fa-clock mr-1"></i>
                                                {{ __('message.Pending') }}
                                            </span>
                                        @else
                                            <span class="px-3 py-1 inline-flex items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-sm font-medium">
                                                <i class="fas fa-times-circle mr-1"></i>
                                                {{ __('message.Rejected') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center space-x-3 rtl:space-x-reverse">
                                            <a href="{{ route('admin.vendors.edit', $user->id) }}"
                                               class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transform hover:scale-105 transition-all duration-200 shadow-lg"
                                               data-bs-toggle="tooltip" 
                                               title="{{ __('message.Edit Vendor') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.vendors.destroy', $user->id) }}"
                                                  method="POST" 
                                                  style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 delete-btn transform hover:scale-105 transition-all duration-200 shadow-lg"
                                                        data-bs-toggle="tooltip" 
                                                        title="{{ __('message.Delete Vendor') }}">
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
                            {{ __('message.Page') }}: {{ $users->currentPage() }} {{ __('message.of') }} {{ $users->lastPage() }}
                            <span class="mx-2">•</span>
                            {{ __('Total') }}: {{ $users->total() }} {{ __('vendors') }}
                        </div>
                        <div>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Vendors search script loaded'); // Debug log

        // إيقاف أي مستمعين للأحداث من admin-modern.js
        document.removeEventListener('click', function() {}, true);

        // Enhanced search functionality with debouncing
        const searchInput = document.getElementById('vendorSearch');
        const tableRows = document.querySelectorAll('#add-row tbody tr');
        const testSearchBtn = document.getElementById('testSearchBtn');
        let searchTimeout;

        console.log('Found elements:', {
            searchInput: !!searchInput,
            tableRows: tableRows.length,
            testSearchBtn: !!testSearchBtn
        });

        // حماية من التضارب مع admin-modern.js
        if (searchInput) {
            // إزالة أي مستمعين سابقين
            searchInput.removeAttribute('onclick');
            const newSearchInput = searchInput.cloneNode(true);
            searchInput.parentNode.replaceChild(newSearchInput, searchInput);

            // إعادة تعيين المرجع
            const finalSearchInput = document.getElementById('vendorSearch');

            console.log('Search input cleaned and ready');

            // Add visual feedback
            finalSearchInput.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-purple-500');
                console.log('Search input focused');
            });

            finalSearchInput.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-purple-500');
                console.log('Search input blurred');
            });

            finalSearchInput.addEventListener('input', function(e) {
                e.stopPropagation(); // منع التضارب مع admin-modern.js
                clearTimeout(searchTimeout);
                const searchTerm = this.value.toLowerCase().trim();

                console.log('Search triggered with term:', searchTerm);

                // Show loading state
                const searchIcon = this.parentElement.querySelector('i');
                if (searchIcon) {
                    searchIcon.className = 'fas fa-spinner fa-spin text-gray-400';
                }

                searchTimeout = setTimeout(() => {
                    let visibleCount = 0;
                    let hiddenCount = 0;

                    console.log('Processing search for:', searchTerm);
                    console.log('Total rows to process:', tableRows.length);

                    tableRows.forEach((row, index) => {
                        // Get text content from Name column (1st column), Email (2nd column), and Phone (3rd column)
                        const nameCell = row.querySelector('td:nth-child(1) p');
                        const emailCell = row.querySelector('td:nth-child(2) div');
                        const phoneCell = row.querySelector('td:nth-child(3) div');

                        const name = nameCell ? nameCell.textContent.toLowerCase().trim() : '';
                        const email = emailCell ? emailCell.textContent.toLowerCase().trim() : '';
                        const phone = phoneCell ? phoneCell.textContent.toLowerCase().trim() : '';

                        console.log(`Row ${index + 1}:`, { name, email, phone });

                        const shouldShow = searchTerm === '' || 
                                         name.includes(searchTerm) || 
                                         email.includes(searchTerm) || 
                                         phone.includes(searchTerm);

                        if (shouldShow) {
                            row.style.display = 'table-row';
                            row.style.visibility = 'visible';
                            row.classList.add('animate-fadeIn');
                            visibleCount++;
                            console.log(`Showing row ${index + 1}`);
                        } else {
                            row.style.display = 'none';
                            row.style.visibility = 'hidden';
                            row.classList.remove('animate-fadeIn');
                            hiddenCount++;
                            console.log(`Hiding row ${index + 1}`);
                        }
                    });

                    // Reset search icon
                    if (searchIcon) {
                        searchIcon.className = 'fas fa-search text-gray-400';
                    }

                    console.log(`Search complete - Visible: ${visibleCount}, Hidden: ${hiddenCount}`);

                    // Show/hide no results message
                    updateNoResultsMessage(visibleCount === 0 && searchTerm !== '');
                }, 100); // تقليل الوقت للاستجابة السريعة
            }, true); // استخدام capture phase
        }

        // Add no results message
        function updateNoResultsMessage(show) {
            let noResultsRow = document.getElementById('no-results-row');

            if (show && !noResultsRow) {
                const tbody = document.querySelector('#add-row tbody');
                noResultsRow = document.createElement('tr');
                noResultsRow.id = 'no-results-row';
                noResultsRow.innerHTML = `
                    <td colspan="5" class="text-center py-12">
                        <div class="flex flex-col items-center justify-center space-y-4">
                            <i class="fas fa-search text-6xl text-gray-400"></i>
                            <p class="text-gray-600 dark:text-gray-400 text-xl font-medium">{{ __('message.No users found') }}</p>
                            <p class="text-gray-500 dark:text-gray-500 text-lg">{{ __('message.Try adjusting your search criteria') }}</p>
                        </div>
                    </td>
                `;
                tbody.appendChild(noResultsRow);
            } else if (!show && noResultsRow) {
                noResultsRow.remove();
            }
        }

        // Enhanced delete confirmation with better UX
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                const vendorName = this.closest('tr').querySelector('td:nth-child(1) p');
                const vendorNameText = vendorName ? vendorName.textContent.trim() : 'هذا المزود';

                Swal.fire({
                    title: '{{ __("message.Are you sure") }}?',
                    html: `{{ __("message.You will not be able to revert this") }}!<br><strong class="text-red-600">${vendorNameText}</strong>`,
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

