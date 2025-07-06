@extends('admin.layouts.app')
@section('title', __('message.Add User'))

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
    <span>{{ __('message.Add User') }}</span>
@endsection

@section('content')
    <div class="space-y-6 animate-fadeInUp">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('message.Add User') }}
                </h1>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.users.index') }}" 
                   class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0 rtl:rotate-180"></i>
                    {{ __('message.Back to Users') }}
                </a>
            </div>
        </div>

        <!-- User Create Form Card -->
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6">
                <div class="flex items-center space-x-3 rtl:space-x-reverse">
                    <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                        <i class="fas fa-user-plus text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white">
                            {{ __('message.New User Information') }}
                        </h3>
                        <p class="text-purple-100 text-sm">
                            {{ __('message.Fill in the user account details below') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form Content -->
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
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
                               value="{{ old('name') }}"
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
                               value="{{ old('email') }}"
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
                               value="{{ old('phone') }}"
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
                    <!-- City Field -->
                    <div class="form-group">
                        <label for="city_id" class="form-label">{{ __('message.City') }} <span class="text-red-500">*</span></label>
                        <select id="city_id" name="city_id" class="form-input {{ $errors->has('city_id') ? 'border-red-500' : '' }}"
                            required>
                            <option value="">{{ __('message.Select City') }}</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                    @if(app()->getLocale() == 'ar')
                                        {{ $city->name_arabic }}
                                    @else
                                        {{ $city->name_english }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('city_id'))
                            <p class="text-red-500 text-sm mt-1">{{ $errors->first('city_id') }}</p>
                        @endif
                    </div>
                    <!-- Profile Image Field -->
                    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                        <label for="image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-image mr-2 text-purple-600"></i>
                            {{ __('message.Profile Image') }}
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
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="file" id="card_image" name="card_image" accept="image/*"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 dark:file:bg-purple-900 dark:file:text-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('image') ? 'border-red-500 ring-2 ring-red-200' : '' }}">
                                <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                                    <i class="fas fa-upload text-gray-400"></i>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                {{ __('message.Recommended size') }}: 300x300px | {{ __('message.Max size') }}: 2MB
                            </p>
                            @if ($errors->has('card_image'))
                                <div class="mt-2 flex items-center text-red-600 text-sm">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $errors->first('card_image') }}
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
                            <input type="password" id="password" name="password"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('password') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                placeholder="{{ __('message.Enter password') }}" required>
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
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('password_confirmation') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                                placeholder="{{ __('message.Confirm password') }}" required>
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

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Create User') }}
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
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
        document.addEventListener('DOMContentLoaded', function() {
             // Toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(button => {
                button.addEventListener('click', function () {
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

            const oneYearCheckbox = document.getElementById('oneYearCheckbox');
            const dateFields = document.getElementById('dateFields');
            const validationError = document.getElementById('validationError');
            const checkCodesBtn = document.getElementById('checkCodes');

            // Toggle date fields based on checkbox
            oneYearCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    dateFields.style.display = 'none';
                } else {
                    dateFields.style.display = 'block';
                }
            });

            // Check if any option is selected
            function isAnyOptionSelected() {
                return oneYearCheckbox.checked || 
                       document.getElementById('start_date').value || 
                       document.getElementById('end_date').value;
            }

            // Handle code check
            checkCodesBtn.addEventListener('click', function() {
                if (!isAnyOptionSelected()) {
                    validationError.classList.remove('hidden');
                    return;
                } else {
                    validationError.classList.add('hidden');
                }

            });
        });
        </script>
    @endpush
@endsection