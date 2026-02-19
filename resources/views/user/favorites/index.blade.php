@extends('layouts.admin')

@section('title', 'My Favorites')

@section('content')
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold text-blue">My Favorites</h2>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4">
            @forelse($favorites as $favorite)
                @php $property = $favorite->property; @endphp
                @if($property)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 position-relative">
                            <img src="{{ Storage::url($property->thumbnail) }}" class="card-img-top object-fit-cover rounded-top-4"
                                style="height: 200px;" alt="{{ $property->headline }}">

                            <div class="position-absolute top-0 end-0 p-3">
                                <form action="{{ route('property.favorite.toggle', $property->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-light rounded-circle shadow-sm btn-sm text-danger border-0">
                                        <i class="bi bi-heart-fill"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="card-body p-4">
                                <span class="badge bg-pink mb-2">{{ $property->marketingPurpose->name ?? '' }}</span>
                                <h5 class="card-title fw-bold text-blue mb-2">{{ Str::limit($property->headline, 40) }}</h5>
                                <p class="text-muted small mb-3"><i
                                        class="bi bi-geo-alt me-1 text-pink"></i>{{ $property->location }}</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="h5 fw-bold text-pink mb-0">£{{ number_format($property->price, 2) }}</span>
                                    <span class="badge bg-light text-dark border">{{ $property->status }}</span>
                                </div>

                                <a href="{{ route('available-properties.show', $property->id) }}"
                                    class="btn btn-outline-blue w-100 rounded-pill">View Details</a>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-heart fs-1 mb-3 d-block"></i>
                    You have no favorite properties yet.
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $favorites->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection