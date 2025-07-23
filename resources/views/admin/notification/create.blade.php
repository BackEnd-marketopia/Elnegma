@extends('admin.layouts.app')
@section('title', 'Add Notification')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Admin') }}</span>
    <span class="mx-2">/</span>
    <span class="text-primary-600 dark:text-primary-400">
        <a href="{{ route('admin.notifications.index') }}" class="hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            {{ __('message.Notifications') }}
        </a>
    </span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Add Notification') }}</span>
@endsection

@section('content')
<div class="space-y-6 animate-fadeInUp">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('message.Add Notification') }}
            </h1>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.notifications.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0 rtl:rotate-180"></i>
                {{ __('message.Back to Notifications') }}
            </a>
        </div>
    </div>

    <!-- Notification Create Form Card -->
    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                    <i class="fas fa-bell text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">
                        {{ __('message.New Notification Information') }}
                    </h3>
                    <p class="text-purple-100 text-sm">
                        {{ __('message.Fill in the notification details below') }}
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Form Content -->
        <form action="{{ route('admin.notifications.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-heading mr-2 text-purple-600"></i>
                        {{ __('message.Title') }} 
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ old('title') }}"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('title') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                           placeholder="{{ __('message.Enter notification title') }}"
                           required>
                    @if ($errors->has('title'))
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>

                <!-- To (Users or Cities) -->
                <div class="form-group {{ $errors->has('to') ? 'has-error' : '' }}">
                    <label for="to" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-users mr-2 text-purple-600"></i>
                        {{ __('message.To') }} 
                        <span class="text-red-500">*</span>
                    </label>
                    <select id="to" 
                            name="to" 
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('to') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                            required>
                        <option value="users" {{ old('to') == 'users' ? 'selected' : '' }}>{{ __('message.All Users') }}</option>
                        <option value="cities" {{ old('to') == 'cities' ? 'selected' : '' }}>{{ __('message.Specific City') }}</option>
                    </select>
                    @if ($errors->has('to'))
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('to') }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Body -->
            <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                <label for="body" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                    <i class="fas fa-align-left mr-2 text-purple-600"></i>
                    {{ __('message.Body') }} 
                    <span class="text-red-500">*</span>
                </label>
                <textarea id="body" 
                          name="body" 
                          rows="5"
                          class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-vertical {{ $errors->has('body') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                          placeholder="{{ __('message.Enter notification body') }}"
                          required>{{ old('body') }}</textarea>
                @if ($errors->has('body'))
                    <div class="mt-2 flex items-center text-red-600 text-sm">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $errors->first('body') }}
                    </div>
                @endif
            </div>

            <!-- Hidden Type (Always "topic") -->
            <input type="hidden" name="type" value="topic">

            <!-- Cities Dropdown (Hidden Initially) -->
            <div id="city-select" style="display: none;" class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
                <label for="city_id" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                    <i class="fas fa-map-marker-alt mr-2 text-purple-600"></i>
                    {{ __('message.Select City') }}
                </label>
                <select id="city_id" 
                        name="city_id"
                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('city_id') ? 'border-red-500 ring-2 ring-red-200' : '' }}">
                    <option value="">{{ __('message.Choose City') }}</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                            @if (app()->getLocale() == 'ar')
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

            <!-- Image Upload (Optional) -->
            <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                <label for="image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                    <i class="fas fa-image mr-2 text-purple-600"></i>
                    {{ __('message.Image') }} 
                    <span class="text-gray-500 text-xs">({{ __('message.Optional') }})</span>
                </label>
                <div class="relative">
                    <input type="file" 
                           id="image" 
                           name="image"
                           accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('image') ? 'border-red-500 ring-2 ring-red-200' : '' }}">
                </div>
                @if ($errors->has('image'))
                    <div class="mt-2 flex items-center text-red-600 text-sm">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    <i class="fas fa-info-circle mr-1"></i>
                    {{ __('message.Supported formats: JPG, PNG, GIF. Max size: 2MB') }}
                </p>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end space-x-4 rtl:space-x-reverse pt-6 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('admin.notifications.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-times mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Cancel') }}
                </a>
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-paper-plane mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Send Notification') }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show/Hide Cities Dropdown Based on Selection
    const toSelect = document.getElementById('to');
    const citySelect = document.getElementById('city-select');
    
    function toggleCitySelect() {
        if (toSelect.value === 'cities') {
            citySelect.style.display = 'block';
            citySelect.classList.add('animate-fadeInUp');
        } else {
            citySelect.style.display = 'none';
            citySelect.classList.remove('animate-fadeInUp');
        }
    }
    
    // Initialize on page load
    toggleCitySelect();
    
    // Listen for changes
    toSelect.addEventListener('change', toggleCitySelect);
    
    // Form validation feedback
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.classList.add('border-red-500', 'ring-2', 'ring-red-200');
                this.classList.remove('border-gray-300', 'dark:border-gray-600');
            } else {
                this.classList.remove('border-red-500', 'ring-2', 'ring-red-200');
                this.classList.add('border-gray-300', 'dark:border-gray-600');
            }
        });
    });
    
    // Image upload preview
    const imageInput = document.getElementById('image');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Check file size (2MB limit)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    this.value = '';
                    return;
                }
                
                // Show file info
                const fileName = file.name;
                const fileSize = (file.size / 1024 / 1024).toFixed(2);
                console.log(`Selected: ${fileName} (${fileSize} MB)`);
            }
        });
    }
});
</script>
@endpush
@endsection