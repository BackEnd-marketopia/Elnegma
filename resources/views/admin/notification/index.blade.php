@extends('admin.layouts.app')
@section('title', 'Notifications')
@section('page-title', __('message.Notifications'))
@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('Admin') }}</span>
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
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ __('Manage system notifications') }}
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.notifications.create') }}" 
               class="btn btn-primary">
                <i class="fas fa-plus mr-2 rtl:ml-2 rtl:mr-0"></i>
                {{ __('message.Add Notification') }}
            </a>
            <button class="btn btn-secondary">
                <i class="fas fa-bell mr-2 rtl:ml-2 rtl:mr-0"></i>
                {{ __('Send Bulk') }}
            </button>
        </div>
    </div>

    <!-- Notifications Table Card -->
    <div class="card-modern">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('Notifications List') }}
                </h3>
                <div class="flex items-center gap-3">
                    <div class="search-wrapper">
                        <div class="relative">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" 
                                   id="notificationSearch" 
                                   class="search-input" 
                                   placeholder="{{ __('Search notifications...') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table id="add-row" class="table">
                <thead>
                    <tr>
                        <th>{{ __('message.Title') }}</th>
                        <th>{{ __('message.Body') }}</th>
                        <th>{{ __('message.Type') }}</th>
                        <th>{{ __('message.To') }}</th>
                        <th class="text-center">{{ __('message.Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr>
                            <td>
                                <div class="flex items-center">
                                    @if($notification->image)
                                        <div class="w-10 h-10 rounded-lg overflow-hidden mr-3 rtl:ml-3 rtl:mr-0 bg-gray-100 dark:bg-gray-700">
                                            <img src="{{ asset($notification->image) }}" 
                                                 alt="{{ $notification->title }}" 
                                                 class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center mr-3 rtl:ml-3 rtl:mr-0">
                                            <i class="fas fa-bell text-primary-600 dark:text-primary-400"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            {{ Str::limit($notification->title, 40) }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="max-w-xs">
                                    <p class="text-gray-600 dark:text-gray-400 text-sm truncate">
                                        {{ Str::limit($notification->body, 50) }}
                                    </p>
                                </div>
                            </td>
                            <td>
                                @if($notification->type == 'general')
                                    <span class="badge badge-info">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        {{ __('General') }}
                                    </span>
                                @elseif($notification->type == 'promotion')
                                    <span class="badge badge-success">
                                        <i class="fas fa-tag mr-1"></i>
                                        {{ __('Promotion') }}
                                    </span>
                                @else
                                    <span class="badge badge-primary">
                                        <i class="fas fa-bell mr-1"></i>
                                        {{ ucfirst($notification->type) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if($notification->to == 'users')
                                    <span class="badge badge-primary">
                                        <i class="fas fa-users mr-1"></i>
                                        {{ __('message.All') }}
                                    </span>
                                @else
                                    <span class="badge badge-warning">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        {{ __('message.Cities') }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn btn-info btn-sm" 
                                            onclick="viewNotification({{ $notification->id }})"
                                            data-bs-toggle="tooltip" 
                                            title="{{ __('View Details') }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <form action="{{ route('admin.notifications.destroy', $notification->id) }}"
                                          method="POST" 
                                          style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm delete-btn"
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
                    {{ __('Total') }}: {{ $notifications->count() }} {{ __('notifications') }}
                </div>
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
});
</script>
@endpush
@endsection

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $notifications->links() }}
                                <p>{{ __('message.Page') }}: {{ $notifications->currentPage() }} {{ __('message.of') }}
                                    {{ $notifications->lastPage() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection