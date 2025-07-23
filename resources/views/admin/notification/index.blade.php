@extends('admin.layouts.app')
@section('title', __('message.Notifications'))

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/table-style.css') }}">
@endpush

@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('message.Admin') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Notifications') }}</span>
@endsection

@section('content')
    <div class="space-y-6 animate-fadeInUp">
        <!-- Header Section -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('message.Notifications') }}
                </h1>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.notifications.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-lg transition-all duration-200 transform hover:scale-105">
                    <i class="fas fa-plus mr-2 rtl:ml-2 rtl:mr-0"></i>
                    {{ __('message.Add Notification') }}
                </a>
            </div>
        </div>

        <!-- Notifications Table Card -->
        <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 p-6 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-3 rtl:space-x-reverse">
                        <div class="p-3 bg-purple-100 dark:bg-purple-900 rounded-xl">
                            <i class="fas fa-bell text-purple-600 dark:text-purple-400 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ __('message.Notifications List') }}
                        </h3>
                    </div>
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                        <div class="relative">
                            <input type="text" 
                                   id="notificationSearch"
                                   class="block w-full pr-10 pl-3 py-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent shadow-sm hover:shadow-md transition-all duration-200"
                                   placeholder="{{ __('message.Search notifications...') }}">
                        </div>
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <button type="button"
                                class="px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all duration-200 shadow-sm hover:shadow-md">
                                <i class="fas fa-search mr-2 rtl:ml-2 rtl:mr-0"></i>
                                {{ __('message.Search') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table id="add-row" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-purple-600 to-purple-700">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-heading mr-2"></i>
                                {{ __('message.Title') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-align-left mr-2"></i>
                                {{ __('message.Body') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-tag mr-2"></i>
                                {{ __('message.Type') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider border-r border-purple-500">
                                <i class="fas fa-users mr-2"></i>
                                {{ __('message.To') }}
                            </th>
                            <th scope="col" class="px-6 py-4 text-center text-sm font-bold text-white uppercase tracking-wider">
                                <i class="fas fa-cogs mr-2"></i>
                                {{ __('message.Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($notifications as $notification)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        @if($notification->image)
                                            <div class="w-12 h-12 rounded-xl overflow-hidden mr-3 rtl:ml-3 rtl:mr-0 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 shadow-lg ring-2 ring-gray-200 dark:ring-gray-600">
                                                <img src="{{ asset($notification->image) }}" 
                                                     alt="{{ $notification->title }}" 
                                                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-200">
                                            </div>
                                        @else
                                            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mr-3 rtl:ml-3 rtl:mr-0 shadow-lg">
                                                <i class="fas fa-bell text-purple-600 dark:text-purple-400 text-lg"></i>
                                            </div>
                                        @endif
                                        <div class="text-center">
                                            <p class="text-lg font-bold text-gray-900 dark:text-white">
                                                {{ Str::limit($notification->title, 30) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="max-w-xs mx-auto">
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                                            {{ Str::limit($notification->body, 50) }}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center">
                                        @if($notification->type == 'general')
                                            <span class="inline-flex items-center px-3 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                {{ __('General') }}
                                            </span>
                                        @elseif($notification->type == 'promotion')
                                            <span class="inline-flex items-center px-3 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg">
                                                <i class="fas fa-tag mr-1"></i>
                                                {{ __('Promotion') }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg">
                                                <i class="fas fa-bell mr-1"></i>
                                                {{ ucfirst($notification->type) }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center">
                                        @if($notification->to == 'users')
                                            <span class="inline-flex items-center px-3 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg">
                                                <i class="fas fa-users mr-1"></i>
                                                {{ __('message.All') }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow-lg">
                                                <i class="fas fa-map-marker-alt mr-1"></i>
                                                {{ __('message.Cities') }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-3 rtl:space-x-reverse">
                                        <form action="{{ route('admin.notifications.destroy', $notification->id) }}"
                                              method="POST" 
                                              style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 delete-btn transform hover:scale-105 transition-all duration-200 shadow-lg"
                                                    data-bs-toggle="tooltip" 
                                                    title="{{ __('Delete Notification') }}">
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
                        {{ __('message.Page') }}: {{ $notifications->currentPage() }} {{ __('message.of') }} {{ $notifications->lastPage() }}
                    </div>
                    <div>
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
@push('scripts')
<script>
function viewNotification(id) {
    // Implementation for viewing notification details
    alert('View notification details for ID: ' + id);
}

document.addEventListener('DOMContentLoaded', function() {
    // Enhanced search functionality
    const searchInput = document.getElementById('notificationSearch');
    const tableRows = document.querySelectorAll('#add-row tbody tr');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            tableRows.forEach(row => {
                const title = row.querySelector('td:first-child').textContent.toLowerCase();
                const body = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const type = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || body.includes(searchTerm) || type.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Confirm delete
    document.querySelectorAll('.delete-btn').forEach(function(button) {
        button.addEventListener('click', function(e) {
            if (!confirm('Are you sure you want to delete this notification?')) {
                e.preventDefault();
            }
        });
    });
});
</script>
@endpush
@endsection