@extends('admin.layouts.app')
@section('title', 'Edit City')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Dashboard') }}</span>
    <span class="mx-2">/</span>
    <span class="text-primary-600 dark:text-primary-400">
        <a href="{{ route('admin.cities.index') }}" class="hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            {{ __('message.Cities') }}
        </a>
    </span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Edit City') }}</span>
@endsection

@section('content')
<div class="space-y-6 animate-fadeInUp">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('message.Edit City') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ __('message.Update city information') }}: <span class="font-semibold text-purple-600 dark:text-purple-400">{{ $city->name_arabic }}</span>
            </p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.cities.index') }}" 
               class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0 rtl:rotate-180"></i>
                {{ __('message.Back to Cities') }}
            </a>
        </div>
    </div>

    <!-- City Edit Form Card -->
    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                    <i class="fas fa-edit text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">
                        {{ __('message.City Information') }}
                    </h3>
                    <p class="text-purple-100 text-sm">
                        {{ __('message.Update city details below') }}
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Form Content -->
        <form action="{{ route('admin.cities.update', $city->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Name Arabic -->
                <div class="form-group {{ $errors->has('name_arabic') ? 'has-error' : '' }}">
                    <label for="name_arabic" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-font mr-2 text-purple-600"></i>
                        {{ __('message.Name Arabic') }} 
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name_arabic" 
                           name="name_arabic" 
                           value="{{ old('name_arabic', $city->name_arabic) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('name_arabic') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                           placeholder="أدخل اسم المدينة بالعربية"
                           required>
                    @if ($errors->has('name_arabic'))
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('name_arabic') }}
                        </div>
                    @endif
                </div>

                <!-- Name English -->
                <div class="form-group {{ $errors->has('name_english') ? 'has-error' : '' }}">
                    <label for="name_english" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-language mr-2 text-purple-600"></i>
                        {{ __('message.Name English') }} 
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="name_english" 
                           name="name_english" 
                           value="{{ old('name_english', $city->name_english) }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('name_english') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                           placeholder="Enter city name in English"
                           required>
                    @if ($errors->has('name_english'))
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('name_english') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <button type="submit" 
                        class="btn btn-primary flex-1 sm:flex-none">
                    <i class="fas fa-save mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Update City') }}
                </button>
                
                <a href="{{ route('admin.cities.index') }}" 
                   class="btn btn-secondary flex-1 sm:flex-none">
                    <i class="fas fa-times mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete city functionality
    const deleteBtn = document.querySelector('.delete-city-btn');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            const cityId = this.dataset.cityId;
            const cityName = this.dataset.cityName;
            
            Swal.fire({
                title: '{{ __("message.Are you sure") }}?',
                html: `{{ __("message.You will not be able to revert this") }}!<br><strong class="text-red-600">${cityName}</strong>`,
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
                    // Create and submit delete form
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `{{ url('admin/cities') }}/${cityId}`;
                    form.innerHTML = `
                        @csrf
                        @method('DELETE')
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    }
    
    // Form validation feedback
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>{{ __("message.Updating") }}...';
                submitBtn.disabled = true;
            }
        });
    }
    
    // Auto-generate English name from Arabic name (optional feature)
    const nameArabic = document.getElementById('name_arabic');
    const nameEnglish = document.getElementById('name_english');
    
    if (nameArabic && nameEnglish) {
        nameArabic.addEventListener('input', function() {
            // Only auto-fill if English field is empty and Arabic field is being typed
            if (!nameEnglish.value.trim() || nameEnglish.value === nameEnglish.placeholder) {
                // Simple transliteration mapping
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
                    // Capitalize first letter of each word
                    englishSuggestion = englishSuggestion
                        .split(' ')
                        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                        .join(' ');
                    
                    nameEnglish.placeholder = `{{ __('message.Suggestion') }}: ${englishSuggestion}`;
                }
            }
        });
    }
});
</script>
@endpush
@endsection