@extends('layouts.admin')

@section('title', 'Locations')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>Locations</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Locations</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.locations.create') }}" class="btn btn-admin-primary">
                <i class="bi bi-plus-circle me-2"></i>Add New Location
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Locations Table -->
    <div class="content-card">
        <div class="card-header">
            <h5><i class="bi bi-geo-alt me-2"></i>All Locations</h5>
        </div>
        <div class="card-body">
            <table class="table admin-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Image</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Short Description</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($locations as $location)
                        <tr>
                            <td>
                                @if($location->image_url)
                                    <img src="{{ asset('storage/' . $location->image_url) }}" class="rounded"
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $location->name }}</div>
                            </td>
                            <td>
                                <span class="badge badge-admin bg-light text-dark border">{{ $location->slug }}</span>
                            </td>
                            <td>
                                <span class="text-muted small">{{ Str::limit($location->short_description, 50) }}</span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.locations.edit', $location->id) }}"
                                        class="btn btn-sm btn-admin-edit" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.locations.destroy', $location->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this location?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-admin-delete" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                <p class="text-muted mb-0">No locations found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($locations->hasPages())
        <div class="mt-4">
            {{ $locations->links('pagination::bootstrap-5') }}
        </div>
    @endif
@endsection