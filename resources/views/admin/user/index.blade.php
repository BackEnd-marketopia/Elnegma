@extends('admin.layouts.app')
@section('title', 'Users')
@section('page-title', __('message.Users'))
@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('Admin') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Users') }}</span>
@endsection

@section('content')
<div class="space-y-6 animate-fadeInUp">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('message.Users') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ __('Manage platform users and their subscriptions') }}
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.users.create') }}" 
               class="btn btn-primary">
                <i class="fas fa-plus mr-2 rtl:ml-2 rtl:mr-0"></i>
                {{ __('message.Add User') }}
            </a>
            <button class="btn btn-secondary">
                <i class="fas fa-download mr-2 rtl:ml-2 rtl:mr-0"></i>
                {{ __('Export Users') }}
            </button>
        </div>
    </div>

    <!-- Users Table Card -->
    <div class="card-modern">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('Users List') }}
                </h3>
                <div class="flex items-center gap-3">
                    <div class="search-wrapper">
                        <div class="relative">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" 
                                   id="userSearch" 
                                   class="search-input" 
                                   placeholder="{{ __('Search users...') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table id="add-row" class="table">
                <thead>
                    <tr>
                        <th>{{ __('message.Name') }}</th>
                        <th>{{ __('message.Email') }}</th>
                        <th>{{ __('message.Phone') }}</th>
                        <th>{{ __('message.Status') }}</th>
                        <th>{{ __('message.Subscribed') }}</th>
                        <th class="text-center">{{ __('message.Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mr-3 rtl:ml-3 rtl:mr-0">
                                        <i class="fas fa-user text-primary-600 dark:text-primary-400"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            {{ Str::limit($user->name, 30) }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-gray-600 dark:text-gray-400">
                                    {{ Str::limit($user->email, 30) }}
                                </span>
                            </td>
                            <td>
                                <span class="text-gray-600 dark:text-gray-400">
                                    {{ Str::limit($user->phone, 15) }}
                                </span>
                            </td>
                            <td>
                                @if($user->status == 'active')
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        {{ __('Active') }}
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        {{ __('Inactive') }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($user->code)
                                    <span class="badge badge-primary">
                                        <i class="fas fa-crown mr-1"></i>
                                        {{ __('message.Subscribed') }}
                                    </span>
                                @else
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ __('message.Not Subscribed') }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                       class="btn btn-info btn-sm"
                                       data-bs-toggle="tooltip" 
                                       title="{{ __('Edit User') }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                          method="POST" 
                                          style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm delete-btn"
                                                data-bs-toggle="tooltip" 
                                                title="{{ __('Delete User') }}">
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
                    {{ __('message.Page') }}: {{ $users->currentPage() }} {{ __('message.of') }} {{ $users->lastPage() }}
                    <span class="mx-2">•</span>
                    {{ __('Total') }}: {{ $users->total() }} {{ __('users') }}
                </div>
                <div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .pagination {
        display: flex;
        gap: 0.25rem;
    }
    
    .pagination .page-link {
        padding: 0.5rem 0.75rem;
        border: 2px solid #6000C0;
        color: #6000C0;
        background: white;
        border-radius: 0.5rem;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .dark .pagination .page-link {
        background: #374151;
        color: #D4C5FF;
    }
    
    .pagination .page-link:hover {
        background: #6000C0;
        color: white;
        transform: translateY(-1px);
    }
    
    .pagination .page-item.active .page-link {
        background: #6000C0;
        color: white;
        border-color: #6000C0;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced search functionality
    const searchInput = document.getElementById('userSearch');
    const tableRows = document.querySelectorAll('#add-row tbody tr');
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            tableRows.forEach(row => {
                const name = row.querySelector('td:first-child').textContent.toLowerCase();
                const email = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                const phone = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                
                if (name.includes(searchTerm) || email.includes(searchTerm) || phone.includes(searchTerm)) {
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