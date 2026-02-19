@extends('layouts.admin')

@section('title', 'My Offers')

@section('content')
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold text-blue">My Offers</h2>
            </div>
        </div>

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Property</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($offers as $offer)
                                <tr>
                                    <td>
                                        <a href="{{ route('available-properties.show', $offer->property->id) }}"
                                            class="text-decoration-none fw-bold text-dark">
                                            {{ $offer->property->headline }}
                                        </a>
                                    </td>
                                    <td class="fw-bold text-pink">£{{ number_format($offer->offer_amount, 2) }}</td>
                                    <td class="text-muted">{{ $offer->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if($offer->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($offer->status == 'accepted')
                                            <span class="badge bg-success">Accepted</span>
                                        @elseif($offer->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @elseif($offer->status == 'completed')
                                            <span class="badge bg-info">Completed</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($offer->status) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($offer->notes, 50) ?: 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-tag fs-1 mb-3 d-block"></i>
                                        You haven't made any offers yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $offers->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection