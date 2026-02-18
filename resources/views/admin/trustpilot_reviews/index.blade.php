@extends('layouts.admin')

@section('title', 'Trustpilot Reviews')

@section('content')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>Trustpilot Reviews</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Trustpilot Reviews</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.trustpilot-reviews.create') }}" class="btn btn-admin-primary">
                <i class="bi bi-plus-circle me-2"></i>Add New Review
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="content-card">
        <div class="card-header">
            <h5><i class="bi bi-star me-2"></i>All Reviews</h5>
        </div>
        <div class="card-body">
            <table class="table admin-table">
                <thead>
                    <tr>
                        <th>Rating Stars</th>
                        <th>Review Number Text</th>
                        <th>Status</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $review->rating_stars }}</div>
                            </td>
                            <td>
                                <span class="text-muted small">{{ $review->review_text }}</span>
                            </td>
                            <td>
                                @if($review->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.trustpilot-reviews.edit', $review->id) }}"
                                        class="btn btn-sm btn-admin-edit" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.trustpilot-reviews.destroy', $review->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Are you sure?');">
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
                            <td colspan="4" class="text-center py-5">
                                <p class="text-muted mb-0">No reviews found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection