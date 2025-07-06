@extends('admin.layouts.app')
@section('title', __('message.Banners'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Dashboard') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Banners') }}</span>
@endsection

@section('content')
    <div class="space-y-6 animate-fadeInUp">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('message.Banners') }}
                </h1>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.banners.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-plus mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Add Banner') }}
                </a>
            </div>
        </div>

        <!-- Banners Table Card -->
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                            <i class="fas fa-image text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ __('message.Banners List') }}
                        </h3>
                    </div>
                    <form action="{{ route('admin.banners.search') }}" method="GET">
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                            <div class="relative">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                </div>
                                <input type="text" id="citySearch" name="search" value="{{ request('search') }}"
                                    class="block w-full pr-10 pl-3 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent shadow-sm hover:shadow-md transition-all duration-200"
                                    placeholder="{{ __('message.Search in banners') }}...">
                            </div>
                            <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                <button id="testSearchBtn" type="submit"
                                    class="px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <i class="fas fa-search mr-2 rtl:ml-2 rtl:mr-0"></i>
                                    {{ __('message.Search') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table id="add-row" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-purple-600 to-purple-700">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-image mr-2"></i>
                                {{ __('message.Image') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-font mr-2"></i>
                                {{ __('message.Name Arabic') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-language mr-2"></i>
                                {{ __('message.Name English') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider">
                                <i class="fas fa-cogs mr-2"></i>
                                {{ __('message.Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($banners as $banner)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center">
                                        <div class="w-16 h-16 rounded-xl overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-2 ring-gray-200 dark:ring-gray-600">
                                            @if($banner->image)
                                                <img src="{{ asset($banner->image) }}" 
                                                     alt="{{ $banner->name_english }}" 
                                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-200">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <i class="fas fa-image text-2xl text-gray-400 dark:text-gray-500"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-lg font-bold text-gray-900 dark:text-white">
                                        {{ $banner->name_arabic }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-lg font-medium text-gray-600 dark:text-gray-300">
                                        {{ $banner->name_english }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-3 rtl:space-x-reverse">
                                        <a href="{{ route('admin.banners.edit', $banner->id) }}"
                                           class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transform hover:scale-105 transition-all duration-200 shadow-lg"
                                           data-bs-toggle="tooltip" 
                                           title="{{ __('message.Edit Banner') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.banners.destroy', $banner->id) }}"
                                              method="POST" 
                                              style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 delete-btn transform hover:scale-105 transition-all duration-200 shadow-lg"
                                                    data-bs-toggle="tooltip" 
                                                    title="{{ __('message.Delete Banner') }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600 dark:text-gray-400">
                        {{ __('message.Page') }}: {{ $banners->currentPage() }} {{ __('message.of') }} {{ $banners->lastPage() }}
                    </div>
                    <div>
                        {{ $banners->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection