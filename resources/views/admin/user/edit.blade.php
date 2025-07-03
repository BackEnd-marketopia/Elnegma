@extends('admin.layouts.app')
@section('title', __('message.Edit User'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Dashboard') }}</span>
    <span class="mx-2">/</span>
    <span class="text-primary-600 dark:text-primary-400">
        <a href="{{ route('admin.users.index') }}" class="hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            {{ __('message.Users') }}
        </a>
    </span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Edit User') }}</span>
@endsection

@section('content')
    <div class="space-y-6 animate-fadeInUp">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('message.Edit User') }}
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    {{ __('message.Edit Informantion of User:') }} <span class="font-semibold text-purple-600 dark:text-purple-400">{{ $user->name }}</span>
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.users.index') }}" 
                    class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0 rtl:rotate-180"></i>
                    {{ __('message.Back to Users') }}
                </a>
            </div>
        </div>

        <!-- User Edit Form Card -->
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6">
                <div class="flex items-center space-x-3 rtl:space-x-reverse">
                    <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                        <i class="fas fa-user-edit text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">
                            {{ __('message.User Information') }}
                        </h3>
                        <p class="text-purple-100 text-sm">
                            {{ __('message.Update user details below') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Current Image Preview -->
            @if($user->image)
            <div class="mt-6 px-6">
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                    <i class="fas fa-image mr-2"></i>
                    {{ __('message.Current Image') }}
                </label>
                <div class="flex justify-center">
                    <div class="relative group">
                        <div class="w-32 h-32 rounded-full overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-4 ring-purple-200 dark:ring-purple-800">
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

            <!-- Form Content -->
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Name Field -->
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-user mr-2 text-purple-600"></i>
                            {{ __('message.Name') }} 
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $user->name) }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('name') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                placeholder="{{ __('message.Enter user name') }}"
                                required>
                        @if ($errors->has('name'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <!-- Email Field -->
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-envelope mr-2 text-purple-600"></i>
                            {{ __('message.Email') }}
                        </label>
                        <input type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', $user->email) }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('email') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                placeholder="{{ __('message.Enter user email') }}">
                        @if ($errors->has('email'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <!-- Phone Field -->
                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                        <label for="phone" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-phone mr-2 text-purple-600"></i>
                            {{ __('message.Phone') }} 
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                                id="phone" 
                                name="phone" 
                                value="{{ old('phone', $user->phone) }}"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('phone') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                placeholder="{{ __('message.Enter user phone') }}"
                                required>
                        @if ($errors->has('phone'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>

                    <!-- Profile Image Field -->
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
                            {{ __('message.Recommended size') }}: 300x300px | {{ __('message.Max size') }}: 2MB
                        </p>
                        @if ($errors->has('image'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('image') }}
                            </div>
                        @endif
                    </div>

                    <!-- Card Image Field -->
                    <div class="form-group {{ $errors->has('card_image') ? 'has-error' : '' }}">
                        <label for="card_image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-id-card mr-2 text-purple-600"></i>
                            {{ __('message.Card Image') }}
                        </label>
                        <div class="relative">
                            <input type="file" 
                                   id="card_image" 
                                   name="card_image" 
                                   accept="image/*"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 dark:file:bg-purple-900 dark:file:text-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('card_image') ? 'border-red-500 ring-2 ring-red-200' : '' }}">
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                <i class="fas fa-upload text-gray-400"></i>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            {{ __('message.Recommended size') }}: 800x500px | {{ __('message.Max size') }}: 5MB
                        </p>
                        @if ($errors->has('card_image'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('card_image') }}
                            </div>
                        @endif
                    </div>

                    <!-- Current Card Image Preview -->
                    @if($user->card_image)
                    <div class="col-span-2 mt-4">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">
                            <i class="fas fa-id-card mr-2"></i>
                            {{ __('message.Current Card Image') }}
                        </label>
                        <div class="flex justify-center">
                            <div class="relative group">
                                <div class="w-64 h-40 rounded-lg overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-4 ring-purple-200 dark:ring-purple-800">
                                    <img src="{{ asset($user->card_image) }}" 
                                         alt="{{ $user->name }} Card" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                </div>
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 rounded-lg transition-all duration-300 flex items-center justify-center">
                                    <i class="fas fa-search-plus text-white opacity-0 group-hover:opacity-100 text-2xl transition-opacity duration-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- City Field -->
                    <div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
                        <label for="city_id" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-map-marker-alt mr-2 text-purple-600"></i>
                            {{ __('message.City') }}
                            <span class="text-red-500">*</span>
                        </label>
                        <select 
                            id="city_id" 
                            name="city_id" 
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('city_id') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                            required>
                            <option value="">{{ __('message.Select City') }}</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ $user->city_id == $city->id ? 'selected' : '' }}>
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

                    <!-- Password Field -->
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-lock mr-2 text-purple-600"></i>
                            {{ __('message.Password') }}
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="w-full px-4 py-3 pr-12 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('password') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                   placeholder="{{ __('message.Leave empty to keep current password') }}">
                            <div class="absolute inset-y-0 right-3 flex items-center">
                                <button type="button" id="togglePassword" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none">
                                    <i id="eye-icon" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            {{ __('message.Leave empty to keep current password') }}
                        </p>
                        @if ($errors->has('password'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <!-- Password Confirmation Field -->
                    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-lock mr-2 text-purple-600"></i>
                            {{ __('message.Confirm Password') }}
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   class="w-full px-4 py-3 pr-12 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('password_confirmation') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                   placeholder="{{ __('message.Confirm new password') }}">
                            <div class="absolute inset-y-0 right-3 flex items-center">
                                <button type="button" id="toggleConfirmPassword" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none">
                                    <i id="confirm-eye-icon" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                    </div>
                    <!-- Status Field -->
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} lg:col-span-2">
                        <label for="status" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-toggle-on mr-2 text-purple-600"></i>
                            {{ __('message.Status') }}
                            <span class="text-red-500">*</span>
                        </label>
                        <select id="status" name="status"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('status') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                            required>
                            <option value="">{{ __('message.Select Status') }}</option>
                            <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>{{ __('message.Active') }}</option>
                            <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>{{ __('message.Inactive') }}</option>
                        </select>
                        @if ($errors->has('status'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('status') }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4 rtl:space-x-reverse pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Cancel') }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Update User') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        // Toggle confirm password visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const confirmEyeIcon = document.getElementById('confirm-eye-icon');

            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                confirmEyeIcon.classList.remove('fa-eye');
                confirmEyeIcon.classList.add('fa-eye-slash');
            } else {
                confirmPasswordInput.type = 'password';
                confirmEyeIcon.classList.remove('fa-eye-slash');
                confirmEyeIcon.classList.add('fa-eye');
            }
        });
    </script>
    @endpush
@endsection