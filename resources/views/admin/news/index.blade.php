@extends('layouts.admin')

@section('title', 'News & Blog')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>News & Blog</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">News & Blog</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.news.create') }}" class="btn btn-admin-primary">
                <i class="bi bi-plus-circle me-2"></i>Add New Post
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

    <!-- News Table -->
    <div class="content-card">
        <div class="card-header">
            <h5><i class="bi bi-newspaper me-2"></i>All Posts</h5>
        </div>
        <div class="card-body">
            <table class="table admin-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>View</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $post)
                        <tr>
                            <td>
                                @if($post->image_url)
                                    <img src="{{ asset('storage/' . $post->image_url) }}" class="rounded"
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $post->title }}</div>
                                <small class="text-muted">{{ Str::limit($post->excerpt, 50) }}</small>
                            </td>
                            <td>
                                <span class="badge badge-admin bg-primary">{{ $post->category }}</span>
                            </td>
                            <td>
                                <small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small>
                            </td>
                            <td>
                                <a href="{{ route('news.show', $post->slug) }}" target="_blank" class="text-decoration-none">
                                    View <i class="bi bi-box-arrow-up-right small"></i>
                                </a>
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.news.edit', $post->id) }}" class="btn btn-sm btn-admin-edit"
                                        title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.news.destroy', $post->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this post?');">
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
                            <td colspan="6" class="text-center py-5">
                                <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                <p class="text-muted mb-0">No posts found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if($news->hasPages())
        <div class="mt-4">
            {{ $news->links('pagination::bootstrap-5') }}
        </div>
    @endif
@endsection