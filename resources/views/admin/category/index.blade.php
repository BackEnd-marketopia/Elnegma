@extends('admin.layouts.app')
@section('title', 'Categories')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Admin') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Categories') }}</span>
@endsection

@section('content')
    <div class="space-y-6 animate-fadeInUp">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('message.Categories') }}
                </h1>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.categories.create') }}" 
                   class="btn btn-primary">
                    <i class="fas fa-plus mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Add Category') }}
                </a>
            </div>
        </div>

        <!-- Categories Table Card -->
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                            <i class="fas fa-list text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ __('message.Categories List') }}
                        </h3>
                    </div>
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            </div>
                            <input type="text" 
                                   id="categorySearch" 
                                   class="block w-full pr-10 pl-3 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent shadow-sm hover:shadow-md transition-all duration-200" 
                                   placeholder="{{ __('message.Search in categories') }}...">
                        </div>
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <button id="testSearchBtn" class="px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                <i class="fas fa-search mr-2 rtl:ml-2 rtl:mr-0"></i>
                            {{ __('message.Search') }}
                            </button>
                        </div>
                    </div>
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
                                <i class="fas fa-font mr-2"></i>
                                {{ __('message.Name Arabic') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-language mr-2"></i>
                                {{ __('message.Name English') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-sort-numeric-down mr-2"></i>
                                {{ __('message.Sort Order') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider">
                                <i class="fas fa-cogs mr-2"></i>
                                {{ __('message.Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center">
                                        <div class="w-16 h-16 rounded-xl overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-2 ring-gray-200 dark:ring-gray-600">
                                            @if($category->image)
                                                <img src="{{ asset($category->image) }}" 
                                                     alt="{{ $category->name_english }}" 
                                                     class="w-full h-full hover:scale-105 transition-transform duration-200">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <i class="fas fa-folder text-2xl text-gray-400 dark:text-gray-500"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-lg font-bold text-gray-900 dark:text-white text-center">
                                        {{ $category->name_arabic }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-lg font-medium text-gray-600 dark:text-gray-300 text-center">
                                        {{ $category->name_english }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center">
                                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full text-lg font-bold bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg hover:shadow-xl transition-shadow duration-200">
                                            {{ $category->sort_order }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-3 rtl:space-x-reverse">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                           class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transform hover:scale-105 transition-all duration-200 shadow-lg"
                                           data-bs-toggle="tooltip" 
                                           title="{{ __('message.Edit Category') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                              method="POST" 
                                              style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 delete-btn transform hover:scale-105 transition-all duration-200 shadow-lg"
                                                    data-bs-toggle="tooltip" 
                                                    title="{{ __('message.Delete Category') }}">
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
                        {{ __('message.Page') }}: {{ $categories->currentPage() }} {{ __('message.of') }} {{ $categories->lastPage() }}
                    </div>
                    <div>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Categories search script loaded'); // Debug log

        // إيقاف أي مستمعين للأحداث من admin-modern.js
        document.removeEventListener('click', function() {}, true);

        // Enhanced search functionality with debouncing
        const searchInput = document.getElementById('categorySearch');
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
            const finalSearchInput = document.getElementById('categorySearch');

            console.log('Search input cleaned and ready');
        }

        // Test search function
        function testSearch() {
            console.log('=== TEST SEARCH DEBUG ===');
            const currentSearchInput = document.getElementById('categorySearch');
            console.log('Total rows found:', tableRows.length);
            console.log('Search input found:', currentSearchInput ? 'Yes' : 'No');
            console.log('Search input value:', currentSearchInput ? currentSearchInput.value : 'N/A');

            tableRows.forEach((row, index) => {
                const nameArabicCell = row.querySelector('td:nth-child(2) div');
                const nameEnglishCell = row.querySelector('td:nth-child(3) div');

                console.log(`Row ${index + 1}:`, {
                    arabic: nameArabicCell ? nameArabicCell.textContent : 'Not found',
                    english: nameEnglishCell ? nameEnglishCell.textContent : 'Not found',
                    display: row.style.display,
                    visible: row.style.visibility
                });
            });

            // Test manual search
            if (currentSearchInput) {
                console.log('Testing manual search...');
                const event = new Event('input', { bubbles: true });
                currentSearchInput.dispatchEvent(event);
            }

            alert('تحقق من وحدة التحكم للحصول على معلومات التصحيح. اضغط F12 وافتح تبويب Console');
        }

        // Attach event listener to test button
        if (testSearchBtn) {
            testSearchBtn.addEventListener('click', testSearch);
            console.log('Test button event listener attached');
        }

        const finalSearchInput = document.getElementById('categorySearch');
        if (finalSearchInput) {
            console.log('Attaching search functionality to clean input');

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
                        // Get text content from Arabic name (2nd column) and English name (3rd column)
                        const nameArabicCell = row.querySelector('td:nth-child(2) div');
                        const nameEnglishCell = row.querySelector('td:nth-child(3) div');

                        const nameArabic = nameArabicCell ? nameArabicCell.textContent.toLowerCase().trim() : '';
                        const nameEnglish = nameEnglishCell ? nameEnglishCell.textContent.toLowerCase().trim() : '';

                        console.log(`Row ${index + 1}:`, { arabic: nameArabic, english: nameEnglish });

                        const shouldShow = searchTerm === '' || 
                                         nameArabic.includes(searchTerm) || 
                                         nameEnglish.includes(searchTerm);

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
        } else {
            console.error('Could not find search input after cleanup');
        });
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
                            <p class="text-gray-600 dark:text-gray-400 text-xl font-medium">{{ __('message.No categories found') }}</p>
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

                const categoryName = this.closest('tr').querySelector('td:nth-child(2) div');
                const categoryNameText = categoryName ? categoryName.textContent.trim() : 'هذه الفئة';

                Swal.fire({
                    title: '{{ __("message.Are you sure") }}?',
                    html: `{{ __("message.You will not be able to revert this") }}!<br><strong class="text-red-600">${categoryNameText}</strong>`,
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