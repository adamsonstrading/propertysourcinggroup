@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section class="py-5 bg-blue text-white text-center">
        <div class="container py-2">
            <h1 class="display-4 fw-bold">Available Properties</h1>
            <p class="lead mb-0 opacity-75">Exclusive property investment deals for our members</p>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-3 bg-white border-bottom shadow-sm mt-n1">
        <div class="container">
            <!-- Mobile Toggle Button -->
            <div class="d-lg-none mb-3">
                <button
                    class="btn btn-outline-blue w-100 d-flex justify-content-between align-items-center py-2 px-3 rounded-3 fw-bold"
                    type="button" data-bs-toggle="collapse" data-bs-target="#propertyFilters">
                    <span><i class="bi bi-sliders2 me-2"></i>Filter Properties</span>
                    <i class="bi bi-chevron-down"></i>
                </button>
            </div>

            <!-- Filter Content -->
            <div class="collapse d-lg-block" id="propertyFilters">
                <div class="filter-wrapper p-3 p-md-4 rounded-4 bg-white border shadow-sm">
                    <form action="{{ route('available-properties.index') }}" method="GET" id="filter-form">
                        <div class="row g-3 align-items-end">
                            <!-- Location -->
                            <div class="col-lg-3">
                                <label class="fw-bold small text-uppercase mb-2 d-block"
                                    style="color: #1E4072; font-size: 0.7rem; letter-spacing: 0.5px;">Location &
                                    Radius</label>
                                <div class="input-group search-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-geo-alt text-pink"></i></span>
                                    <input type="text" id="location-search" class="form-control border-start-0 ps-0"
                                        placeholder="City / Postcode" value="{{ request('location') }}" name="location">
                                    <select name="radius" class="form-select bg-light"
                                        style="max-width: 85px; border-left: 1px solid #dee2e6;">
                                        <option value="5" {{ request('radius') == 5 ? 'selected' : '' }}>5mi</option>
                                        <option value="10" {{ request('radius') == 10 || !request('radius') ? 'selected' : '' }}>10mi</option>
                                        <option value="20" {{ request('radius') == 20 ? 'selected' : '' }}>20mi</option>
                                        <option value="50" {{ request('radius') == 50 ? 'selected' : '' }}>50mi</option>
                                    </select>
                                </div>
                                <input type="hidden" name="lat" id="lat" value="{{ request('lat') }}">
                                <input type="hidden" name="lng" id="lng" value="{{ request('lng') }}">
                            </div>

                            <!-- Price -->
                            <div class="col-lg-3">
                                <label class="fw-bold small text-uppercase mb-2 d-block"
                                    style="color: #1E4072; font-size: 0.7rem; letter-spacing: 0.5px;">Price Range
                                    (£)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light pe-2">£</span>
                                    <input type="number" name="min_price" class="form-control text-center" placeholder="Min"
                                        value="{{ request('min_price') }}">
                                    <span class="input-group-text bg-light px-1 border-start-0 border-end-0">-</span>
                                    <input type="number" name="max_price" class="form-control text-center" placeholder="Max"
                                        value="{{ request('max_price') }}">
                                </div>
                            </div>

                            <!-- Type -->
                            <div class="col-lg-2">
                                <label class="fw-bold small text-uppercase mb-2 d-block"
                                    style="color: #1E4072; font-size: 0.7rem; letter-spacing: 0.5px;">Type</label>
                                <select name="property_type" class="form-select">
                                    <option value="">All Types</option>
                                    @foreach($propertyTypes as $type)
                                        <option value="{{ $type->id }}" {{ request('property_type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Beds & Baths -->
                            <div class="col-lg-3">
                                <label class="fw-bold small text-uppercase mb-2 d-block"
                                    style="color: #1E4072; font-size: 0.7rem; letter-spacing: 0.5px;">Beds & Baths</label>
                                <div class="d-flex gap-2">
                                    <select name="bedrooms" class="form-select">
                                        <option value="">Beds</option>
                                        @for($i = 1; $i <= 6; $i++)
                                            <option value="{{ $i }}" {{ request('bedrooms') == $i ? 'selected' : '' }}>{{ $i }}+
                                            </option>
                                        @endfor
                                    </select>
                                    <select name="bathrooms" class="form-select">
                                        <option value="">Baths</option>
                                        @for($i = 1; $i <= 4; $i++)
                                            <option value="{{ $i }}" {{ request('bathrooms') == $i ? 'selected' : '' }}>{{ $i }}+
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="col-lg-1">
                                <label class="d-none d-lg-block mb-4">&nbsp;</label>
                                <button type="submit"
                                    class="btn btn-custom-pink w-100 fw-bold d-flex align-items-center justify-content-center"
                                    style="height: 48px; border-radius: 8px;margin-bottom:14px">
                                    <i class="bi bi-search me-1 d-xl-none"></i><span>Search</span>
                                </button>
                            </div>
                        </div>



                        @if(request()->anyFilled(['location', 'min_price', 'max_price', 'property_type', 'bedrooms', 'bathrooms']))
                            <div class="mt-3 text-center text-lg-start">
                                <a href="{{ route('available-properties.index') }}"
                                    class="text-pink text-decoration-none small fw-bold">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filters
                                </a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Properties Grid -->
    <section class="py-5 bg-light">
        <div class="container">

            @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            @if($properties->count() > 0)
                <div class="row g-4">
                    @foreach($properties as $property)
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                                <!-- Image -->
                                <div class="position-relative" style="height: 250px;">
                                    @if($property->thumbnail)
                                        <img src="{{ Storage::url($property->thumbnail) }}" alt="{{ $property->headline }}"
                                            class="w-100 h-100 object-fit-cover">
                                    @else
                                        <img src="https://via.placeholder.com/400x300?text=No+Image" alt="No Image"
                                            class="w-100 h-100 object-fit-cover">
                                    @endif

                                    <div class="position-absolute top-0 end-0 p-3">
                                        <span class="badge bg-pink">{{ $property->marketingPurpose->name ?? 'For Sale' }}</span>
                                        @if($property->discount_available)
                                            <span class="badge bg-success ms-1">Discount Available</span>
                                        @endif
                                    </div>
                                    <div class="position-absolute bottom-0 start-0 p-3 w-100 bg-gradient-dark text-white">
                                        <p class="mb-0 fw-bold"><i
                                                class="bi bi-geo-alt-fill me-1 text-pink"></i>{{ $property->location }}</p>
                                    </div>
                                </div>

                                <!-- Body -->
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-bold text-blue mb-3">{{ $property->headline }}</h5>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="h5 fw-bold text-pink mb-0">£{{ number_format($property->price, 2) }}</span>
                                        <span class="text-muted small">{{ $property->propertyType->name ?? 'N/A' }}</span>
                                    </div>

                                    <div class="d-flex justify-content-between border-top pt-3 text-muted small">
                                        <span><i class="bi bi-door-open me-1"></i> {{ $property->bedrooms }} Beds</span>
                                        <span><i class="bi bi-droplet me-1"></i> {{ $property->bathrooms }} Baths</span>
                                        <span><i class="bi bi-arrows-move me-1"></i> {{ $property->area_sq_ft }} sq ft</span>
                                    </div>

                                </div>

                                <!-- Footer -->
                                <div class="card-footer bg-white border-0 p-4 pt-0">
                                    <a href="{{ route('available-properties.show', $property->id) }}"
                                        class="btn btn-outline-blue w-100">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    {{ $properties->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-house-door display-1 text-muted mb-3"></i>
                    <h3 class="text-muted">No Properties Available Yet</h3>
                    <p>Check back later for exclusive deals.</p>
                </div>
            @endif
        </div>
    </section>

    <style>
        .object-fit-cover {
            object-fit: cover;
        }

        .bg-light-faded {
            background-color: #f8f9fa;
        }

        .filter-wrapper .form-label {
            font-size: 0.75rem;
            color: #1E4072;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-weight: 700;
        }

        .filter-wrapper .form-control,
        .filter-wrapper .form-select,
        .filter-wrapper .input-group-text,
        .filter-wrapper .btn {
            height: 48px !important;
            font-size: 0.9rem;
            border-radius: 8px !important;
        }

        .filter-wrapper .input-group {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .filter-wrapper .form-control:focus,
        .filter-wrapper .form-select:focus {
            border-color: #F95CA8;
            box-shadow: 0 0 0 0.25rem rgba(249, 92, 168, 0.1);
        }

        .bg-gradient-dark {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        }

        .btn-custom-pink {
            background-color: #F95CA8;
            border-color: #F95CA8;
            color: white !important;
            transition: all 0.3s ease;
        }

        .btn-custom-pink:hover {
            background-color: #e04a92;
            border-color: #e04a92;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(249, 92, 168, 0.3);
        }

        .text-pink {
            color: #F95CA8 !important;
        }
    </style>

    @push('scripts')
        <scriptsrc="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtagAWzRL7h2Safzk7EwKK0x6v42RlsdI&libraries=places"></script>
                <script>
                    function initAutocomplete() {
                        const input = document.getElementById('location-search');
                        const options = {
                            componentRestrictions: {
                                country: "gb"
                            },
                            fields: ["address_components", "geometry", "icon", "name"],
                            strictBounds: false,
                        };

                        const autocomplete = new google.maps.places.Autocomplete(input, options);

                        autocomplete.addListener("place_changed", () => {
                            const place = autocomplete.getPlace();

                            if (!place.geometry || !place.geometry.location) {
                                return;
                            }

                            document.getElementById('lat').value = place.geometry.location.lat();
                            document.getElementById('lng').value = place.geometry.location.lng();

                            // Automatically submit if location is selected
                            // document.getElementById('filter-form').submit();
                        });

                        // If user clears the input, clear lat/lng
                        input.addEventListener('input', function () {
                            if (this.value === '') {
                                document.getElementById('lat').value = '';
                                document.getElementById('lng').value = '';
                            }
                        });
                    }

                    if (typeof google === 'object' && typeof google.maps === 'object') {
                        initAutocomplete();
                    }
                </script>
    @endpush

@endsection