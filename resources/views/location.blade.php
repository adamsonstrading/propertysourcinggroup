@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="position-relative py-5 bg-blue text-white overflow-hidden"
        style="background-image: url('{{ $location->image_url ? asset('storage/' . $location->image_url) : '' }}'); background-size: cover; background-position: center;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(30, 64, 114, 0.85);"></div>

        <div class="container position-relative z-10 py-5">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <span class="badge bg-pink text-white px-3 py-2 rounded-pill mb-3">Prime Location</span>
                    <h1 class="display-3 fw-bold mb-4">Property Investment in {{ $location->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Properties Grid -->
    <section class="py-5 bg-light-custom">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h3 class="fw-bold text-blue">Latest Opportunities in {{ $location->name }}</h3>
                <p class="text-muted">Explore our current exclusive deals.</p>
            </div>
            <div class="row g-4">
                @forelse($properties as $property)
                    <div class="col-md-6 col-lg-4">
                        <div class="deal-card border bg-white rounded-3 overflow-hidden h-100 shadow-sm">
                            <div class="deal-img-wrapper position-relative" style="height: 250px;">
                                <img src="{{ Str::startsWith($property->image_url, 'http') ? $property->image_url : asset('storage/' . $property->image_url) }}"
                                    class="w-100 h-100 object-fit-cover" alt="Property">
                                <span
                                    class="bmv-badge position-absolute top-0 end-0 m-3 badge bg-pink rounded-pill">{{ $property->bmv_percentage }}%
                                    BMV</span>
                            </div>
                            <div class="p-4 d-flex flex-column h-100">
                                <h5 class="fw-bold text-blue mb-2">{{ $property->location }}</h5>
                                <p class="text-muted small mb-3 flex-grow-1">{{ Str::limit($property->description, 80) }}</p>
                                <a href="#" class="btn btn-outline-blue w-100 rounded-pill mt-auto">View Property</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">No properties found in this location.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5 bg-pink text-center text-white">
        <div class="container">
            <h2 class="fw-bold mb-3">Ready to Invest in {{ $location->name }}?</h2>
            <p class="opacity-75 mb-4">Contact our expert team today to get started.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#contact" class="btn btn-light text-pink fw-bold rounded-pill px-5">Get Started</a>
            </div>
        </div>
    </section>
@endsection