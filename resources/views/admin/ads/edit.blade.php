@extends('admin.layouts.app')
@section('title', __('message.Edit Advertisement'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/form-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Dashboard') }}</span>
    <span class="mx-2">/</span>
    <span class="text-primary-600 dark:text-primary-400">
        <a href="{{ route('admin.ads.index') }}" class="hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            {{ __('message.Advertisements') }}
        </a>
    </span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Edit Advertisement') }}</span>
@endsection

@section('content')
    <div class="space-y-6 animate-fadeInUp">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('message.Edit Advertisement') }}
                </h1>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.ads.index') }}" 
                   class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0 rtl:rotate-180"></i>
                    {{ __('message.Back to Advertisements') }}
                </a>
            </div>
        </div>

        <!-- Advertisement Edit Form Card -->
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6">
                <div class="flex items-center space-x-3 rtl:space-x-reverse">
                    <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                        <i class="fas fa-edit text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">
                            {{ __('message.Advertisement Information') }}
                        </h3>
                        <p class="text-purple-200 text-sm">
                            {{ __('message.Update advertisement details below') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <form action="{{ route('admin.ads.update', $ads->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Current Image Preview -->
                @if($ads->image)
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                        <i class="fas fa-image mr-2"></i>
                        {{ __('message.Current Image') }}
                    </label>
                    <div class="flex justify-center">
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-2xl overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-4 ring-purple-200 dark:ring-purple-800">
                                <img src="{{ asset($ads->image) }}" 
                                     alt="{{ $ads->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 rounded-2xl transition-all duration-300 flex items-center justify-center">
                                <i class="fas fa-search-plus text-white opacity-0 group-hover:opacity-100 text-2xl transition-opacity duration-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Name Arabic -->
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-font mr-2 text-purple-600"></i>
                            {{ __('message.Name Arabic') }} 
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $ads->name) }}"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('name') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                               placeholder="{{ __('message.Enter advertisement name in Arabic') }}"
                               required>
                        @if ($errors->has('name'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <!-- URL -->
                    <div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
                        <label for="url" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-link mr-2 text-purple-600"></i>
                            {{ __('message.URL') }}
                        </label>
                        <input type="url" 
                               id="url" 
                               name="url" 
                               value="{{ old('url', $ads->url) }}"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('url') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                               placeholder="{{ __('message.Enter advertisement URL') }}">
                        @if ($errors->has('url'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('url') }}
                            </div>
                        @endif
                    </div>

                    <!-- Start Date -->
                    <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                        <label for="start_date" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-calendar-alt mr-2 text-purple-600"></i>
                            {{ __('message.Start Date') }}
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               id="start_date" 
                               name="start_date" 
                               value="{{ old('start_date', $ads->start_date) }}"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('start_date') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                               required>
                        @if ($errors->has('start_date'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('start_date') }}
                            </div>
                        @endif
                    </div>

                    <!-- End Date -->
                    <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                        <label for="end_date" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-calendar-check mr-2 text-purple-600"></i>
                            {{ __('message.End Date') }}
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               id="end_date" 
                               name="end_date" 
                               value="{{ old('end_date', $ads->end_date) }}"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('end_date') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                               required>
                        @if ($errors->has('end_date'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('end_date') }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Cities Selection -->
                <div class="form-group {{ $errors->has('city_ids') ? 'has-error' : '' }}">
                    <label for="city_ids" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-map-marker-alt mr-2 text-purple-600"></i>
                        {{ __('message.Cities') }}
                        <span class="text-red-500">*</span>
                    </label>
                    @php
                        $cities_id = json_decode($ads->city_id, true);
                        if (in_array('all', $cities_id)) {
                            $cities_id = ['all'];
                        }
                    @endphp
                    <select name="city_ids[]" 
                            id="city_ids" 
                            multiple 
                            required
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('city_ids') ? 'border-red-500 ring-2 ring-red-200' : '' }}">
                        <option value="all" {{ in_array('all', $cities_id) ? 'selected' : '' }}>
                            {{ __('message.All') }}
                        </option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ in_array((string) $city->id, $cities_id) ? 'selected' : '' }}>
                                @if(app()->getLocale() == 'ar')
                                    {{ $city->name_arabic }}
                                @else
                                    {{ $city->name_english }}
                                @endif
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        {{ __('message.Hold Ctrl to select multiple cities') }}
                    </p>
                    @if ($errors->has('city_ids'))
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('city_ids') }}
                        </div>
                    @endif
                </div>

                <!-- Image Upload -->
                <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                    <label for="image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-image mr-2 text-purple-600"></i>
                        {{ __('message.New Image') }}
                    </label>
                    <div class="relative">
                        <input type="file" 
                               id="image" 
                               name="image" 
                               accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 dark:file:bg-purple-900 dark:file:text-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('image') ? 'border-red-500 ring-2 ring-red-200' : '' }}">
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                            <i class="fas fa-upload text-gray-400"></i>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        {{ __('message.Recommended size') }}: 1200x600px | {{ __('message.Supported formats') }}: JPG, PNG, GIF | {{ __('message.Max size') }}: 2MB
                    </p>
                    @if ($errors->has('image'))
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" 
                            class="btn btn-primary flex-1 sm:flex-none">
                        <i class="fas fa-save mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Update Advertisement') }}
                    </button>

                    <a href="{{ route('admin.ads.index') }}" 
                       class="btn btn-secondary flex-1 sm:flex-none">
                        <i class="fas fa-times mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Cancel') }}
                    </a>
                    
                    <button type="button" 
                            class="btn btn-danger flex-1 sm:flex-none delete-ad-btn"
                            data-ad-id="{{ $ads->id }}"
                            data-ad-name="{{ $ads->name }}">
                        <i class="fas fa-trash mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Delete Advertisement') }}
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
                        // Create preview if doesn't exist
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
                                    <div class="w-24 h-24 rounded-xl overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 shadow-lg ring-2 ring-purple-200">
                                        <img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">
                                    </div>
                                    <div class="absolute top-1 right-1">
                                        <button type="button" onclick="document.getElementById('image').value=''; this.parentNode.parentNode.parentNode.remove();" 
                                                class="w-6 h-6 bg-red-500 text-white rounded-full text-xs hover:bg-red-600 transition-colors">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center text-xs text-gray-500 mt-2">{{ __('message.New image preview') }}</p>
                        `;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Delete advertisement functionality
        const deleteBtn = document.querySelector('.delete-ad-btn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function() {
                const adId = this.dataset.adId;
                const adName = this.dataset.adName;

                Swal.fire({
                    title: '{{ __("message.Are you sure") }}?',
                    html: `{{ __("message.You will not be able to revert this") }}!<br><strong class="text-red-600">${adName}</strong>`,
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
                        form.action = `{{ url('admin/ads') }}/${adId}`;
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
        
        // Date validation
        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');
        
        if (startDate && endDate) {
            startDate.addEventListener('change', function() {
                endDate.min = this.value;
            });
            
            endDate.addEventListener('change', function() {
                if (this.value < startDate.value) {
                    Swal.fire({
                        title: '{{ __("message.Invalid date") }}',
                        text: '{{ __("message.End date cannot be before start date") }}',
                        icon: 'error',
                        confirmButtonColor: '#dc2626'
                    });
                    this.value = '';
                }
            });
        }
    });
    </script>
    @endpush
@endsection