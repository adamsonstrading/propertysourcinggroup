@extends('layouts.admin')

@section('title', 'Edit Trustpilot Review')

@section('content')
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>Edit Trustpilot Review</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.trustpilot-reviews.index') }}">Trustpilot
                                Reviews</a></li>
                        <li class="breadcrumb-item active">Edit Review</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.trustpilot-reviews.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back
            </a>
        </div>
    </div>

    <div class="content-card">
        <div class="card-body p-4">
            <form action="{{ route('admin.trustpilot-reviews.update', $trustpilot_review->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="rating_stars" class="form-label">Rating Stars (0-5)</label>
                        <input type="number" step="0.1" min="0" max="5" class="form-control" id="rating_stars"
                            name="rating_stars" value="{{ old('rating_stars', $trustpilot_review->rating_stars) }}"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="review_text" class="form-label">Review Count (Text)</label>
                        <input type="text" class="form-control" id="review_text" name="review_text"
                            value="{{ old('review_text', $trustpilot_review->review_text) }}" placeholder="e.g. 1920"
                            required>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $trustpilot_review->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-admin-primary">
                            <i class="bi bi-save me-2"></i>Update Review
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection