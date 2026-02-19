@extends('layouts.admin')

@section('title', 'Property Offers')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">Offers for: {{ $property->headline }}</h1>
                <p class="text-muted">Current Property Status: <span
                        class="badge bg-secondary">{{ ucfirst($property->status) }}</span></p>
            </div>
            <a href="{{ route('admin.available-properties.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Properties
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Received Offers</h6>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th>User</th>
                                <th>Amount (£)</th>
                                <th>Status</th>
                                <th>Notes</th>
                                <th>Date</th>
                                <th style="min-width: 200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($offers as $offer)
                                <tr>
                                    <td>
                                        {{ $offer->user->name }} <br>
                                        <small class="text-muted">{{ $offer->user->email }}</small>
                                    </td>
                                    <td class="fw-bold">£{{ number_format($offer->offer_amount, 2) }}</td>
                                    <td>
                                        @if($offer->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($offer->status == 'accepted')
                                            <span class="badge bg-success">Accepted</span>
                                        @elseif($offer->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @elseif($offer->status == 'completed')
                                            <span class="badge bg-info">Completed (Sold)</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $offer->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($offer->notes, 50) }}</td>
                                    <td>{{ $offer->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        @if($offer->status == 'pending')
                                            <div class="d-flex gap-2">
                                                <form action="{{ route('admin.property-offers.update', $offer->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button type="submit" class="btn btn-success btn-sm"
                                                        onclick="return confirm('Are you sure you want to ACCEPT this offer?')">Accept</button>
                                                </form>
                                                <form action="{{ route('admin.property-offers.update', $offer->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to REJECT this offer?')">Reject</button>
                                                </form>
                                            </div>
                                        @elseif($offer->status == 'accepted')
                                            <form action="{{ route('admin.property-offers.complete', $offer->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-info btn-sm text-white"
                                                    onclick="return confirm('Please confirm: This will mark the property as SOLD and award investment credits to the user. This action is irreversible.')">
                                                    <i class="fas fa-check-circle me-1"></i> Mark as Completed
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted small">No actions available</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">No offers received yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection