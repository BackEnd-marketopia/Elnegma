@extends('admin.layouts.app')
@section('title', 'Vendors')
@section('page-title', __('message.Vendos'))
@section('breadcrumb')
    <span class="text-primary-600 dark:text-primary-400">{{ __('Admin') }}</span>
    <span class="mx-2">/</span>
    <span>{{ __('message.Vendos') }}</span>
@endsection

@section('content')
<div class="space-y-6 animate-fadeInUp">
    <!-- Header Section -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                {{ __('message.Vendos') }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">
                {{ __('Manage platform vendors and their status') }}
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.vendors.create') }}" 
               class="btn btn-primary">
                <i class="fas fa-plus mr-2 rtl:ml-2 rtl:mr-0"></i>
                {{ __('message.Add Vendor') }}
            </a>
            <button class="btn btn-secondary">
                <i class="fas fa-download mr-2 rtl:ml-2 rtl:mr-0"></i>
                {{ __('Export Vendors') }}
            </button>
        </div>
    </div>

    <!-- Vendors Table Card -->
    <div class="card-modern">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ __('Vendors List') }}
                </h3>
                <div class="flex items-center gap-3">
                    <div class="search-wrapper">
                        <div class="relative">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" 
                                   id="vendorSearch" 
                                   class="search-input" 
                                   placeholder="{{ __('Search vendors...') }}">
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
                        <th class="text-center">{{ __('message.Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-lg overflow-hidden mr-3 rtl:ml-3 rtl:mr-0 bg-gray-100 dark:bg-gray-700">
                                        @if($user->vendor->logo)
                                            <img src="{{ asset($user->vendor->logo) }}" 
                                                 alt="{{ $user->vendor->name }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <i class="fas fa-store text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">
                                            {{ Str::limit($user->vendor->name, 30) }}
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
                                @if($user->vendor->status == 'accepted')
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        {{ __('message.Accepted') }}
                                    </span>
                                @elseif($user->vendor->status == 'pending')
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock mr-1"></i>
                                        {{ __('message.Pending') }}
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        {{ __('message.Rejected') }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.vendors.edit', $user->id) }}"
                                       class="btn btn-info btn-sm"
                                       data-bs-toggle="tooltip" 
                                       title="{{ __('Edit Vendor') }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.vendors.destroy', $user->id) }}"
                                          method="POST" 
                                          style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger btn-sm delete-btn"
                                                data-bs-toggle="tooltip" 
                                                title="{{ __('Delete Vendor') }}">
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
                    {{ __('Total') }}: {{ $users->count() }} {{ __('vendors') }}
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced search functionality
    const searchInput = document.getElementById('vendorSearch');
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

