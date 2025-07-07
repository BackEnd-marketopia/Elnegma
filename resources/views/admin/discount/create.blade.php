@extends('admin.layouts.app')
@section('title', 'Add Discount')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Dashboard') }}</span>
    <span class="mx-2">/</span>
    <span class="text-primary-600 dark:text-primary-400">
        <a href="{{ route('admin.discounts.index', $vendorId) }}" class="hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            {{ __('message.Discounts') }}
        </a>
    </span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Add Discount') }}</span>
@endsection

@section('content')
<div class="space-y-6 animate-fadeInUp">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('message.Add Discount') }}
            </h1>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.discounts.index', $vendorId) }}" 
               class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0 rtl:rotate-180"></i>
                {{ __('message.Back to Discounts') }}
            </a>
        </div>
    </div>

    <!-- Discount Create Form Card -->
    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                    <i class="fas fa-percent text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">
                        {{ __('message.New Discount Information') }}
                    </h3>
                    <p class="text-purple-100 text-sm">
                        {{ __('message.Fill in the discount details below') }}
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Form Content -->
        <form action="{{ route('admin.discounts.store', $vendorId) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf
            
            <!-- Title Section - Full Width -->
            <div class="mb-8">
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                        <i class="fas fa-heading mr-2 text-purple-600 text-lg"></i>
                        {{ __('message.Title') }} 
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}"
                               class="w-full px-5 py-4 pr-12 border-2 border-gray-300 dark:border-gray-600 rounded-2xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 text-lg {{ $errors->has('title') ? 'border-red-500 ring-4 ring-red-200/50' : 'hover:border-purple-300' }}"
                               placeholder="{{ __('message.Enter discount title') }}"
                               required>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                            <i class="fas fa-edit text-purple-400 text-lg"></i>
                        </div>
                    </div>
                    @if ($errors->has('title'))
                        <div class="mt-3 flex items-center text-red-600 text-sm bg-red-50 dark:bg-red-900/20 p-3 rounded-lg">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
                <!-- Image Upload with Preview -->
                <div class="space-y-6">
                    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                        <label for="image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                            <i class="fas fa-image mr-2 text-purple-600 text-lg"></i>
                            {{ __('message.Discount Image') }}
                        </label>
                        
                        <!-- Image Preview Area -->
                        <div class="mb-4">
                            <div id="imagePreview" class="hidden">
                                <div class="relative inline-block">
                                    <img id="previewImg" src="" alt="Preview" class="w-32 h-24 object-cover rounded-xl border-2 border-gray-200 dark:border-gray-600 shadow-lg">
                                    <button type="button" id="removePreview" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 transition-colors">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <input type="file" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*"
                                   class="w-full px-5 py-4 pr-12 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-purple-100 file:text-purple-700 hover:file:bg-purple-200 dark:file:bg-purple-900 dark:file:text-purple-300 focus:outline-none focus:ring-4 focus:ring-purple-500/20 focus:border-purple-500 transition-all duration-300 {{ $errors->has('image') ? 'border-red-500 ring-4 ring-red-200/50' : 'hover:border-purple-400' }}">
                            <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                                <i class="fas fa-cloud-upload-alt text-purple-400 text-lg"></i>
                            </div>
                        </div>
                        <div class="mt-3 bg-blue-50 dark:bg-blue-900/20 p-4 rounded-xl">
                            <p class="text-sm text-blue-700 dark:text-blue-300 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i>
                                <span>{{ __('message.Recommended size') }}: 400x300px | {{ __('message.Supported formats') }}: JPG, PNG, SVG | {{ __('message.Max size') }}: 2MB</span>
                            </p>
                        </div>
                        @if ($errors->has('image'))
                            <div class="mt-3 flex items-center text-red-600 text-sm bg-red-50 dark:bg-red-900/20 p-3 rounded-lg">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('image') }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Date Fields -->
                <div class="space-y-6">
                    <!-- Start Date -->
                    <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                        <label for="start_date" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                            <i class="fas fa-calendar-alt mr-2 text-green-600 text-lg"></i>
                            {{ __('message.Start Date') }} 
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="date" 
                                   id="start_date" 
                                   name="start_date" 
                                   value="{{ old('start_date') }}"
                                   class="w-full px-5 py-4 pr-12 border-2 border-gray-300 dark:border-gray-600 rounded-2xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all duration-300 {{ $errors->has('start_date') ? 'border-red-500 ring-4 ring-red-200/50' : 'hover:border-green-300' }}"
                                   required>
                            <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                                <i class="fas fa-calendar text-green-400 text-lg"></i>
                            </div>
                        </div>
                        @if ($errors->has('start_date'))
                            <div class="mt-3 flex items-center text-red-600 text-sm bg-red-50 dark:bg-red-900/20 p-3 rounded-lg">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('start_date') }}
                            </div>
                        @endif
                    </div>

                    <!-- End Date -->
                    <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                        <label for="end_date" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                            <i class="fas fa-calendar-times mr-2 text-red-600 text-lg"></i>
                            {{ __('message.End Date') }} 
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="date" 
                                   id="end_date" 
                                   name="end_date" 
                                   value="{{ old('end_date') }}"
                                   class="w-full px-5 py-4 pr-12 border-2 border-gray-300 dark:border-gray-600 rounded-2xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-4 focus:ring-red-500/20 focus:border-red-500 transition-all duration-300 {{ $errors->has('end_date') ? 'border-red-500 ring-4 ring-red-200/50' : 'hover:border-red-300' }}"
                                   required>
                            <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                                <i class="fas fa-calendar-check text-red-400 text-lg"></i>
                            </div>
                        </div>
                        @if ($errors->has('end_date'))
                            <div class="mt-3 flex items-center text-red-600 text-sm bg-red-50 dark:bg-red-900/20 p-3 rounded-lg">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('end_date') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Description - Full Width -->
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                    <i class="fas fa-align-left mr-2 text-blue-600 text-lg"></i>
                    {{ __('message.Description') }}
                </label>
                <div class="relative">
                    <textarea id="description" 
                              name="description" 
                              rows="5"
                              class="w-full px-5 py-4 pr-12 border-2 border-gray-300 dark:border-gray-600 rounded-2xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-300 resize-none {{ $errors->has('description') ? 'border-red-500 ring-4 ring-red-200/50' : 'hover:border-blue-300' }}"
                              placeholder="{{ __('message.Enter discount description') }}">{{ old('description') }}</textarea>
                    <div class="absolute top-4 right-4 pointer-events-none">
                        <i class="fas fa-pen text-blue-400 text-lg"></i>
                    </div>
                </div>
                @if ($errors->has('description'))
                    <div class="mt-3 flex items-center text-red-600 text-sm bg-red-50 dark:bg-red-900/20 p-3 rounded-lg">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $errors->first('description') }}
                    </div>
                @endif
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t-2 border-gray-200 dark:border-gray-700">
                <button type="submit" 
                        class="flex-1 sm:flex-none inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-purple-500/50">
                    <i class="fas fa-save mr-3 text-lg"></i>
                    {{ __('message.Create Discount') }}
                </button>
                
                <a href="{{ route('admin.discounts.index', $vendorId) }}" 
                   class="flex-1 sm:flex-none inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-gray-500/50">
                    <i class="fas fa-times mr-3 text-lg"></i>
                    {{ __('message.Cancel') }}
                </a>
                
                <button type="reset" 
                        class="flex-1 sm:flex-none inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-4 focus:ring-blue-500/50">
                    <i class="fas fa-undo mr-3 text-lg"></i>
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
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const removePreview = document.getElementById('removePreview');
    
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
                        confirmButtonColor: '#9333ea'
                    });
                    this.value = '';
                    return;
                }

                // Validate file type
                const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/svg+xml'];
                if (!allowedTypes.includes(file.type)) {
                    Swal.fire({
                        title: '{{ __("message.Invalid file type") }}',
                        text: '{{ __("message.Please select an image file") }}',
                        icon: 'error',
                        confirmButtonColor: '#9333ea'
                    });
                    this.value = '';
                    return;
                }

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    
                    // Add animation
                    imagePreview.style.opacity = '0';
                    imagePreview.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        imagePreview.style.transition = 'all 0.3s ease';
                        imagePreview.style.opacity = '1';
                        imagePreview.style.transform = 'scale(1)';
                    }, 10);
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Remove preview
    if (removePreview) {
        removePreview.addEventListener('click', function() {
            imageInput.value = '';
            imagePreview.classList.add('hidden');
            previewImg.src = '';
        });
    }

    // Date validation with enhanced UX
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    if (startDateInput) {
        startDateInput.min = today;
    }
    
    if (startDateInput && endDateInput) {
        startDateInput.addEventListener('change', function() {
            endDateInput.min = this.value;
            if (endDateInput.value && endDateInput.value < this.value) {
                endDateInput.value = this.value;
                // Visual feedback
                endDateInput.style.transform = 'scale(1.02)';
                setTimeout(() => {
                    endDateInput.style.transform = 'scale(1)';
                }, 200);
            }
        });
        
        endDateInput.addEventListener('change', function() {
            if (startDateInput.value && this.value < startDateInput.value) {
                Swal.fire({
                    title: '{{ __("message.Invalid Date") }}',
                    text: '{{ __("message.End date cannot be before start date") }}',
                    icon: 'error',
                    confirmButtonColor: '#9333ea'
                });
                this.value = startDateInput.value;
            }
        });
    }

    // Enhanced form validation
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            if (!title) {
                e.preventDefault();
                Swal.fire({
                    title: '{{ __("message.Missing Information") }}',
                    text: '{{ __("message.Please enter a discount title") }}',
                    icon: 'warning',
                    confirmButtonColor: '#9333ea'
                });
                document.getElementById('title').focus();
                return;
            }

            if (!startDate || !endDate) {
                e.preventDefault();
                Swal.fire({
                    title: '{{ __("message.Missing Information") }}',
                    text: '{{ __("message.Please select both start and end dates") }}',
                    icon: 'warning',
                    confirmButtonColor: '#9333ea'
                });
                return;
            }

            if (new Date(endDate) < new Date(startDate)) {
                e.preventDefault();
                Swal.fire({
                    title: '{{ __("message.Invalid Date Range") }}',
                    text: '{{ __("message.End date must be after start date") }}',
                    icon: 'error',
                    confirmButtonColor: '#9333ea'
                });
                return;
            }

            // Show loading animation
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-3"></i>{{ __("message.Creating") }}...';
                submitBtn.disabled = true;
            }
        });
    }

    // Input animation effects
    const inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.01)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });

    // Character counter for description
    const description = document.getElementById('description');
    if (description) {
        const maxLength = 500;
        const counterDiv = document.createElement('div');
        counterDiv.className = 'text-sm text-gray-500 mt-2 text-right';
        description.parentElement.appendChild(counterDiv);
        
        function updateCounter() {
            const remaining = maxLength - description.value.length;
            counterDiv.textContent = `${description.value.length}/${maxLength}`;
            
            if (remaining < 50) {
                counterDiv.className = 'text-sm text-red-500 mt-2 text-right';
            } else {
                counterDiv.className = 'text-sm text-gray-500 mt-2 text-right';
            }
        }
        
        description.addEventListener('input', updateCounter);
        updateCounter();
    }
});
</script>
@endpush
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const title = document.getElementById('title').value.trim();
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;

            if (!title) {
                e.preventDefault();
                Swal.fire({
                    title: '{{ __("message.Missing Information") }}',
                    text: '{{ __("message.Please enter a discount title") }}',
                    icon: 'warning'
                });
                document.getElementById('title').focus();
                return;
            }

            if (!startDate || !endDate) {
                e.preventDefault();
                Swal.fire({
                    title: '{{ __("message.Missing Information") }}',
                    text: '{{ __("message.Please select both start and end dates") }}',
                    icon: 'warning'
                });
                return;
            }

            if (new Date(endDate) < new Date(startDate)) {
                e.preventDefault();
                Swal.fire({
                    title: '{{ __("message.Invalid Date Range") }}',
                    text: '{{ __("message.End date must be after start date") }}',
                    icon: 'error'
                });
                return;
            }
        });
    }
});
</script>
@endpush
@endsection