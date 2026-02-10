@extends('layouts.app')

@section('content')

    <div class="container py-5">
        <a href="{{ route('available-properties.index') }}" class="text-decoration-none text-muted mb-4 d-inline-block"><i
                class="bi bi-arrow-left me-2"></i>Back to Properties</a>

        <div class="row g-4">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Header -->
                <div class="mb-4">
                    <span class="badge bg-pink mb-2">{{ $property->marketingPurpose->name ?? 'For Sale' }}</span>
                    @if($property->discount_available)
                        <span class="badge bg-success mb-2 ms-2">Discount Available</span>
                    @endif
                    <h1 class="fw-bold text-blue">{{ $property->headline }}</h1>
                    <p class="h4 text-muted"><i class="bi bi-geo-alt-fill me-2 text-pink"></i>{{ $property->location }}</p>
                </div>

                <!-- Gallery -->
                <div class="card border-0 rounded-4 overflow-hidden mb-4 shadow-sm">
                    @if($property->thumbnail)
                        <img src="{{ Storage::url($property->thumbnail) }}" class="img-fluid w-100 object-fit-cover"
                            style="max-height: 500px;" alt="{{ $property->headline }}">
                    @else
                        <img src="https://via.placeholder.com/800x500?text=No+Wait+Image" class="img-fluid w-100"
                            alt="No Image">
                    @endif
                </div>

                <!-- Description -->
                <div class="bg-white p-4 rounded-4 shadow-sm mb-4">
                    <h4 class="fw-bold text-blue mb-3">Property Description</h4>
                    <div class="text-muted leading-relaxed">
                        {!! $property->full_description !!}
                    </div>
                </div>

                <!-- Features -->
                @if($property->features->count() > 0)
                    <div class="bg-white p-4 rounded-4 shadow-sm mb-4">
                        <h4 class="fw-bold text-blue mb-3">Features & Amenities</h4>
                        <div class="row g-3">
                            @foreach($property->features as $feature)
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                                        <span>{{ $feature->name }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Gallery Grid -->
                @if($property->gallery_images)
                    <div class="bg-white p-4 rounded-4 shadow-sm mb-4">
                        <h4 class="fw-bold text-blue mb-3">Photo Gallery</h4>
                        <div class="row g-2">
                            @foreach($property->gallery_images as $image)
                                <div class="col-6 col-md-4">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal">
                                        <img src="{{ Storage::url($image) }}"
                                            class="img-fluid rounded-3 w-100 object-fit-cover hover-zoom" style="height: 150px;"
                                            alt="Gallery Image">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Video -->
                @if($property->video_url)
                    <div class="bg-white p-4 rounded-4 shadow-sm mb-4">
                        <h4 class="fw-bold text-blue mb-3">Video Tour</h4>
                        <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
                            @if(Str::contains($property->video_url, ['youtube.com', 'youtu.be', 'vimeo.com']))
                                <iframe src="{{ str_replace('watch?v=', 'embed/', $property->video_url) }}"
                                    allowfullscreen></iframe>
                            @else
                                <video width="100%" height="auto" controls>
                                    <source src="{{ Storage::url($property->video_url) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <h3 class="fw-bold text-pink mb-4">£{{ number_format($property->price, 2) }}</h3>

                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted"><i class="bi bi-house me-2"></i>Type</span>
                                <span class="fw-bold">{{ $property->propertyType->name ?? 'N/A' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted"><i class="bi bi-tag me-2"></i>Category</span>
                                <span class="fw-bold">{{ $property->unitType->name ?? 'N/A' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted"><i class="bi bi-arrows-move me-2"></i>Area</span>
                                <span class="fw-bold">{{ $property->area_sq_ft }} sq ft</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted"><i class="bi bi-door-open me-2"></i>Bedrooms</span>
                                <span class="fw-bold">{{ $property->bedrooms }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted"><i class="bi bi-droplet me-2"></i>Bathrooms</span>
                                <span class="fw-bold">{{ $property->bathrooms }}</span>
                            </li>
                        </ul>

                        <form action="{{ route('inquiry.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="property">
                            <input type="hidden" name="property_id" value="{{ $property->id }}">
                            <input type="hidden" name="owner_id" value="{{ $property->user_id }}">
                            <input type="hidden" name="name" value="{{ Auth::check() ? Auth::user()->name : '' }}">
                            <input type="hidden" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                            <input type="hidden" name="phone"
                                value="{{ Auth::check() && Auth::user()->phone ? Auth::user()->phone : 'N/A' }}">
                            <input type="hidden" name="source_page" value="{{ url()->current() }}">
                            <input type="hidden" name="comments"
                                value="Inquiry for Property: {{ $property->headline }} (ID: {{ $property->id }}) at {{ $property->location }}">

                            <button type="submit" class="btn btn-custom-pink w-100 py-3 mb-3 fw-bold">Enquire Now</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .leading-relaxed {
            line-height: 1.8;
        }

        .hover-zoom {
            transition: transform 0.3s;
        }

        .hover-zoom:hover {
            transform: scale(1.05);
        }
    </style>

@endsection