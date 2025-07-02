@extends('admin.layouts.app')
@section('title', __('message.Cities'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Dashboard') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Cities') }}</span>
@endsection

@section('content')
<div class="space-y-6 animate-fadeInUp">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('message.Cities') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ __('message.Manage cities and locations') }}
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <button id="addCityBtn" 
                    class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105"
                    type="button">
                <i class="fas fa-plus mr-2 rtl:ml-2 rtl:mr-0"></i>
                {{ __('message.Add City') }}
            </button>
        </div>
    </div>

    <!-- Cities Table Card -->
    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div class="flex items-center space-x-3 rtl:space-x-reverse">
                    <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                        <i class="fas fa-city text-purple-600 dark:text-purple-400 text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ __('message.Cities List') }}
                    </h3>
                </div>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    <div class="relative">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               id="citySearch" 
                               class="block w-full pr-10 pl-3 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent shadow-sm hover:shadow-md transition-all duration-200" 
                               placeholder="{{ __('message.Search in cities') }}...">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table id="add-row" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gradient-to-r from-purple-600 to-purple-700">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                            <i class="fas fa-font mr-2"></i>
                            {{ __('message.Name Arabic') }}
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                            <i class="fas fa-language mr-2"></i>
                            {{ __('message.Name English') }}
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider">
                            <i class="fas fa-cogs mr-2"></i>
                            {{ __('message.Action') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($cities as $city)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="text-lg font-bold text-gray-900 dark:text-white">
                                    {{ $city->name_arabic }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="text-lg font-medium text-gray-600 dark:text-gray-300">
                                    {{ $city->name_english }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center space-x-3 rtl:space-x-reverse">
                                    <a href="{{ route('admin.cities.edit', $city->id) }}"
                                       class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transform hover:scale-105 transition-all duration-200 shadow-lg"
                                       data-bs-toggle="tooltip" 
                                       title="{{ __('message.Edit City') }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.cities.destroy', $city->id) }}"
                                          method="POST" 
                                          style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 delete-btn transform hover:scale-105 transition-all duration-200 shadow-lg"
                                                data-bs-toggle="tooltip" 
                                                title="{{ __('message.Delete City') }}">
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
    </div>
</div>

<!-- Add City Modal -->
<div id="addCityModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-2xl bg-white dark:bg-gray-800">
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-4 rounded-t-xl">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-white">
                    <i class="fas fa-plus mr-2"></i>
                    {{ __('message.Add City') }}
                </h3>
                <button onclick="closeModal('addCityModal')" class="text-white hover:text-gray-300 transition-colors duration-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.cities.store') }}" method="POST" id="addCityForm">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="add_name_arabic" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-font mr-2 text-purple-600"></i>
                            {{ __('message.Name Arabic') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="add_name_arabic" 
                               name="name_arabic" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                               placeholder="{{ __('message.Enter city name in Arabic') }}"
                               required>
                    </div>
                    <div>
                        <label for="add_name_english" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-language mr-2 text-purple-600"></i>
                            {{ __('message.Name English') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="add_name_english" 
                               name="name_english" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                               placeholder="{{ __('message.Enter city name in English') }}"
                               required>
                    </div>
                </div>
                <div class="flex justify-end space-x-4 rtl:space-x-reverse mx-4 mt-6">
                    <button type="button" onclick="closeModal('addCityModal')" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-times mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Cancel') }}
                    </button>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="fas fa-save mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Add City') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Modal functions
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        setTimeout(() => {
            const firstInput = modal.querySelector('input[type="text"]');
            if (firstInput) {
                firstInput.focus();
            }
        }, 100);
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        if (modalId === 'addCityModal') {
            const form = modal.querySelector('#addCityForm');
            if (form) {
                form.reset();
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-save mr-2"></i>{{ __("message.Add City") }}';
                    submitBtn.disabled = false;
                }
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Add city button event
    const addCityBtn = document.getElementById('addCityBtn');
    if (addCityBtn) {
        addCityBtn.addEventListener('click', function() {
            openModal('addCityModal');
        });
    }

    // Search functionality
    const searchInput = document.getElementById('citySearch');
    const tableRows = document.querySelectorAll('#add-row tbody tr');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            tableRows.forEach(row => {
                const nameArabicCell = row.querySelector('td:nth-child(1) div');
                const nameEnglishCell = row.querySelector('td:nth-child(2) div');
                
                const nameArabic = nameArabicCell ? nameArabicCell.textContent.toLowerCase() : '';
                const nameEnglish = nameEnglishCell ? nameEnglishCell.textContent.toLowerCase() : '';
                
                const shouldShow = searchTerm === '' || 
                                 nameArabic.includes(searchTerm) || 
                                 nameEnglish.includes(searchTerm);
                
                row.style.display = shouldShow ? 'table-row' : 'none';
            });
        });
    }
    
    // Add city form functionality
    const addCityForm = document.getElementById('addCityForm');
    if (addCityForm) {
        addCityForm.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>{{ __("message.Creating") }}...';
                submitBtn.disabled = true;
            }
        });
    }

    // Auto-generate English name from Arabic name
    const addNameArabic = document.getElementById('add_name_arabic');
    const addNameEnglish = document.getElementById('add_name_english');
    
    if (addNameArabic && addNameEnglish) {
        addNameArabic.addEventListener('input', function() {
            if (!addNameEnglish.value.trim()) {
                const transliterationMap = {
                    'ا': 'a', 'ب': 'b', 'ت': 't', 'ث': 'th', 'ج': 'j', 'ح': 'h',
                    'خ': 'kh', 'د': 'd', 'ذ': 'dh', 'ر': 'r', 'ز': 'z', 'س': 's',
                    'ش': 'sh', 'ص': 's', 'ض': 'd', 'ط': 't', 'ظ': 'z', 'ع': 'a',
                    'غ': 'gh', 'ف': 'f', 'ق': 'q', 'ك': 'k', 'ل': 'l', 'م': 'm',
                    'ن': 'n', 'ه': 'h', 'و': 'w', 'ي': 'y', ' ': ' '
                };
                
                let englishSuggestion = this.value.toLowerCase()
                    .split('')
                    .map(char => transliterationMap[char] || char)
                    .join('')
                    .replace(/[^a-z0-9\s]/g, '')
                    .replace(/\s+/g, ' ')
                    .trim();
                
                if (englishSuggestion) {
                    englishSuggestion = englishSuggestion
                        .split(' ')
                        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                        .join(' ');
                    
                    addNameEnglish.placeholder = `{{ __('message.Suggestion') }}: ${englishSuggestion}`;
                }
            }
        });
    }

    // ESC key to close modal
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('addCityModal');
            if (modal && !modal.classList.contains('hidden')) {
                closeModal('addCityModal');
            }
        }
    });

    // Close modal when clicking on backdrop
    const modal = document.getElementById('addCityModal');
    if (modal) {
        modal.addEventListener('click', function(event) {
            if (event.target === this) {
                closeModal('addCityModal');
            }
        });
    }
});
</script>
@endsection
