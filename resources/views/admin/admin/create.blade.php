@extends('admin.layouts.app')
@section('title', __('message.Add Admin'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
<style>
    /* Custom password toggle button styles */
    .position-relative {
        position: relative;
    }
    html[dir="rtl"] .position-relative .absolute.inset-y-0.right-3 {
        right: auto;
        left: 3px;
    }
    .password-toggle-btn {
        cursor: pointer;
        transition: all 0.2s;
    }
    .password-toggle-btn:hover {
        background-color: rgba(124, 58, 237, 0.1);
        border-radius: 50%;
    }
</style>
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Dashboard') }}</span>
    <span class="mx-2">/</span>
    <span class="text-primary-600 dark:text-primary-400">
        <a href="{{ route('admin.admins.index') }}" class="hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            {{ __('message.Admins') }}
        </a>
    </span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Add Admin') }}</span>
@endsection

@section('content')
        <div class="space-y-6 animate-fadeInUp">
            <!-- Header Section -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ __('message.Add Admin') }}
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">
                        {{ __('message.Create a new administrator account') }}
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.admins.index') }}" 
                       class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0 rtl:rotate-180"></i>
                        {{ __('message.Back to Admins') }}
                    </a>
                </div>
            </div>

            <!-- Admin Create Form Card -->
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                        <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                            <i class="fas fa-user-plus text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">
                                {{ __('message.New Admin Information') }}
                            </h3>
                            <p class="text-purple-100 text-sm">
                                {{ __('message.Fill in the admin account details below') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form action="{{ route('admin.admins.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-user mr-2 text-purple-600"></i>
                                {{ __('message.Name') }} 
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('name') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                   placeholder="{{ __('message.Enter admin name') }}"
                                   required>
                            @if ($errors->has('name'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <!-- Email -->
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-envelope mr-2 text-purple-600"></i>
                                {{ __('message.Email') }} 
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('email') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                   placeholder="{{ __('message.Enter admin email') }}"
                                   required>
                            @if ($errors->has('email'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>

                        <!-- Phone -->
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label for="phone" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-phone mr-2 text-purple-600"></i>
                                {{ __('message.Phone') }} 
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('phone') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                   placeholder="{{ __('message.Enter admin phone') }}"
                                   required>
                            @if ($errors->has('phone'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                        </div>
                        <!-- Profile Image -->
                        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                            <label for="image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-image mr-2 text-purple-600"></i>
                                {{ __('message.Profile Image') }}
                            </label>
                            <div class="relative">
                                <input type="file" id="image" name="image" accept="image/*"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 dark:file:bg-purple-900 dark:file:text-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('image') ? 'border-red-500 ring-2 ring-red-200' : '' }}">
                                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                    <i class="fas fa-upload text-gray-400"></i>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                {{ __('message.Recommended size') }}: 300x300px | {{ __('message.Max size') }}: 2MB
                            </p>
                            @if ($errors->has('image'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('image') }}
                                </div>
                            @endif
                        </div>

                        <!-- Password -->
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} position-relative">
                            <label for="password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-lock mr-2 text-purple-600"></i>
                                {{ __('message.Password') }} 
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="password"
                                   id="password" 
                                   name="password" 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('password') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                   placeholder="{{ __('message.Enter admin password') }}"
                                   required>
                            <div class="absolute inset-y-0 right-3 flex items-center">
                                <button type="button" id="togglePassword" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none p-2 w-10 h-10 flex items-center justify-center password-toggle-btn">
                                    <i class="fas fa-eye text-lg" id="eye-icon"></i>
                                </button>
                            </div>
                            @if ($errors->has('password'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }} position-relative">
                            <label for="password_confirmation" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-lock-open mr-2 text-purple-600"></i>
                                {{ __('message.Confirm Password') }} 
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('password_confirmation') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                   placeholder="{{ __('message.Confirm admin password') }}"
                                   required>
                            <div class="absolute inset-y-0 right-3 flex items-center">
                                <button type="button" id="toggleConfirmPassword" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none p-2 w-10 h-10 flex items-center justify-center password-toggle-btn">
                                    <i class="fas fa-eye text-lg" id="confirm-eye-icon"></i>
                                </button>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            @endif
                        </div>

                        <!-- City -->
                        <div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }} lg:col-span-2">
                            <label for="city_id" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-map-marker-alt mr-2 text-purple-600"></i>
                                {{ __('message.City') }} 
                                <span class="text-red-500">*</span>
                            </label>
                            <select id="city_id" name="city_id" 
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('city_id') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                    required>
                                <option value="">{{ __('message.Select City') }}</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">
                                        @if(app()->getLocale() == 'ar')
                                            {{ $city->name_arabic }}
                                        @else
                                            {{ $city->name_english }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('city_id'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('city_id') }}
                                </div>
                            @endif
                        </div>
                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200 dark:border-gray-700 lg:col-span-2">
                            <button type="submit" 
                                    class="btn btn-primary flex-1 sm:flex-none">
                                <i class="fas fa-save mr-2 rtl:ml-2 rtl:mr-0"></i>
                                {{ __('message.Create Admin') }}
                            </button>

                            <a href="{{ route('admin.admins.index') }}" 
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
                    </div>
                </form>
            </div>
        </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle Password Visibility
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('password_confirmation');
    const eyeIcon = document.getElementById('eye-icon');
    const confirmEyeIcon = document.getElementById('confirm-eye-icon');
    
    if (togglePassword && passwordField && eyeIcon) {
        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            if (type === 'text') {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    }
    
    if (toggleConfirmPassword && confirmPasswordField && confirmEyeIcon) {
        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordField.setAttribute('type', type);
            if (type === 'text') {
                confirmEyeIcon.classList.remove('fa-eye');
                confirmEyeIcon.classList.add('fa-eye-slash');
            } else {
                confirmEyeIcon.classList.remove('fa-eye-slash');
                confirmEyeIcon.classList.add('fa-eye');
            }
        });
    }
    
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
                                <div class="w-24 h-24 rounded-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 shadow-lg ring-2 ring-purple-200">
                                    <img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="absolute top-0 right-0">
                                    <button type="button" onclick="removeImagePreview()" 
                                            class="w-6 h-6 bg-red-500 text-white rounded-full text-sm hover:bg-red-600 transition-colors shadow-lg flex items-center justify-center">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <p class="text-center text-xs text-gray-500 mt-2">{{ __('message.Profile preview') }}</p>
                    `;
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Form submission
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>{{ __("message.Creating") }}...';
                submitBtn.disabled = true;
            }
        });
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