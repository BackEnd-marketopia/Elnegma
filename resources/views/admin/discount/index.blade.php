@extends('admin.layouts.app')
@section('title', 'Discounts')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Admin') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Discounts') }}</span>
@endsection

@section('content')
    <div class="space-y-6 animate-fadeInUp">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('message.Discounts') }}
                </h1>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.vendors.index') }}"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-gray-500/50">
                    <i class="fas fa-arrow-left mr-2 rtl:ml-2 rtl:mr-0 text-lg"></i>
                    {{ __('message.Back to Vendors') }}
                </a>
                <a href="{{ route('admin.discounts.create', $vendorId) }}"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-purple-500/50">
                    <i class="fas fa-plus mr-2 rtl:ml-2 rtl:mr-0 text-lg"></i>
                    {{ __('message.Add Discount') }}
                </a>
            </div>
        </div>

        <!-- Discounts Table Card -->
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center space-x-3 rtl:space-x-reverse">
                    <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                        <i class="fas fa-percent text-purple-600 dark:text-purple-400 text-xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ __('message.Discounts List') }}
                    </h3>
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
                                <i class="fas fa-heading mr-2"></i>
                                {{ __('message.Title') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-align-left mr-2"></i>
                                {{ __('message.Description') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-calendar-alt mr-2"></i>
                                {{ __('message.Start Date') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-calendar-times mr-2"></i>
                                {{ __('message.End Date') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-calendar-times mr-2"></i>
                                {{ __('message.View Count') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider">
                                <i class="fas fa-cogs mr-2"></i>
                                {{ __('message.Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($discounts as $discount)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex justify-center">
                                        <div class="w-16 h-16 rounded-xl overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-2 ring-gray-200 dark:ring-gray-600">
                                            @if($discount->image)
                                                <img src="{{ asset($discount->image) }}" 
                                                     alt="{{ $discount->title }}" 
                                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-200">
                                            @else
                                                <div class="flex items-center justify-center w-full h-full text-gray-400">
                                                    <i class="fas fa-percent text-2xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $discount->title }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="text-sm text-gray-600 dark:text-gray-300 max-w-xs mx-auto truncate">
                                        {{ Str::limit($discount->description, 50) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $discount->start_date }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $discount->end_date }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900 dark:text-white">
                                        {{ $discount->viwe_count }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2 rtl:space-x-reverse">
                                        <a href="{{ route('admin.discounts.edit', [$discount->id, $vendorId]) }}"
                                           class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transform hover:scale-105 transition-all duration-200 shadow-lg"
                                           data-bs-toggle="tooltip" 
                                           title="{{ __('message.Edit Discount') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.discounts.destroy', [$discount->id, $vendorId]) }}"
                                              method="POST" 
                                              style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 delete-btn transform hover:scale-105 transition-all duration-200 shadow-lg"
                                                    data-bs-toggle="tooltip" 
                                                    title="{{ __('message.Delete Discount') }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-percent text-4xl mb-4"></i>
                                        <p class="text-lg font-medium">{{ __('message.No discounts found') }}</p>
                                        <p class="text-sm">{{ __('message.Add your first discount to get started') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            @if($discounts->hasPages())
                <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            {{ __('message.Page') }}: {{ $discounts->currentPage() }} {{ __('message.of') }} {{ $discounts->lastPage() }}
                            <span class="mx-2">•</span>
                            {{ __('Total') }}: {{ $discounts->total() }} {{ __('discounts') }}
                        </div>
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            {{ $discounts->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        // Delete confirmation
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: '{{ __("message.Are you sure?") }}',
                    text: '{{ __("message.You won\'t be able to revert this!") }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: '{{ __("message.Yes, delete it!") }}',
                    cancelButtonText: '{{ __("message.Cancel") }}'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
    @endpush
@endsection