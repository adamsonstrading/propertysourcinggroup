@extends('layouts.admin')

@section('title', 'How It Works Steps')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>How It Works Steps</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">How It Works</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.work-steps.create') }}" class="btn btn-admin-primary">
                <i class="bi bi-plus-circle me-2"></i>Add New Step
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

    <!-- Steps Table -->
    <div class="content-card">
        <div class="card-header">
            <h5><i class="bi bi-list-check me-2"></i>All Steps</h5>
        </div>
        <div class="card-body">
            <table class="table admin-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Icon</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Order</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($steps as $step)
                        <tr>
                            <td>
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="{{ $step->icon }} fs-4 text-primary"></i>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $step->title }}</div>
                            </td>
                            <td>
                                <span class="text-muted small">{{ Str::limit($step->description, 80) }}</span>
                            </td>
                            <td>
                                <span class="badge badge-admin bg-light text-dark border">{{ $step->order }}</span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.work-steps.edit', $step->id) }}" class="btn btn-sm btn-admin-edit"
                                        title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.work-steps.destroy', $step->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this step?');">
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
                                <p class="text-muted mb-0">No steps found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection