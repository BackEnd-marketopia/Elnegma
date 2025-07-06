@extends('admin.layouts.app')
@section('title', 'Add Category')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Dashboard') }}</span>
    <span class="mx-2">/</span>
    <span class="text-primary-600 dark:text-primary-400">
        <a href="{{ route('admin.categories.index') }}" class="hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            {{ __('message.Categories') }}
        </a>
    </span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Add Category') }}</span>
@endsection

@section('content')
<div class="space-y-6 animate-fadeInUp">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('message.Add Category') }}
            </h1>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.categories.index') }}" 
               class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0 rtl:rotate-180"></i>
                {{ __('message.Back to Categories') }}
            </a>
        </div>
    </div>

    <!-- Category Create Form Card -->
    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                    <i class="fas fa-plus text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">
                        {{ __('message.New Category Information') }}
                    </h3>
                    <p class="text-purple-100 text-sm">
                        {{ __('message.Fill in the category details below') }}
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Form Content -->
        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            
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
                           value="{{ old('name_arabic') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('name_arabic') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                           placeholder="{{ __('message.Enter category name in Arabic') }}"
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
                           value="{{ old('name_english') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('name_english') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                           placeholder="{{ __('message.Enter category name in English') }}"
                           required>
                    @if ($errors->has('name_english'))
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('name_english') }}
                        </div>
                    @endif
                </div>

                <!-- Image Upload -->
                <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                    <label for="image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-image mr-2 text-purple-600"></i>
                        {{ __('message.Category Image') }}
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="file" 
                               id="image" 
                               name="image" 
                               accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 dark:file:bg-purple-900 dark:file:text-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('image') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                               required>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                            <i class="fas fa-upload text-gray-400"></i>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        {{ __('message.Recommended size') }}: 300x300px | {{ __('message.Supported formats') }}: SVG | {{ __('message.Max size') }}: 2MB
                    </p>
                    @if ($errors->has('image'))
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                </div>

                <!-- Sort Order -->
                <div class="form-group {{ $errors->has('sort_order') ? 'has-error' : '' }}">
                    <label for="sort_order" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-sort-numeric-down mr-2 text-purple-600"></i>
                        {{ __('message.Sort Order') }} 
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           id="sort_order" 
                           name="sort_order" 
                           value="{{ old('sort_order', 1) }}"
                           min="1"
                           max="999"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('sort_order') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                           placeholder="1"
                           required>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        {{ __('message.Lower numbers appear first') }}
                    </p>
                    @if ($errors->has('sort_order'))
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('sort_order') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                <button type="submit" 
                        class="btn btn-primary flex-1 sm:flex-none">
                    <i class="fas fa-save mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Create Category') }}
                </button>
                
                <a href="{{ route('admin.categories.index') }}" 
                   class="btn btn-secondary flex-1 sm:flex-none">
                    <i class="fas fa-times mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Cancel') }}
                </a>
                
                <button type="reset" 
                        class="btn btn-info flex-1 sm:flex-none">
                    <i class="fas fa-undo mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Reset Form') }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview functionality
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    Swal.fire({
                        title: '{{ __("message.File too large") }}',
                        text: '{{ __("message.File size must be less than 2MB") }}',
                        icon: 'error',
                        confirmButtonColor: '#dc2626'
                    });
                    this.value = '';
                    return;
                }
                
                // Validate file type
                if (!file.type.startsWith('image/')) {
                    Swal.fire({
                        title: '{{ __("message.Invalid file type") }}',
                        text: '{{ __("message.Please select an image file") }}',
                        icon: 'error',
                        confirmButtonColor: '#dc2626'
                    });
                    this.value = '';
                    return;
                }
                
                // Create preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    let preview = document.getElementById('image-preview');
                    if (!preview) {
                        preview = document.createElement('div');
                        preview.id = 'image-preview';
                        preview.className = 'mt-3';
                        imageInput.parentNode.parentNode.appendChild(preview);
                    }
                    
                    preview.innerHTML = `
                        <div class="flex justify-center">
                            <div class="relative group">
                                <div class="w-32 h-32 rounded-2xl overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 shadow-lg ring-2 ring-purple-200">
                                    <img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="absolute top-2 right-2">
                                    <button type="button" onclick="removeImagePreview()" 
                                            class="w-8 h-8 bg-red-500 text-white rounded-full text-sm hover:bg-red-600 transition-colors shadow-lg">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 rounded-2xl transition-all duration-300 flex items-center justify-center">
                                    <i class="fas fa-eye text-white opacity-0 group-hover:opacity-100 text-2xl transition-opacity duration-300"></i>
                                </div>
                            </div>
                        </div>
                        <p class="text-center text-xs text-gray-500 mt-2">{{ __('message.Image preview') }}</p>
                    `;
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Auto-generate English slug from Arabic name
    const nameArabic = document.getElementById('name_arabic');
    const nameEnglish = document.getElementById('name_english');
    
    if (nameArabic && nameEnglish) {
        nameArabic.addEventListener('input', function() {
            // Only auto-fill if English field is empty
            if (!nameEnglish.value.trim()) {
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
    
    // Form validation and submission
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>{{ __("message.Creating") }}...';
                submitBtn.disabled = true;
            }
        });
        
        // Reset form functionality
        const resetBtn = form.querySelector('button[type="reset"]');
        if (resetBtn) {
            resetBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: '{{ __("message.Reset form") }}?',
                    text: '{{ __("message.All entered data will be lost") }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: '{{ __("message.Yes reset it") }}',
                    cancelButtonText: '{{ __("message.Cancel") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.reset();
                        removeImagePreview();
                        nameEnglish.placeholder = 'Enter category name in English';
                        
                        Swal.fire({
                            title: '{{ __("message.Form reset") }}',
                            text: '{{ __("message.Form has been reset successfully") }}',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                });
            });
        }
    }
});

// Global function to remove image preview
function removeImagePreview() {
    const preview = document.getElementById('image-preview');
    const imageInput = document.getElementById('image');
    
    if (preview) {
        preview.remove();
    }
    
    if (imageInput) {
        imageInput.value = '';
    }
}
</script>
@endpush
@endsection