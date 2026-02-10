@extends('layouts.admin')

@section('title', 'Team Members')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>Team Members</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Team Members</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.team.create') }}" class="btn btn-admin-primary">
                <i class="bi bi-plus-circle me-2"></i>Add Team Member
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

    <!-- Team Table -->
    <div class="content-card">
        <div class="card-header">
            <h5><i class="bi bi-people me-2"></i>All Team Members</h5>
        </div>
        <div class="card-body">
            <table class="table admin-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Photo</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Order</th>
                        <th style="width: 150px;" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                        <tr>
                            <td>
                                @if($member->photo_url)
                                    <img src="{{ asset('storage/' . $member->photo_url) }}" class="rounded-circle"
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px;">
                                        <i class="bi bi-person text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $member->name }}</div>
                            </td>
                            <td>
                                <span class="text-muted">{{ $member->position }}</span>
                            </td>
                            <td>
                                <span class="badge badge-admin bg-light text-dark border">{{ $member->order }}</span>
                            </td>
                            <td class="text-end">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('admin.team.edit', $member->id) }}" class="btn btn-sm btn-admin-edit"
                                        title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this team member?');">
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
                                <p class="text-muted mb-0">No team members found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection