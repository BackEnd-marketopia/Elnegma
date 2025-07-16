@extends('admin.layouts.app')
@section('title', __('message.Add User Discount'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Dashboard') }}</span>
    <span class="mx-2">/</span>
    <span class="text-primary-600 dark:text-primary-400">
        <a href="{{ route('admin.discounts.index', $discountId) }}" class="hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            {{ __('message.Discounts') }}
        </a>
    </span>
    <span class="mx-2">/</span>
    <span class="text-primary-600 dark:text-primary-400">
        <a href="{{ route('admin.discounts.users.index', $discountId) }}" class="hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
            {{ __('message.User Discounts') }}
        </a>
    </span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Add') }}</span>
@endsection

@section('content')
        <div class="space-y-6 animate-fadeInUp">
            <!-- Header Section -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ __('message.Add User Discount') }}
                    </h1>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.discounts.users.index', $discountId) }}" 
                       class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0 rtl:rotate-180"></i>
                        {{ __('message.Back') }}
                    </a>
                </div>
            </div>

            <!-- User Discount Create Form Card -->
            <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse"> 
                        <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                            <i class="fas fa-plus text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">
                                {{ __('message.New User Discount Information') }}
                            </h3>
                            <p class="text-purple-100 text-sm">
                                {{ __('message.Fill in the user discount details below') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <form action="{{ route('admin.discounts.users.store', $discountId) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- User Selection -->
                    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                        <label for="user_id" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-user mr-2 text-purple-600"></i>
                            {{ __('message.User') }} 
                            <span class="text-red-500">*</span>
                        </label>
                        <select name="user_id" 
                               id="user_id" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('user_id') ? 'border-red-500 ring-2 ring-red-200' : '' }}">
                            <option value="">{{ __('message.Select User') }}</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} {{ "-" }}{{ $user->phone }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('user_id'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('user_id') }}
                            </div>
                        @endif
                    </div>

                    <!-- Status -->
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        <label for="status" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-toggle-on mr-2 text-purple-600"></i>
                            {{ __('message.Status') }} 
                            <span class="text-red-500">*</span>
                        </label>
                        <select name="status" 
                               id="status" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('status') ? 'border-red-500 ring-2 ring-red-200' : '' }}">
                            <option value="">{{ __('message.Select Status') }}</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                                {{ __('message.Pending') }}
                            </option>
                            <option value="accepted" {{ old('status') == 'accepted' ? 'selected' : '' }}>
                                {{ __('message.Accepted') }}
                            </option>
                            <option value="canceled" {{ old('status') == 'canceled' ? 'selected' : '' }}>
                                {{ __('message.Canceled') }}
                            </option>
                        </select>
                        @if ($errors->has('status'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('status') }}
                            </div>
                        @endif
                    </div>

                    <!-- Price -->
                    <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                        <label for="price" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-dollar-sign mr-2 text-purple-600"></i>
                            {{ __('message.Price') }}
                        </label>
                        <input type="number" 
                               step="0.01" 
                               min="0" 
                               id="price" 
                               name="price" 
                               value="{{ old('price') }}"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('price') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                               placeholder="{{ __('message.Enter Price') }}">
                        @if ($errors->has('price'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('price') }}
                            </div>
                        @endif
                    </div>

                    <!-- Final Price -->
                    <div class="form-group {{ $errors->has('final_price') ? 'has-error' : '' }}">
                        <label for="final_price" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            <i class="fas fa-money-bill mr-2 text-purple-600"></i>
                            {{ __('message.Final Price') }}
                        </label>
                        <input type="number" 
                               step="0.01" 
                               min="0" 
                               id="final_price" 
                               name="final_price" 
                               value="{{ old('final_price') }}"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('final_price') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                               placeholder="{{ __('message.Enter Final Price') }}">
                        @if ($errors->has('final_price'))
                            <div class="mt-2 flex items-center text-red-600 text-sm">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $errors->first('final_price') }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Comment -->
                <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                    <label for="comment" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                        <i class="fas fa-comment mr-2 text-purple-600"></i>
                        {{ __('message.Comment') }}
                    </label>
                    <textarea id="comment" 
                              name="comment" 
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-none {{ $errors->has('comment') ? 'border-red-500 ring-2 ring-red-200' : '' }}"
                              placeholder="{{ __('message.Enter Comment') }}">{{ old('comment') }}</textarea>
                    @if ($errors->has('comment'))
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first('comment') }}
                        </div>
                    @endif
                </div>

                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" 
                            class="btn btn-primary flex-1 sm:flex-none">
                        <i class="fas fa-save mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Save') }}
                    </button>

                    <a href="{{ route('admin.discounts.users.index', $discountId) }}" 
                       class="btn btn-secondary flex-1 sm:flex-none">
                        <i class="fas fa-times mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Cancel') }}
                    </a>

                    <button type="reset" 
                            class="btn btn-info flex-1 sm:flex-none">
                        <i class="fas fa-undo mr-2 rtl:ml-2 rtl:mr-0"></i>
                        {{ __('message.Reset') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            // Form validation and enhancements
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('form');
                const resetBtn = document.querySelector('button[type="reset"]');
                
                // Reset button confirmation
                resetBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Reset Form?',
                        text: 'This will clear all form data',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#6b7280',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, reset it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.reset();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
