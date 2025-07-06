@extends('admin.layouts.app')
@section('title', __('message.Configurations'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Dashboard') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Configurations') }}</span>
@endsection

@section('content')
<div class="space-y-6 animate-fadeInUp">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('message.Configurations') }}
            </h1>
        </div>
    </div>
    <!-- Configuration Form Card -->
    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 p-6">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <div class="p-3 bg-white bg-opacity-20 rounded-xl">
                    <i class="fas fa-cogs text-white text-xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white">
                    {{ __('message.System Configurations') }}
                </h3>
            </div>
        </div>
        
        <form action="{{ route('admin.configStore', $config->id) }}" method="POST" enctype="multipart/form-data" id="configForm">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">
                                <!-- App Versions Section -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-xl">
                    <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-mobile-alt mr-2 text-purple-600"></i>
                        {{ __('message.App Versions') }}
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="android_version" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fab fa-android mr-2 text-purple-600"></i>
                                {{ __('message.android_version') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="android_version" 
                                   name="android_version" 
                                   value="{{ $config->android_version }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('android_version') ? 'border-red-500' : '' }}"
                                   required>
                            @if ($errors->has('android_version'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('android_version') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="ios_version" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fab fa-apple mr-2 text-purple-600"></i>
                                {{ __('message.ios_version') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="ios_version" 
                                   name="ios_version" 
                                   value="{{ $config->ios_version }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('ios_version') ? 'border-red-500' : '' }}"
                                   required>
                            @if ($errors->has('ios_version'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('ios_version') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="android_url" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-link mr-2 text-purple-600"></i>
                                {{ __('message.android_url') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="url" 
                                   id="android_url" 
                                   name="android_url" 
                                   value="{{ $config->android_url }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('android_url') ? 'border-red-500' : '' }}"
                                   required>
                            @if ($errors->has('android_url'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('android_url') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="ios_url" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-link mr-2 text-purple-600"></i>
                                {{ __('message.ios_url') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="url" 
                                   id="ios_url" 
                                   name="ios_url" 
                                   value="{{ $config->ios_url }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('ios_url') ? 'border-red-500' : '' }}"
                                   required>
                            @if ($errors->has('ios_url'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('ios_url') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                                <!-- Legal Content Section -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-xl">
                    <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-file-contract mr-2 text-purple-600"></i>
                        {{ __('message.Legal Content') }}
                    </h4>
                    <div class="space-y-6">
                        <div>
                            <label for="terms_and_conditions" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-scroll mr-2 text-purple-600"></i>
                                {{ __('message.terms_and_conditions') }} <span class="text-red-500">*</span>
                            </label>
                            <textarea id="terms_and_conditions" 
                                      name="terms_and_conditions" 
                                      rows="6"
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-vertical {{ $errors->has('terms_and_conditions') ? 'border-red-500' : '' }}"
                                      required>{{ $config->terms_and_conditions }}</textarea>
                            @if ($errors->has('terms_and_conditions'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('terms_and_conditions') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="about_us" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-info-circle mr-2 text-purple-600"></i>
                                {{ __('message.about_us') }} <span class="text-red-500">*</span>
                            </label>
                            <textarea id="about_us" 
                                      name="about_us" 
                                      rows="6"
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-vertical {{ $errors->has('about_us') ? 'border-red-500' : '' }}"
                                      required>{{ $config->about_us }}</textarea>
                            @if ($errors->has('about_us'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('about_us') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="privacy_policy" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-shield-alt mr-2 text-purple-600"></i>
                                {{ __('message.privacy_policy') }} <span class="text-red-500">*</span>
                            </label>
                            <textarea id="privacy_policy" 
                                      name="privacy_policy" 
                                      rows="6"
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-vertical {{ $errors->has('privacy_policy') ? 'border-red-500' : '' }}"
                                      required>{{ $config->privacy_policy }}</textarea>
                            @if ($errors->has('privacy_policy'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('privacy_policy') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                                <!-- Social Media Links Section -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-xl">
                    <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <i class="fas fa-share-alt mr-2 text-purple-600"></i>
                        {{ __('message.Social Media Links') }}
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="facebook_link" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fab fa-facebook mr-2 text-blue-600"></i>
                                {{ __('message.facebook_link') }}
                            </label>
                            <input type="url" 
                                   id="facebook_link" 
                                   name="facebook_link" 
                                   value="{{ $config->facebook_link }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('facebook_link') ? 'border-red-500' : '' }}">
                            @if ($errors->has('facebook_link'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('facebook_link') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="twitter_link" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fab fa-twitter mr-2 text-blue-400"></i>
                                {{ __('message.twitter_link') }}
                            </label>
                            <input type="url" 
                                   id="twitter_link" 
                                   name="twitter_link" 
                                   value="{{ $config->twitter_link }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('twitter_link') ? 'border-red-500' : '' }}">
                            @if ($errors->has('twitter_link'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('twitter_link') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="instagram_link" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fab fa-instagram mr-2 text-pink-600"></i>
                                {{ __('message.instagram_link') }}
                            </label>
                            <input type="url" 
                                   id="instagram_link" 
                                   name="instagram_link" 
                                   value="{{ $config->instagram_link }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('instagram_link') ? 'border-red-500' : '' }}">
                            @if ($errors->has('instagram_link'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('instagram_link') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="youtube_link" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fab fa-youtube mr-2 text-red-600"></i>
                                {{ __('message.youtube_link') }}
                            </label>
                            <input type="url" 
                                   id="youtube_link" 
                                   name="youtube_link" 
                                   value="{{ $config->youtube_link }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('youtube_link') ? 'border-red-500' : '' }}">
                            @if ($errors->has('youtube_link'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('youtube_link') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="snapchat_link" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fab fa-snapchat mr-2 text-yellow-400"></i>
                                {{ __('message.snapchat_link') }}
                            </label>
                            <input type="url" 
                                   id="snapchat_link" 
                                   name="snapchat_link" 
                                   value="{{ $config->snapchat_link }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('snapchat_link') ? 'border-red-500' : '' }}">
                            @if ($errors->has('snapchat_link'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('snapchat_link') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="tiktok_link" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fab fa-tiktok mr-2 text-black dark:text-white"></i>
                                {{ __('message.tiktok_link') }}
                            </label>
                            <input type="url" 
                                   id="tiktok_link" 
                                   name="tiktok_link" 
                                   value="{{ $config->tiktok_link }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('tiktok_link') ? 'border-red-500' : '' }}">
                            @if ($errors->has('tiktok_link'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('tiktok_link') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="whatsapp_link" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fab fa-whatsapp mr-2 text-green-600"></i>
                                {{ __('message.whatsapp_link') }}
                            </label>
                            <input type="url" 
                                   id="whatsapp_link" 
                                   name="whatsapp_link" 
                                   value="{{ $config->whatsapp_link }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('whatsapp_link') ? 'border-red-500' : '' }}">
                            @if ($errors->has('whatsapp_link'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('whatsapp_link') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="linkedin_link" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fab fa-linkedin mr-2 text-blue-700"></i>
                                {{ __('message.linkedin_link') }}
                            </label>
                            <input type="url" 
                                   id="linkedin_link" 
                                   name="linkedin_link" 
                                   value="{{ $config->linkedin_link }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('linkedin_link') ? 'border-red-500' : '' }}">
                            @if ($errors->has('linkedin_link'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('linkedin_link') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="telegram_link" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fab fa-telegram mr-2 text-blue-500"></i>
                                {{ __('message.telegram_link') }}
                            </label>
                            <input type="url" 
                                   id="telegram_link" 
                                   name="telegram_link" 
                                   value="{{ $config->telegram_link }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('telegram_link') ? 'border-red-500' : '' }}">
                            @if ($errors->has('telegram_link'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('telegram_link') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="website_link" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-globe mr-2 text-purple-600"></i>
                                {{ __('message.website_link') }}
                            </label>
                            <input type="url" 
                                   id="website_link" 
                                   name="website_link" 
                                   value="{{ $config->website_link }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 {{ $errors->has('website_link') ? 'border-red-500' : '' }}">
                            @if ($errors->has('website_link'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('website_link') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i>
                        {{ __('message.Save Changes') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission with loading state
    const configForm = document.getElementById('configForm');
    if (configForm) {
        configForm.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>{{ __("message.Saving") }}...';
                submitBtn.disabled = true;
            }
        });
    }
});
</script>