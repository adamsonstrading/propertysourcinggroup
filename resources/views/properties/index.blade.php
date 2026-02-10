@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 position-relative text-white"
        style="background: linear-gradient(rgba(30, 64, 114, 0.9), rgba(30, 64, 114, 0.9)), url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80'); background-size: cover; background-position: center; min-height: 300px;">
        <div class="container py-5 text-center">
            <h1 class="display-3 fw-bold mb-4">RECENT PROPERTIES</h1>
            <p class="lead mb-0 mx-auto" style="max-width: 800px;">HERE ARE SOME OF OUR RECENT PROPERTIES</p>
        </div>
    </section>

    <!-- Properties Grid -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10 text-center">
                    <p class="text-muted fs-5">We can sit here and say that we offer the best possible deals to our
                        investors and reference significant discount figures on market value, but the proof is in the
                        pudding right?</p>
                </div>
            </div>

            <div class="row g-4">
                @forelse($properties as $property)
                    <div class="col-lg-4 col-md-6">
                        <div
                            class="recent-property-card border rounded-4 overflow-hidden h-100 shadow-sm transition-hover bg-white d-flex flex-column">
                            <!-- Top Info Bar -->
                            <div class="bg-pink py-2 px-3 text-center">
                                <span
                                    class="text-white fw-bold small text-uppercase letter-spacing-1">{{ $property->type ?? 'Investment' }}</span>
                            </div>

                            <!-- Image Header -->
                            <div class="position-relative" style="height: 220px;">
                                <img src="{{ $property->image_url ? (Str::startsWith($property->image_url, 'http') ? $property->image_url : asset('storage/' . $property->image_url)) : 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&q=80&w=600' }}"
                                    class="w-100 h-100 object-fit-cover" alt="{{ $property->location }}" loading="lazy">

                                <div
                                    class="position-absolute bottom-0 start-0 w-100 py-2 px-3 bg-blue bg-opacity-90 text-white fw-bold text-center">
                                    {{ $property->location }}
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="p-4 flex-grow-1 d-flex flex-column">
                                <div class="text-center mb-3">
                                    <h6 class="text-blue fw-bold mb-1">{{ $property->description }}</h6>
                                </div>

                                <div class="row text-center mb-4 g-0 border rounded-3 overflow-hidden">
                                    <div class="col-6 bg-light py-2 border-end">
                                        <p class="text-muted smaller mb-0 text-uppercase fw-bold">BMV</p>
                                        <h4 class="fw-bold text-blue mb-0">{{ $property->bmv_percentage }}%</h4>
                                    </div>
                                    <div class="col-6 bg-light py-2">
                                        <p class="text-muted smaller mb-0 text-uppercase fw-bold">Yield/Profit</p>
                                        <h4 class="fw-bold text-blue mb-0">{{ $property->yield ?? 'N/A' }}</h4>
                                    </div>
                                </div>

                                <div class="features-box flex-grow-1 mb-4">
                                    <ul class="list-unstyled mb-0 small">
                                        @if($property->features)
                                            @foreach(explode("\n", $property->features) as $feature)
                                                @if(trim($feature))
                                                    <li class="mb-2 d-flex align-items-start">
                                                        <i class="bi bi-circle-fill text-pink me-2 mt-1" style="font-size: 0.5rem;"></i>
                                                        <span class="text-secondary">{{ trim($feature) }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @else
                                            <li class="mb-2 d-flex align-items-start text-muted italic">
                                                No specific features listed.
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                <div class="mt-auto">
                                    <a href="{{ route('become-investor') }}"
                                        class="btn btn-custom-blue w-100 py-2 fw-bold text-uppercase">Start your property
                                        journey</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No properties found. Check back soon!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 bg-blue text-white text-center">
        <div class="container py-4">
            <h2 class="fw-bold mb-4">Start your property journey today</h2>
            <a href="{{ route('become-investor') }}" class="btn btn-custom-pink px-5 py-3 rounded-pill fw-bold">Book Free
                Consultation</a>
        </div>
    </section>

    <style>
        .recent-property-card {
            transition: all 0.3s ease;
        }

        .recent-property-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1) !important;
        }

        .letter-spacing-1 {
            letter-spacing: 1px;
        }

        .smaller {
            font-size: 0.75rem;
        }

        .btn-custom-blue {
            background-color: var(--primary-blue);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-custom-blue:hover {
            background-color: #0d2a4a;
            color: white;
            transform: scale(1.02);
        }
    </style>
@endsection