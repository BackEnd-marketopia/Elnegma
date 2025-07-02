@extends('admin.layouts.app')
@section('title', 'Add Vendor')
@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('Admin') }}</span>
    <span class="mx-2">/</span>
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Vendos') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Add Vendor') }}</span>
@endsection

@section('content')
<div class="space-y-6 animate-fadeInUp">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('message.Add Vendor') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ __('Create a new vendor account and profile') }}
            </p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.vendors.index') }}" 
               class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0 rtl:rotate-180"></i>
                {{ __('Back to Vendors') }}
            </a>
        </div>
    </div>
    <!-- Vendor Form Card -->
    <div class="card-modern">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ __('Vendor Information') }}
            </h3>
        </div>
        
        <form action="{{ route('admin.vendors.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            
            <!-- Personal Information Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name" class="form-label">{{ __('message.Name') }} <span class="text-red-500">*</span></label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-input {{ $errors->has('name') ? 'border-red-500' : '' }}" 
                           value="{{ old('name') }}" 
                           required
                           placeholder="{{ __('Enter vendor name') }}">
                    @if ($errors->has('name'))
                        <p class="form-error">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <!-- Email -->
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" class="form-label">{{ __('message.Email') }}</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-input {{ $errors->has('email') ? 'border-red-500' : '' }}" 
                           value="{{ old('email') }}"
                           placeholder="{{ __('Enter email address') }}">
                    @if ($errors->has('email'))
                        <p class="form-error">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Phone -->
                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label for="phone" class="form-label">{{ __('message.Phone') }} <span class="text-red-500">*</span></label>
                    <input type="text" 
                           id="phone" 
                           name="phone" 
                           class="form-input {{ $errors->has('phone') ? 'border-red-500' : '' }}" 
                           value="{{ old('phone') }}" 
                           required
                           placeholder="{{ __('Enter phone number') }}">
                    @if ($errors->has('phone'))
                        <p class="form-error">{{ $errors->first('phone') }}</p>
                    @endif
                </div>

                <!-- Profile Image -->
                <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                    <label for="image" class="form-label">{{ __('message.Profile Image') }}</label>
                    <input type="file" 
                           id="image" 
                           name="image" 
                           class="form-input-file {{ $errors->has('image') ? 'border-red-500' : '' }}"
                           accept="image/*">
                    @if ($errors->has('image'))
                        <p class="form-error">{{ $errors->first('image') }}</p>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password" class="form-label">{{ __('message.Password') }}</label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-input {{ $errors->has('password') ? 'border-red-500' : '' }} pr-10 rtl:pl-10 rtl:pr-3" 
                               placeholder="{{ __('Enter password') }}">
                        <button type="button" 
                                class="absolute inset-y-0 right-0 rtl:left-0 rtl:right-auto flex items-center px-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                                onclick="togglePassword('password')">
                            <i class="fas fa-eye" id="password-eye"></i>
                        </button>
                    </div>
                    @if ($errors->has('password'))
                        <p class="form-error">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label for="password_confirmation" class="form-label">{{ __('message.Confirm Password') }}</label>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="form-input {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }}" 
                           placeholder="{{ __('Confirm password') }}">
                    @if ($errors->has('password_confirmation'))
                        <p class="form-error">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>
            </div>

            <!-- Brand Information Section -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('Brand Information') }}</h4>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Brand Name -->
                    <div class="lg:col-span-2">
                        <div class="form-group {{ $errors->has('name_of_brand') ? 'has-error' : '' }}">
                            <label for="name_of_brand" class="form-label">{{ __('message.Name Of Brand') }} <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   id="name_of_brand" 
                                   name="name_of_brand" 
                                   class="form-input {{ $errors->has('name_of_brand') ? 'border-red-500' : '' }}" 
                                   value="{{ old('name_of_brand') }}" 
                                   required
                                   placeholder="{{ __('Enter brand name') }}">
                            @if ($errors->has('name_of_brand'))
                                <p class="form-error">{{ $errors->first('name_of_brand') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Cover Image -->
                    <div class="form-group {{ $errors->has('cover') ? 'has-error' : '' }}">
                        <label for="cover" class="form-label">{{ __('message.Cover') }}</label>
                        <input type="file" 
                               id="cover" 
                               name="cover" 
                               class="form-input-file {{ $errors->has('cover') ? 'border-red-500' : '' }}"
                               accept="image/*">
                        @if ($errors->has('cover'))
                            <p class="form-error">{{ $errors->first('cover') }}</p>
                        @endif
                    </div>

                    <!-- Logo -->
                    <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                        <label for="logo" class="form-label">{{ __('message.Logo') }}</label>
                        <input type="file" 
                               id="logo" 
                               name="logo" 
                               class="form-input-file {{ $errors->has('logo') ? 'border-red-500' : '' }}"
                               accept="image/*">
                        @if ($errors->has('logo'))
                            <p class="form-error">{{ $errors->first('logo') }}</p>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="lg:col-span-2">
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description" class="form-label">{{ __('message.Description') }}</label>
                            <textarea id="description" 
                                      name="description" 
                                      rows="4" 
                                      class="form-textarea {{ $errors->has('description') ? 'border-red-500' : '' }}"
                                      placeholder="{{ __('Enter brand description') }}">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <p class="form-error">{{ $errors->first('description') }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                        <label for="category_id" class="form-label">{{ __('message.Categories') }} <span class="text-red-500">*</span></label>
                        <select id="category_id" 
                                name="category_id" 
                                class="form-select {{ $errors->has('category_id') ? 'border-red-500' : '' }}" 
                                required>
                            <option value="">{{ __('Select Category') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    @if(app()->getLocale() == 'ar')
                                        {{ $category->name_arabic }}
                                    @else
                                        {{ $category->name_english }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                            <p class="form-error">{{ $errors->first('category_id') }}</p>
                        @endif
                    </div>

                    <!-- Cities -->
                    <div class="form-group {{ $errors->has('city_ids') ? 'has-error' : '' }}">
                        <label for="city_ids" class="form-label">{{ __('message.Cities') }} <span class="text-red-500">*</span></label>
                        <select id="city_ids" 
                                name="city_ids[]" 
                                class="form-select {{ $errors->has('city_ids') ? 'border-red-500' : '' }}" 
                                multiple 
                                required>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ in_array($city->id, old('city_ids', [])) ? 'selected' : '' }}>
                                    @if(app()->getLocale() == 'ar')
                                        {{ $city->name_arabic }}
                                    @else
                                        {{ $city->name_english }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('city_ids'))
                            <p class="form-error">{{ $errors->first('city_ids') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">{{ __('Contact Information') }}</h4>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Address -->
                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                        <label for="address" class="form-label">{{ __('message.Address') }} <span class="text-red-500">*</span></label>
                        <input type="text" 
                               id="address" 
                               name="address" 
                               class="form-input {{ $errors->has('address') ? 'border-red-500' : '' }}" 
                               value="{{ old('address') }}" 
                               required
                               placeholder="{{ __('Enter address') }}">
                        @if ($errors->has('address'))
                            <p class="form-error">{{ $errors->first('address') }}</p>
                        @endif
                    </div>

                    <!-- WhatsApp -->
                    <div class="form-group {{ $errors->has('whatsapp') ? 'has-error' : '' }}">
                        <label for="whatsapp" class="form-label">{{ __('message.Whatsapp') }}</label>
                        <input type="text" 
                               id="whatsapp" 
                               name="whatsapp" 
                               class="form-input {{ $errors->has('whatsapp') ? 'border-red-500' : '' }}" 
                               value="{{ old('whatsapp') }}"
                               placeholder="{{ __('Enter WhatsApp number') }}">
                        @if ($errors->has('whatsapp'))
                            <p class="form-error">{{ $errors->first('whatsapp') }}</p>
                        @endif
                    </div>

                    <!-- Facebook -->
                    <div class="form-group {{ $errors->has('facebook') ? 'has-error' : '' }}">
                        <label for="facebook" class="form-label">{{ __('message.Facebook') }}</label>
                        <input type="url" 
                               id="facebook" 
                               name="facebook" 
                               class="form-input {{ $errors->has('facebook') ? 'border-red-500' : '' }}" 
                               value="{{ old('facebook') }}"
                               placeholder="{{ __('Enter Facebook URL') }}">
                        @if ($errors->has('facebook'))
                            <p class="form-error">{{ $errors->first('facebook') }}</p>
                        @endif
                    </div>

                    <!-- Instagram -->
                    <div class="form-group {{ $errors->has('instagram') ? 'has-error' : '' }}">
                        <label for="instagram" class="form-label">{{ __('message.Instagram') }}</label>
                        <input type="url" 
                               id="instagram" 
                               name="instagram" 
                               class="form-input {{ $errors->has('instagram') ? 'border-red-500' : '' }}" 
                               value="{{ old('instagram') }}"
                               placeholder="{{ __('Enter Instagram URL') }}">
                        @if ($errors->has('instagram'))
                            <p class="form-error">{{ $errors->first('instagram') }}</p>
                        @endif
                    </div>

                    <!-- Google Map Link -->
                    <div class="form-group {{ $errors->has('google_map_link') ? 'has-error' : '' }}">
                        <label for="google_map_link" class="form-label">{{ __('message.Google Map Link') }}</label>
                        <input type="url" 
                               id="google_map_link" 
                               name="google_map_link" 
                               class="form-input {{ $errors->has('google_map_link') ? 'border-red-500' : '' }}" 
                               value="{{ old('google_map_link') }}"
                               placeholder="{{ __('Enter Google Maps URL') }}">
                        @if ($errors->has('google_map_link'))
                            <p class="form-error">{{ $errors->first('google_map_link') }}</p>
                        @endif
                    </div>

                    <!-- Status -->
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        <label for="status" class="form-label">{{ __('message.Status') }} <span class="text-red-500">*</span></label>
                        <select id="status" 
                                name="status" 
                                class="form-select {{ $errors->has('status') ? 'border-red-500' : '' }}" 
                                required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>{{ __('message.Pending') }}</option>
                            <option value="accepted" {{ old('status') == 'accepted' ? 'selected' : '' }}>{{ __('message.Accepted') }}</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>{{ __('message.Rejected') }}</option>
                        </select>
                        @if ($errors->has('status'))
                            <p class="form-error">{{ $errors->first('status') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Add') }}
                </button>
                <a href="{{ route('admin.vendors.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function togglePassword(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const eyeIcon = document.getElementById(fieldId + '-eye');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
}

// Initialize Select2 for multi-select
document.addEventListener('DOMContentLoaded', function() {
    if (typeof $ !== 'undefined') {
        $('#city_ids').select2({
            placeholder: '{{ __("Select cities") }}',
            allowClear: true
        });
    }
});
</script>
@endpush
@endsection
@endsection