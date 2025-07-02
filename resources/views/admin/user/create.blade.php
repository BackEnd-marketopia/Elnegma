@extends('admin.layouts.app')
@section('title', 'Add User')
@section('page-title', __('message.Add User'))
@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('Admin') }}</span>
    <span class="mx-2">/</span>
    <a href="{{ route('admin.users.index') }}" class="text-primary-600 dark:text-primary-400 hover:underline">{{ __('message.Users') }}</a>
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
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ __('Create a new user account') }}
            </p>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" 
                    class="btn btn-primary" 
                    id="addCode"
                    data-bs-toggle="modal" 
                    data-bs-target="#addCodeModal">
                <i class="fas fa-plus mr-2 rtl:ml-2 rtl:mr-0"></i>
                {{ __('message.Add Code') }}
            </button>
        </div>
    </div>

    <!-- User Form Card -->
    <div class="card-modern">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                {{ __('User Information') }}
            </h3>
        </div>
        
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name Field -->
                <div class="form-group">
                    <label for="name" class="form-label">{{ __('message.Name') }} <span class="text-red-500">*</span></label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           class="form-input {{ $errors->has('name') ? 'border-red-500' : '' }}" 
                           value="{{ old('name') }}" 
                           required>
                    @if ($errors->has('name'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="form-label">{{ __('message.Email') }}</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-input {{ $errors->has('email') ? 'border-red-500' : '' }}" 
                           value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Phone Field -->
                <div class="form-group">
                    <label for="phone" class="form-label">{{ __('message.Phone') }} <span class="text-red-500">*</span></label>
                    <input type="text" 
                           id="phone" 
                           name="phone" 
                           class="form-input {{ $errors->has('phone') ? 'border-red-500' : '' }}" 
                           value="{{ old('phone') }}" 
                           required>
                    @if ($errors->has('phone'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('phone') }}</p>
                    @endif
                </div>

                <!-- Profile Image Field -->
                <div class="form-group">
                    <label for="image" class="form-label">{{ __('message.Profile Image') }}</label>
                    <input type="file" 
                           id="image" 
                           name="image" 
                           class="form-input {{ $errors->has('image') ? 'border-red-500' : '' }}" 
                           accept="image/*">
                    @if ($errors->has('image'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('image') }}</p>
                    @endif
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">{{ __('message.Password') }}</label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-input pr-10 {{ $errors->has('password') ? 'border-red-500' : '' }}">
                        <button type="button" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center" 
                                onclick="togglePassword('password')">
                            <i id="password-eye" class="fas fa-eye text-gray-400 hover:text-primary-600"></i>
                        </button>
                    </div>
                    @if ($errors->has('password'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">{{ __('message.Confirm Password') }}</label>
                    <div class="relative">
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="form-input pr-10 {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }}">
                        <button type="button" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center" 
                                onclick="togglePassword('password_confirmation')">
                            <i id="password_confirmation-eye" class="fas fa-eye text-gray-400 hover:text-primary-600"></i>
                        </button>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>

                <!-- City Field -->
                <div class="form-group md:col-span-2">
                    <label for="city_id" class="form-label">{{ __('message.City') }} <span class="text-red-500">*</span></label>
                    <select id="city_id" 
                            name="city_id" 
                            class="form-input {{ $errors->has('city_id') ? 'border-red-500' : '' }}" 
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
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Add') }}
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Code Generation Modal -->
<div class="modal fade" id="addCodeModal" tabindex="-1" aria-labelledby="addCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-gray-900 dark:text-white" id="addCodeModalLabel">
                    {{ __('message.Add Code') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="space-y-4">
                    <!-- One Year Checkbox -->
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="oneYearCheckbox" 
                               name="one_year" 
                               value="1"
                               class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="oneYearCheckbox" class="ml-2 rtl:mr-2 rtl:ml-0 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ __('message.Valid for 1 Year') }}
                        </label>
                    </div>

                    <!-- Date Fields -->
                    <div id="dateFields" class="space-y-4">
                        <div>
                            <label for="start_date" class="form-label">{{ __('message.Start Date') }}</label>
                            <input type="date" 
                                   id="start_date" 
                                   name="start_date" 
                                   class="form-input">
                        </div>
                        <div>
                            <label for="end_date" class="form-label">{{ __('message.End Date') }}</label>
                            <input type="date" 
                                   id="end_date" 
                                   name="end_date" 
                                   class="form-input">
                        </div>
                    </div>

                    <!-- Validation Error -->
                    <div id="validationError" class="alert-error hidden">
                        {{ __('message.Please select an option') }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('Cancel') }}
                </button>
                <button type="button" class="btn btn-primary" id="checkCodes">
                    {{ __('message.Add') }}
                </button>
            </div>
        </div>
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

        // AJAX call to check codes
        fetch("{{ route('admin.check.codes') }}", {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.has_codes) {
                document.getElementById('addCode').innerHTML = 
                    '<i class="fas fa-edit mr-2 rtl:ml-2 rtl:mr-0"></i>{{ __('message.Edit Code') }}';
                bootstrap.Modal.getInstance(document.getElementById('addCodeModal')).hide();
            } else {
                // Show error in modal
                if (!document.getElementById('codeError')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.id = 'codeError';
                    errorDiv.className = 'alert-error mt-3';
                    errorDiv.textContent = '{{ __('message.You do not have any codes') }}';
                    document.querySelector('.modal-body').appendChild(errorDiv);
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });
});
</script>
@endpush
@endsection <input
                           id="name" 
                           name="name" 
                           class="form-input {{ $errors->has('name') ? 'border-red-500' : '' }}" 
                           value="{{ old('name') }}" 
                           required>
                    @if ($errors->has('name'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="form-label">{{ __('message.Email') }}</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-input {{ $errors->has('email') ? 'border-red-500' : '' }}" 
                           value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Phone Field -->
                <div class="form-group">
                    <label for="phone" class="form-label">{{ __('message.Phone') }} <span class="text-red-500">*</span></label>
                    <input type="text" 
                           id="phone" 
                           name="phone" 
                           class="form-input {{ $errors->has('phone') ? 'border-red-500' : '' }}" 
                           value="{{ old('phone') }}" 
                           required>
                    @if ($errors->has('phone'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('phone') }}</p>
                    @endif
                </div>

                <!-- Profile Image Field -->
                <div class="form-group">
                    <label for="image" class="form-label">{{ __('message.Profile Image') }}</label>
                    <input type="file" 
                           id="image" 
                           name="image" 
                           class="form-input {{ $errors->has('image') ? 'border-red-500' : '' }}" 
                           accept="image/*">
                    @if ($errors->has('image'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('image') }}</p>
                    @endif
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">{{ __('message.Password') }}</label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="form-input pr-10 {{ $errors->has('password') ? 'border-red-500' : '' }}">
                        <button type="button" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center" 
                                onclick="togglePassword('password')">
                            <i id="password-eye" class="fas fa-eye text-gray-400 hover:text-primary-600"></i>
                        </button>
                    </div>
                    @if ($errors->has('password'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Confirm Password Field -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">{{ __('message.Confirm Password') }}</label>
                    <div class="relative">
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               class="form-input pr-10 {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }}">
                        <button type="button" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center" 
                                onclick="togglePassword('password_confirmation')">
                            <i id="password_confirmation-eye" class="fas fa-eye text-gray-400 hover:text-primary-600"></i>
                        </button>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <p class="text-red-500 text-sm mt-1">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>

                <!-- City Field -->
                <div class="form-group md:col-span-2">
                    <label for="city_id" class="form-label">{{ __('message.City') }} <span class="text-red-500">*</span></label>
                    <select id="city_id" 
                            name="city_id" 
                            class="form-input {{ $errors->has('city_id') ? 'border-red-500' : '' }}" 
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
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Add') }}
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Code Generation Modal -->
<div class="modal fade" id="addCodeModal" tabindex="-1" aria-labelledby="addCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-gray-900 dark:text-white" id="addCodeModalLabel">
                    {{ __('message.Add Code') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="space-y-4">
                    <!-- One Year Checkbox -->
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="oneYearCheckbox" 
                               name="one_year" 
                               value="1"
                               class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="oneYearCheckbox" class="ml-2 rtl:mr-2 rtl:ml-0 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ __('message.Valid for 1 Year') }}
                        </label>
                    </div>

                    <!-- Date Fields -->
                    <div id="dateFields" class="space-y-4">
                        <div>
                            <label for="start_date" class="form-label">{{ __('message.Start Date') }}</label>
                            <input type="date" 
                                   id="start_date" 
                                   name="start_date" 
                                   class="form-input">
                        </div>
                        <div>
                            <label for="end_date" class="form-label">{{ __('message.End Date') }}</label>
                            <input type="date" 
                                   id="end_date" 
                                   name="end_date" 
                                   class="form-input">
                        </div>
                    </div>

                    <!-- Validation Error -->
                    <div id="validationError" class="alert-error hidden">
                        {{ __('message.Please select an option') }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ __('Cancel') }}
                </button>
                <button type="button" class="btn btn-primary" id="checkCodes">
                    {{ __('message.Add') }}
                </button>
            </div>
        </div>
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

        // AJAX call to check codes
        fetch("{{ route('admin.check.codes') }}", {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.has_codes) {
                document.getElementById('addCode').innerHTML = 
                    '<i class="fas fa-edit mr-2 rtl:ml-2 rtl:mr-0"></i>{{ __('message.Edit Code') }}';
                bootstrap.Modal.getInstance(document.getElementById('addCodeModal')).hide();
            } else {
                // Show error in modal
                if (!document.getElementById('codeError')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.id = 'codeError';
                    errorDiv.className = 'alert-error mt-3';
                    errorDiv.textContent = '{{ __('message.You do not have any codes') }}';
                    document.querySelector('.modal-body').appendChild(errorDiv);
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    });
});
</script>
@endpush
@endsection
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                                                    <label
                                                        for="password_confirmation">{{ __('message.Confirm Password') }}</label>
                                                    <input type="password" class="form-control" id="password_confirmation"
                                                        name="password_confirmation">
                                                </div>
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group {{ $errors->has('city_id') ? ' has-danger' : '' }}">
                                                    <label for="city_id">{{ __('message.City') }}</label>
                                                    <select class="form-control" id="city_id" name="city_id" required>
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
                                                </div>
                                                @if ($errors->has('city_id'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('city_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Code Generation Modal -->
                                            <div class="modal fade" id="addCodeModal" tabindex="-1"
                                                aria-labelledby="addCodeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addCodeModalLabel">
                                                                {{ __('message.Add Code') }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>
                                                                    <input type="checkbox" id="oneYearCheckbox"
                                                                        name="one_year" value="1">
                                                                    {{ __('message.Valid for 1 Year') }}
                                                                </label>
                                                            </div>
                                                            <div id="dateFields" style="display: block;">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="start_date">{{ __('message.Start Date') }}</label>
                                                                    <input type="date" class="form-control" id="start_date"
                                                                        name="start_date">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="end_date">{{ __('message.End Date') }}</label>
                                                                    <input type="date" class="form-control" id="end_date"
                                                                        name="end_date">
                                                                </div>
                                                            </div>
                                                            <div id="validationError" class="alert alert-danger mt-3"
                                                                style="display: none;">
                                                                {{ __('message.Please select an option') }}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                id="checkCodes">{{ __('message.Add') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button class="btn btn-secondary"
                                                        type="submit">{{ __('message.Add') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('oneYearCheckbox').addEventListener('change', function () {
            const dateFields = document.getElementById('dateFields');
            if (this.checked) {
                dateFields.style.display = 'none';
            } else {
                dateFields.style.display = 'block';
            }
        });
    </script>
    <script>
        function isAnyOptionSelected() {
            return document.getElementById("oneYearCheckbox").checked || document.getElementById("start_date").value || document.getElementById("end_date").value;
        }
        function updateButtonText() {
            if (isAnyOptionSelected()) {
                addCodeButton.textContent = "{{ __('message.Edit Code') }}";
            } else {
                addCodeButton.textContent = "{{ __('message.Add Code') }}";
            }
        }
        $(document).ready(function () {
            var validationError = document.getElementById("validationError");
            $('#checkCodes').click(function () {
                if (!isAnyOptionSelected()) {
                    validationError.style.display = "block";
                    return;
                } else {
                    validationError.style.display = "none";
                }
                $.ajax({
                    url: "{{ route('admin.check.codes') }}",
                    type: "GET",
                    success: function (response) {
                        if (response.has_codes) {
                            document.getElementById('addCode').innerHTML = "{{ __('message.Edit Code') }}";
                            $('#addCodeModal').modal('hide');
                        } else {
                            if ($('#codeError').length === 0) {
                                $(".modal-body").append('<div id="codeError" class="alert alert-danger mt-3">{{ __('message.You do not have any codes') }}</div>');
                            }
                        }
                    },
                    error: function () {
                        alert("An error occurred. Please try again.");
                    }
                });
            });
        });
    </script>
@endsection