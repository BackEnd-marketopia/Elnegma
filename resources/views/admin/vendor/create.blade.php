@extends('admin.layouts.app')
@section('title', __('message.Add Vendor'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Dashboard') }}</span>
    <span class="mx-2">/</span>
    <span class="text-primary-600 dark:text-primary-400">
        <a href="{{ route('admin.vendors.index') }}" class="hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            {{ __('message.Vendors') }}
        </a>
    </span>
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
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.vendors.index') }}" 
                   class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0 rtl:rotate-180"></i>
                    {{ __('message.Back to Vendors') }}
                </a>
            </div>
        </div>

        <!-- Vendor Create Form Card -->
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6">
                <div class="flex items-center space-x-3 rtl:space-x-reverse">
                    <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                        <i class="fas fa-store-alt text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">
                            {{ __('message.New Vendor Information') }}
                        </h3>
                        <p class="text-purple-100 text-sm">
                            {{ __('message.Fill in the vendor account details below') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <form action="{{ route('admin.vendors.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
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
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('name') ? 'border-red-500 ring-2 ring-red-200' : '' }}" 
                               value="{{ old('name') }}" 
                               required
                               placeholder="{{ __('message.Enter vendor name') }}">
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
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('email') ? 'border-red-500 ring-2 ring-red-200' : '' }}" 
                               value="{{ old('email') }}"
                               required
                               placeholder="{{ __('message.Enter email address') }}">
                        @if ($errors->has('email'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <!-- Phone -->
                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }} lg:col-span-2">
                        <label for="phone" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-phone mr-2 text-purple-600"></i>
                            {{ __('message.Phone') }} 
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="phone" 
                               name="phone" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('phone') ? 'border-red-500 ring-2 ring-red-200' : '' }}" 
                               value="{{ old('phone') }}" 
                               required
                               placeholder="{{ __('message.Enter phone number') }}">
                        @if ($errors->has('phone'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>

                <!-- Password Field -->
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-lock mr-2 text-purple-600"></i>
                        {{ __('message.Password') }}
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('password') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                               placeholder="{{ __('message.Enter password') }}"
                               required>
                        <button type="button" 
                                class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center toggle-password"
                                data-target="password">
                            <i class="fas fa-eye text-purple-500 hover:text-purple-700 transition-colors text-lg"></i>
                        </button>
                    </div>
                    @if ($errors->has('password'))
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label for="password_confirmation" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-shield-alt mr-2 text-purple-600"></i>
                        {{ __('message.Confirm Password') }}
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('password_confirmation') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                               placeholder="{{ __('message.Confirm password') }}"
                               required>
                        <button type="button" 
                                class="absolute inset-y-0 {{ app()->getLocale() === 'ar' ? 'left-0 pl-3' : 'right-0 pr-3' }} flex items-center toggle-password"
                                data-target="password_confirmation">
                            <i class="fas fa-eye text-purple-500 hover:text-purple-700 transition-colors text-lg"></i>
                        </button>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>
                </div>

                <!-- Brand Information Section -->
                <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                        <i class="fas fa-store mr-2 text-purple-600"></i>
                        {{ __('message.Brand Information') }}
                    </h3>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Brand Name -->
                        <div class="form-group {{ $errors->has('name_of_brand_ar') ? 'has-error' : '' }}">
                            <label for="name_of_brand_ar" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-tag mr-2 text-purple-600"></i>
                                {{ __('message.Name Of Brand') . ' ' . (__('message.Arabic')) }} 
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name_of_brand_ar" 
                                   name="name_of_brand_ar" 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('name_of_brand_ar') ? 'border-red-500 ring-2 ring-red-200' : '' }}" 
                                   value="{{ old('name_of_brand_ar') }}" 
                                   required
                                   placeholder="{{ __('message.Enter brand name') . ' ' .  (__('message.Arabic')) }}">
                            @if ($errors->has('name_of_brand_ar'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('name_of_brand_ar') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('name_of_brand_en') ? 'has-error' : '' }}">
                        <label for="name_of_brand_en" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-tag mr-2 text-purple-600"></i>
                            {{ __('message.Name Of Brand') . ' ' . (__('message.English')) }}
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name_of_brand_en" name="name_of_brand_en"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('name_of_brand_en') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                            value="{{ old('name_of_brand_en') }}" required placeholder="{{ __('message.Enter brand name') .' ' . (__('message.English')) }}">
                        @if ($errors->has('name_of_brand_en'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('name_of_brand_en') }}
                            </div>
                        @endif
                        </div>

                        <!-- Category -->
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                            <label for="category_id" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-th-large mr-2 text-purple-600"></i>
                                {{ __('message.Category') }}
                                <span class="text-red-500">*</span>
                            </label>
                            <select id="category_id" 
                                    name="category_id" 
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('category_id') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                    required>
                                <option value="">{{ __('message.Select Category') }}</option>
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
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('category_id') }}
                                </div>
                            @endif
                        </div>

                        <!-- Cities Multi-select -->
                        <div class="form-group {{ $errors->has('city_ids') ? 'has-error' : '' }}">
                            <label for="city_ids" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-city mr-2 text-purple-600"></i>
                                {{ __('message.Cities') }}
                                <span class="text-red-500">*</span>
                            </label>
                            <select id="city_ids" 
                                    name="city_ids[]" 
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('city_ids') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
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
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('city_ids') }}
                                </div>
                            @endif
                        </div>

                        <!-- Cover Image -->
                        <div class="form-group {{ $errors->has('cover') ? 'has-error' : '' }} lg:col-span-2">
                            <label for="cover" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-image mr-2 text-purple-600"></i>
                                {{ __('message.Cover') }}
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl {{ $errors->has('cover') ? 'border-red-500' : '' }}">
                                <div class="space-y-1 text-center">
                                    <div id="cover-preview" class="hidden mb-3 flex justify-center">
                                        <img class="h-32 w-full object-cover rounded-lg" src="" alt="Cover image preview">
                                    </div>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                        <label for="cover" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-purple-600 dark:text-purple-400 hover:text-purple-500 focus-within:outline-none">
                                            <span>{{ __('message.Click to upload') }}</span>
                                            <input id="cover" name="cover" type="file" class="sr-only" accept="image/*" required>
                                        </label>
                                        <p class="pl-1">{{ __('message.or drag and drop') }}</p>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        PNG, JPG, GIF {{ __('message.up to 2MB') }}
                                    </p>
                                </div>
                            </div>
                            @if ($errors->has('cover'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('cover') }}
                                </div>
                            @endif
                        </div>

                        <!-- Description in English -->
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-align-left mr-2 text-purple-600"></i>
                                {{ __('message.Description') }} {{ __('message.English') }}
                                <span class="text-red-500">*</span>
                            </label>
                            <textarea id="description" 
                                    name="description" 
                                    rows="4" 
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('description') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                    required
                                    placeholder="{{ __('message.Enter brand description') .' '. __('message.English') }}">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                        </div>

                        <!-- Description in Arabic -->
                        <div class="form-group {{ $errors->has('description_ar') ? 'has-error' : '' }}">
                            <label for="description_ar" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-align-left mr-2 text-purple-600"></i>
                                {{ __('message.Description') }} {{ __('message.Arabic') }}
                            </label>
                            <textarea id="description_ar" 
                                    name="description_ar" 
                                    rows="4" 
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('description_ar') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                    placeholder="{{ __('message.Enter brand description') .' '. __('message.Arabic') }}">{{ old('description_ar') }}</textarea>
                            @if ($errors->has('description_ar'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('description_ar') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">
                        <i class="fas fa-address-book mr-2 text-purple-600"></i>
                        {{ __('message.Contact Information') }}
                    </h3>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Address -->
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label for="address" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-map-marked-alt mr-2 text-purple-600"></i>
                                {{ __('message.Address') }}
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                id="address" 
                                name="address" 
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('address') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                value="{{ old('address') }}" 
                                required
                                placeholder="{{ __('message.Enter address') }}">
                            @if ($errors->has('address'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('address') }}
                                </div>
                            @endif
                        </div>

                        <!-- Google Map Link -->
                        <div class="form-group {{ $errors->has('google_map_link') ? 'has-error' : '' }}">
                            <label for="google_map_link" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-map-marker-alt mr-2 text-purple-600"></i>
                                {{ __('message.Google Map Link') }}
                            </label>
                            <input type="url" 
                                id="google_map_link" 
                                name="google_map_link" 
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('google_map_link') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                value="{{ old('google_map_link') }}"
                                placeholder="{{ __('message.Enter Google Maps URL') }}">
                            @if ($errors->has('google_map_link'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('google_map_link') }}
                                </div>
                            @endif
                        </div>

                        <!-- WhatsApp -->
                        <div class="form-group {{ $errors->has('whatsapp') ? 'has-error' : '' }}">
                            <label for="whatsapp" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fab fa-whatsapp mr-2 text-purple-600"></i>
                                {{ __('message.Whatsapp') }}
                            </label>
                            <input type="text" 
                                id="whatsapp" 
                                name="whatsapp" 
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('whatsapp') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                value="{{ old('whatsapp') }}"
                                placeholder="{{ __('message.Enter WhatsApp number') }}">
                            @if ($errors->has('whatsapp'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('whatsapp') }}
                                </div>
                            @endif
                        </div>

                        <!-- Facebook -->
                        <div class="form-group {{ $errors->has('facebook') ? 'has-error' : '' }}">
                            <label for="facebook" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fab fa-facebook mr-2 text-purple-600"></i>
                                {{ __('message.Facebook') }}
                            </label>
                            <input type="url" 
                                id="facebook" 
                                name="facebook" 
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('facebook') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                value="{{ old('facebook') }}"
                                placeholder="{{ __('message.Enter Facebook URL') }}">
                            @if ($errors->has('facebook'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('facebook') }}
                                </div>
                            @endif
                        </div>

                        <!-- Instagram -->
                        <div class="form-group {{ $errors->has('instagram') ? 'has-error' : '' }}">
                            <label for="instagram" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fab fa-instagram mr-2 text-purple-600"></i>
                                {{ __('message.Instagram') }}
                            </label>
                            <input type="url" 
                                id="instagram" 
                                name="instagram" 
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('instagram') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                value="{{ old('instagram') }}"
                                placeholder="{{ __('message.Enter Instagram URL') }}">
                            @if ($errors->has('instagram'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('instagram') }}
                                </div>
                            @endif
                        </div>
                            <!-- Status -->
                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label for="status" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    <i class="fas fa-toggle-on mr-2 text-purple-600"></i>
                                    {{ __('message.Status') }}
                                </label>
                                <select id="status" name="status"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('status') ? 'border-red-500 ring-2 ring-red-200' : '' }}">
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>{{ __('message.Pending') }}</option>
                                    <option value="accepted" {{ old('status') == 'accepted' ? 'selected' : '' }}>{{ __('message.Accepted') }}</option>
                                    <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>{{ __('message.Rejected') }}</option>
                                </select>
                                @if ($errors->has('status'))
                                    <div class="mt-2 flex items-center text-red-600 text-sm">
                                        <i class="fas fa-exclamation-circle mr-2"></i>
                                        {{ $errors->first('status') }}
                                    </div>
                                @endif
                            </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                    <!-- Logo -->
                    <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                        <label for="logo" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-image mr-2 text-purple-600"></i>
                            {{ __('message.Logo') }}
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl {{ $errors->has('logo') ? 'border-red-500' : '' }}">
                            <div class="space-y-1 text-center">
                                <div id="logo-preview" class="hidden mb-3 flex justify-center">
                                    <img class="h-32 w-32 object-cover rounded-lg" src="" alt="Logo preview">
                                </div>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                    <label for="logo" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-purple-600 dark:text-purple-400 hover:text-purple-500 focus-within:outline-none">
                                        <span>{{ __('message.Click to upload') }}</span>
                                        <input id="logo" name="logo" type="file" class="sr-only" accept="image/*" required>
                                    </label>
                                    <p class="pl-1">{{ __('message.or drag and drop') }}</p>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    PNG, JPG, GIF {{ __('message.up to 2MB') }}
                                </p>
                            </div>
                        </div>
                        @if ($errors->has('logo'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('logo') }}
                            </div>
                        @endif
                    </div>

                    <!-- Profile Image -->
                    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                        <label for="image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-user-circle mr-2 text-purple-600"></i>
                            {{ __('message.Profile Image') }}
                        </label>
                        <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl {{ $errors->has('image') ? 'border-red-500' : '' }}">
                            <div class="space-y-1 text-center">
                                <div id="image-preview" class="hidden mb-3 flex justify-center">
                                    <img class="h-32 w-32 object-cover rounded-full" src="" alt="Profile image preview">
                                </div>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                    <label for="image" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-purple-600 dark:text-purple-400 hover:text-purple-500 focus-within:outline-none">
                                        <span>{{ __('message.Click to upload') }}</span>
                                        <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                    </label>
                                    <p class="pl-1">{{ __('or drag and drop') }}</p>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    PNG, JPG, GIF {{ __('up to 2MB') }}
                                </p>
                            </div>
                        </div>
                        @if ($errors->has('image'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('image') }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200 dark:border-gray-700 lg:col-span-2">
                    <button type="submit" class="btn btn-primary flex-1 sm:flex-none">
                        <i class="fas fa-save mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Create Vendor') }}
                    </button>

                    <a href="{{ route('admin.vendors.index') }}" class="btn btn-secondary flex-1 sm:flex-none">
                        <i class="fas fa-times mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Cancel') }}
                    </a>

                    <button type="reset" class="btn btn-info flex-1 sm:flex-none">
                        <i class="fas fa-undo mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Reset Form') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const icon = this.querySelector('i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Logo preview
        const logoInput = document.getElementById('logo');
        const logoPreview = document.getElementById('logo-preview');

        if (logoInput) {
            logoInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        logoPreview.classList.remove('hidden');
                        logoPreview.querySelector('img').src = e.target.result;
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });
        }

        // Profile image preview
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');

        if (imageInput) {
            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        imagePreview.classList.remove('hidden');
                        imagePreview.querySelector('img').src = e.target.result;
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });
        }

        // Cover image preview
        const coverInput = document.getElementById('cover');
        const coverPreview = document.getElementById('cover-preview');

        if (coverInput) {
            coverInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        coverPreview.classList.remove('hidden');
                        coverPreview.querySelector('img').src = e.target.result;
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
    });
    </script>
    @endpush
@endsection