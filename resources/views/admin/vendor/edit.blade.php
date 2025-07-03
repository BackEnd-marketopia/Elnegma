@extends('admin.layouts.app')
@section('title', __('message.Edit Vendor'))

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
    <span>{{ __('message.Edit Vendor') }}</span>
@endsection

@section('content')
<div class="space-y-6 animate-fadeInUp">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('message.Edit Vendor') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ __('message.Edit Informantion of Vendor:') }} <span class="font-semibold text-purple-600 dark:text-purple-400">{{ $user->name }}</span>
            </p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.vendors.index') }}" 
               class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0 rtl:rotate-180"></i>
                {{ __('message.Back to Vendors') }}
            </a>
        </div>
    </div>

    <!-- Vendor Edit Form Card -->
    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                    <i class="fas fa-store-alt text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">
                        {{ __('message.Vendor Information') }}
                    </h3>
                    <p class="text-purple-100 text-sm">
                        {{ __('message.Update vendor details below') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Current Images Preview -->
        <div class="mt-6 px-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Profile Image -->
            @if($user->image)
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                    <i class="fas fa-user-circle mr-2"></i>
                    {{ __('message.Current Image') }}
                </label>
                <div class="flex justify-center">
                    <div class="relative group">
                        <div class="w-24 h-24 rounded-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-4 ring-purple-200 dark:ring-purple-800">
                            <img src="{{ asset($user->image) }}" 
                                 alt="{{ $user->name }}" 
                                 class="w-full h-full group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 rounded-full transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-search-plus text-white opacity-0 group-hover:opacity-100 text-2xl transition-opacity duration-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Logo -->
            @if($user->vendor->logo)
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                    <i class="fas fa-store mr-2"></i>
                    {{ __('message.Current Logo') }}
                </label>
                <div class="flex justify-center">
                    <div class="relative group">
                        <div class="w-24 h-24 rounded-lg overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-4 ring-purple-200 dark:ring-purple-800">
                            <img src="{{ asset($user->vendor->logo) }}" 
                                 alt="Logo" 
                                 class="w-full h-full group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 rounded-lg transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-search-plus text-white opacity-0 group-hover:opacity-100 text-2xl transition-opacity duration-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Cover -->
            @if($user->vendor->cover)
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                    <i class="fas fa-image mr-2"></i>
                    {{ __('message.Current Cover') }}
                </label>
                <div class="flex justify-center">
                    <div class="relative group">
                        <div class="w-full h-24 rounded-lg overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-4 ring-purple-200 dark:ring-purple-800">
                            <img src="{{ asset($user->vendor->cover) }}" 
                                 alt="Cover" 
                                 class="w-full h-full group-hover:scale-110 transition-transform duration-300 object-cover">
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 rounded-lg transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-search-plus text-white opacity-0 group-hover:opacity-100 text-2xl transition-opacity duration-300"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Form Content -->
        <form action="{{ route('admin.vendors.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Personal Information Section -->
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
                           value="{{ $user->name }}" 
                           required
                           placeholder="{{ __('Enter vendor name') }}">
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
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('email') ? 'border-red-500 ring-2 ring-red-200' : '' }}" 
                           value="{{ $user->email }}"
                           placeholder="{{ __('Enter email address') }}">
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
                           class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('phone') ? 'border-red-500 ring-2 ring-red-200' : '' }}" 
                           value="{{ $user->phone }}" 
                           required
                           placeholder="{{ __('Enter phone number') }}">
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
                        <i class="fas fa-user-circle mr-2 text-purple-600"></i>
                        {{ __('message.Profile Image') }}
                    </label>
                    <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl {{ $errors->has('image') ? 'border-red-500' : '' }}">
                        <div class="space-y-1 text-center">
                            <div id="image-preview" class="hidden mb-3 flex justify-center">
                                <img class="h-24 w-24 object-cover rounded-full" src="" alt="Profile image preview">
                            </div>
                            <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                <label for="image" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-purple-600 dark:text-purple-400 hover:text-purple-500 focus-within:outline-none">
                                    <span>{{ __('message.Click to upload') }}</span>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">{{ __('message.or drag and drop') }}</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                PNG, JPG, GIF {{ __('message.up to 2MB') }}
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

                <!-- Password -->
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-lock mr-2 text-purple-600"></i>
                        {{ __('message.Password') }}
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('password') ? 'border-red-500 ring-2 ring-red-200' : '' }}" 
                               placeholder="{{ __('message.Leave empty to keep current password') }}">
                        <button type="button" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 focus:outline-none toggle-password"
                                data-target="password">
                            <i class="far fa-eye text-gray-500 hover:text-purple-600 transition-colors"></i>
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
                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label for="password_confirmation" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-check-circle mr-2 text-purple-600"></i>
                        {{ __('message.Confirm Password') }}
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200" 
                               placeholder="{{ __('message.Confirm new password') }}">
                        <button type="button" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 focus:outline-none toggle-password"
                                data-target="password_confirmation">
                            <i class="far fa-eye text-gray-500 hover:text-purple-600 transition-colors"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Brand Information Section -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                <h4 class="text-lg font-medium text-gray-900 dark:text-white flex items-center mb-4">
                    <i class="fas fa-store-alt mr-2 text-purple-600"></i>
                    {{ __('message.Brand Information') }}
                </h4>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Brand Name -->
                    <div class="lg:col-span-2">
                        <div class="form-group {{ $errors->has('name_of_brand') ? 'has-error' : '' }}">
                            <label for="name_of_brand" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-signature mr-2 text-purple-600"></i>
                                {{ __('message.Name Of Brand') }} 
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name_of_brand" 
                                   name="name_of_brand" 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('name_of_brand') ? 'border-red-500 ring-2 ring-red-200' : '' }}" 
                                   value="{{ $user->vendor->name }}" 
                                   required
                                   placeholder="{{ __('Enter brand name') }}">
                            @if ($errors->has('name_of_brand'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('name_of_brand') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Logo -->
                    <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                        <label for="logo" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-image mr-2 text-purple-600"></i>
                            {{ __('message.Logo') }}
                        </label>
                        <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl {{ $errors->has('logo') ? 'border-red-500' : '' }}">
                            <div class="space-y-1 text-center">
                                <div id="logo-preview" class="hidden mb-3 flex justify-center">
                                    <img class="h-24 w-24 object-cover rounded-lg" src="" alt="Logo preview">
                                </div>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                    <label for="logo" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-purple-600 dark:text-purple-400 hover:text-purple-500 focus-within:outline-none">
                                        <span>{{ __('message.Click to upload') }}</span>
                                        <input id="logo" name="logo" type="file" class="sr-only" accept="image/*">
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

                    <!-- Cover -->
                    <div class="form-group {{ $errors->has('cover') ? 'has-error' : '' }}">
                        <label for="cover" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-image mr-2 text-purple-600"></i>
                            {{ __('message.Cover') }}
                        </label>
                        <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl {{ $errors->has('cover') ? 'border-red-500' : '' }}">
                            <div class="space-y-1 text-center">
                                <div id="cover-preview" class="hidden mb-3 flex justify-center">
                                    <img class="h-24 w-full object-cover rounded-lg" src="" alt="Cover preview">
                                </div>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                    <label for="cover" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-purple-600 dark:text-purple-400 hover:text-purple-500 focus-within:outline-none">
                                        <span>{{ __('message.Click to upload') }}</span>
                                        <input id="cover" name="cover" type="file" class="sr-only" accept="image/*">
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

                    <!-- City -->
                    <div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
                        <label for="city_id" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-map-marker-alt mr-2 text-purple-600"></i>
                            {{ __('message.City') }}
                        </label>
                        <select id="city_id" 
                                name="city_id" 
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('city_id') ? 'border-red-500 ring-2 ring-red-200' : '' }}">
                            <option value="">{{ __('message.Select City') }}</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ $user->vendor->city_id == $city->id ? 'selected' : '' }}>
                                    {{ $city->name_arabic }} ({{ $city->name_english }})
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

                    <!-- Status -->
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        <label for="status" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-toggle-on mr-2 text-purple-600"></i>
                            {{ __('message.Status') }}
                        </label>
                        <select id="status" 
                                name="status" 
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('status') ? 'border-red-500 ring-2 ring-red-200' : '' }}">
                            <option value="pending" {{ $user->vendor->status == 'pending' ? 'selected' : '' }}>{{ __('message.Pending') }}</option>
                            <option value="accepted" {{ $user->vendor->status == 'accepted' ? 'selected' : '' }}>{{ __('message.Accepted') }}</option>
                            <option value="rejected" {{ $user->vendor->status == 'rejected' ? 'selected' : '' }}>{{ __('message.Rejected') }}</option>
                        </select>
                        @if ($errors->has('status'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('status') }}
                            </div>
                        @endif
                    </div>

                    <!-- Address -->
                    <div class="form-group col-span-1 lg:col-span-2 {{ $errors->has('address') ? 'has-error' : '' }}">
                        <label for="address" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-map-marked-alt mr-2 text-purple-600"></i>
                            {{ __('message.Address') }}
                        </label>
                        <textarea id="address" 
                                  name="address" 
                                  rows="3" 
                                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('address') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                  placeholder="{{ __('Enter vendor address') }}">{{ $user->vendor->address }}</textarea>
                        @if ($errors->has('address'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Social Links Section -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                <h4 class="text-lg font-medium text-gray-900 dark:text-white flex items-center mb-4">
                    <i class="fas fa-share-alt mr-2 text-purple-600"></i>
                    {{ __('message.Social Media Links') }}
                </h4>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Whatsapp -->
                    <div class="form-group {{ $errors->has('whatsapp') ? 'has-error' : '' }}">
                        <label for="whatsapp" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fab fa-whatsapp mr-2 text-purple-600"></i>
                            {{ __('message.Whatsapp') }}
                        </label>
                        <input type="text" 
                               id="whatsapp" 
                               name="whatsapp" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('whatsapp') ? 'border-red-500 ring-2 ring-red-200' : '' }}" 
                               value="{{ $user->vendor->whatsapp }}"
                               placeholder="{{ __('Enter WhatsApp number') }}">
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
                        <input type="text" 
                               id="facebook" 
                               name="facebook" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('facebook') ? 'border-red-500 ring-2 ring-red-200' : '' }}" 
                               value="{{ $user->vendor->facebook }}"
                               placeholder="{{ __('Enter Facebook URL') }}">
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
                        <input type="text" 
                               id="instagram" 
                               name="instagram" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('instagram') ? 'border-red-500 ring-2 ring-red-200' : '' }}" 
                               value="{{ $user->vendor->instagram }}"
                               placeholder="{{ __('Enter Instagram URL') }}">
                        @if ($errors->has('instagram'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('instagram') }}
                            </div>
                        @endif
                    </div>

                    <!-- Google Map -->
                    <div class="form-group {{ $errors->has('google_map') ? 'has-error' : '' }}">
                        <label for="google_map" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-map-marker-alt mr-2 text-purple-600"></i>
                            {{ __('message.Google Map Link') }}
                        </label>
                        <input type="text" 
                               id="google_map" 
                               name="google_map" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('google_map') ? 'border-red-500 ring-2 ring-red-200' : '' }}" 
                               value="{{ $user->vendor->google_map }}"
                               placeholder="{{ __('Enter Google Map URL') }}">
                        @if ($errors->has('google_map'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('google_map') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-8 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-medium rounded-xl shadow-lg hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-200 flex items-center">
                    <i class="fas fa-save mr-2"></i>
                    {{ __('message.Update Vendor') }}
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

    // Cover preview
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
});
</script>
@endpush
@endsection
                           placeholder="أدخل رقم الهاتف">
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
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">الحجم الموصى به: 200x200 بكسل</p>
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
                               placeholder="اتركه فارغاً للاحتفاظ بكلمة المرور الحالية">
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
                           placeholder="تأكيد كلمة المرور الجديدة">
                    @if ($errors->has('password_confirmation'))
                        <p class="form-error">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>
            </div>

            <!-- Brand Information Section -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">معلومات العلامة التجارية</h4>
                
                <!-- Current Brand Images Preview -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                    <div class="text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">الغلاف الحالي</p>
                        <div class="w-full h-24 rounded-lg overflow-hidden bg-gray-200 dark:bg-gray-700">
                            @if($user->vendor->cover)
                                <img src="{{ asset($user->vendor->cover) }}" 
                                     alt="Cover" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">الشعار الحالي</p>
                        <div class="w-16 h-16 mx-auto rounded-lg overflow-hidden bg-gray-200 dark:bg-gray-700">
                            @if($user->vendor->logo)
                                <img src="{{ asset($user->vendor->logo) }}" 
                                     alt="Logo" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-store text-gray-400"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Brand Name -->
                    <div class="lg:col-span-2">
                        <div class="form-group {{ $errors->has('name_of_brand') ? 'has-error' : '' }}">
                            <label for="name_of_brand" class="form-label">{{ __('message.Name Of Brand') }} <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   id="name_of_brand" 
                                   name="name_of_brand" 
                                   class="form-input {{ $errors->has('name_of_brand') ? 'border-red-500' : '' }}" 
                                   value="{{ $user->vendor->name }}" 
                                   required
                                   placeholder="أدخل اسم العلامة التجارية">
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
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">الحجم الموصى به: 1200x400 بكسل</p>
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
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">الحجم الموصى به: 300x300 بكسل</p>
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
                                      placeholder="أدخل وصف العلامة التجارية">{{ $user->vendor->description }}</textarea>
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
                            <option value="">اختر الفئة</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $user->vendor->category_id == $category->id ? 'selected' : '' }}>
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
                            @php
                                $cities_id = json_decode($user->vendor->citys_id, true) ?? [];
                            @endphp
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
                        @if ($errors->has('city_ids'))
                            <p class="form-error">{{ $errors->first('city_ids') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">معلومات الاتصال</h4>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Address -->
                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                        <label for="address" class="form-label">{{ __('message.Address') }} <span class="text-red-500">*</span></label>
                        <input type="text" 
                               id="address" 
                               name="address" 
                               class="form-input {{ $errors->has('address') ? 'border-red-500' : '' }}" 
                               value="{{ $user->vendor->address }}" 
                               required
                               placeholder="أدخل العنوان">
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
                               value="{{ $user->vendor->whatsapp }}"
                               placeholder="أدخل رقم الواتساب">
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
                               value="{{ $user->vendor->facebook }}"
                               placeholder="أدخل رابط الفيسبوك">
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
                               value="{{ $user->vendor->instagram }}"
                               placeholder="أدخل رابط الإنستغرام">
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
                               value="{{ $user->vendor->google_map_link }}"
                               placeholder="أدخل رابط خرائط جوجل">
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
                            <option value="pending" {{ $user->vendor->status == 'pending' ? 'selected' : '' }}>{{ __('message.Pending') }}</option>
                            <option value="accepted" {{ $user->vendor->status == 'accepted' ? 'selected' : '' }}>{{ __('message.Accepted') }}</option>
                            <option value="rejected" {{ $user->vendor->status == 'rejected' ? 'selected' : '' }}>{{ __('message.Rejected') }}</option>
                        </select>
                        @if ($errors->has('status'))
                            <p class="form-error">{{ $errors->first('status') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Account Status Section -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">إعدادات الحساب</h4>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Account Status -->
                    <div class="form-group {{ $errors->has('status_of_account') ? 'has-error' : '' }}">
                        <label for="status_of_account" class="form-label">{{ __('message.Status of Account') }} <span class="text-red-500">*</span></label>
                        <select id="status_of_account" 
                                name="status_of_account" 
                                class="form-select {{ $errors->has('status_of_account') ? 'border-red-500' : '' }}" 
                                required>
                            <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>{{ __('message.Active') }}</option>
                            <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>{{ __('message.Inactive') }}</option>
                        </select>
                        @if ($errors->has('status_of_account'))
                            <p class="form-error">{{ $errors->first('status_of_account') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Edit') }}
                </button>
                <a href="{{ route('admin.vendors.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times mr-2 rtl:ml-2 rtl:mr-0"></i>
                    إلغاء
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
            placeholder: 'اختر المدن',
            allowClear: true
        });
    }
});
</script>
@endpush
@endsection
