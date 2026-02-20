@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section class="available-properties-hero py-5 position-relative overflow-hidden">
        <div class="hero-overlay"></div>
        <div class="container py-lg-5 position-relative z-1">
            <div class="text-center mb-5">
                <h1 class="display-3 fw-800 text-white mb-3">Available Properties</h1>
                <p class="lead text-white opacity-90 mx-auto" style="max-width: 600px;">
                    Discover exclusive off-market property investment deals curated by the UK's leading sourcing agents.
                </p>
            </div>

            <!-- Filter Section Integrated -->
            <div class="filter-container mx-auto" style="max-width: 1100px;">
                <!-- Mobile Toggle Button -->
                <div class="d-lg-none mb-3">
                    <button
                        class="btn btn-primary w-100 d-flex justify-content-between align-items-center py-3 px-4 rounded-4 fw-bold shadow-lg"
                        type="button" data-bs-toggle="collapse" data-bs-target="#propertyFilters">
                        <span><i class="bi bi-sliders2 me-2"></i>Filter Your Search</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                </div>

                <!-- Filter Content -->
                <div class="collapse d-lg-block" id="propertyFilters">
                    <div class="filter-wrapper p-4 p-lg-5 rounded-5 bg-white border-0 shadow-2xl">
                        <form action="{{ route('available-properties.index') }}" method="GET" id="filter-form">
                            <!-- Line 1: Primary Discovery -->
                            <div class="row g-3 mb-4 last-mb-0 border-bottom-lg">
                                <div class="col-lg-7">
                                    <label class="filter-label">Where would you like to invest?</label>
                                    <div class="input-group premium-input-group shadow-sm">
                                        <span class="input-group-text bg-white border-end-0"><i
                                                class="bi bi-geo-alt-fill text-pink"></i></span>
                                        <input type="text" id="location-search" class="form-control border-start-0 py-3"
                                            placeholder="City, Area or Postcode..." value="{{ request('location') }}"
                                            name="location">
                                        <select name="radius" class="form-select radius-select border-start">
                                            <option value="">No Radius</option>
                                            <option value="5" {{ request('radius') == 5 ? 'selected' : '' }}>5 miles</option>
                                            <option value="10" {{ request('radius') == 10 ? 'selected' : '' }}>10 miles
                                            </option>
                                            <option value="20" {{ request('radius') == 20 ? 'selected' : '' }}>20 miles
                                            </option>
                                            <option value="50" {{ request('radius') == 50 ? 'selected' : '' }}>50 miles
                                            </option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="lat" id="lat" value="{{ request('lat') }}">
                                    <input type="hidden" name="lng" id="lng" value="{{ request('lng') }}">
                                </div>
                                <div class="col-lg-5">
                                    <label class="filter-label">Budget Range (£)</label>
                                    <div class="input-group premium-input-group shadow-sm">
                                        <span class="input-group-text bg-white px-3">Min</span>
                                        <input type="number" name="min_price" class="form-control border-end-0 py-3"
                                            placeholder="£0" value="{{ request('min_price') }}">
                                        <span
                                            class="input-group-text bg-white px-2 border-start-0 border-end-0 text-muted">to</span>
                                        <input type="number" name="max_price" class="form-control border-start-0 py-3"
                                            placeholder="Max" value="{{ request('max_price') }}">
                                        <span class="input-group-text bg-white px-3">Max</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Line 2: Specific Requirements -->
                            <div class="row g-3 align-items-end">
                                <div class="col-lg-4 col-md-6">
                                    <label class="filter-label"><i class="bi bi-house-door-fill me-1 text-blue"></i>
                                        Property Type</label>
                                    <select name="property_type" class="form-select premium-select py-3">
                                        <option value="">All Property Types</option>
                                        @foreach($propertyTypes as $type)
                                            <option value="{{ $type->id }}" {{ request('property_type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label class="filter-label"><i class="bi bi-door-open-fill me-1 text-blue"></i>
                                        Bedrooms</label>
                                    <select name="bedrooms" class="form-select premium-select py-3">
                                        <option value="">Any Beds</option>
                                        @for($i = 1; $i <= 6; $i++)
                                            <option value="{{ $i }}" {{ request('bedrooms') == $i ? 'selected' : '' }}>{{ $i }}+
                                                Beds</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label class="filter-label"><i class="bi bi-droplet-fill me-1 text-blue"></i>
                                        Bathrooms</label>
                                    <select name="bathrooms" class="form-select premium-select py-3">
                                        <option value="">Any Baths</option>
                                        @for($i = 1; $i <= 4; $i++)
                                            <option value="{{ $i }}" {{ request('bathrooms') == $i ? 'selected' : '' }}>{{ $i }}+
                                                Baths</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-lg-2 col-md-12">
                                    <button type="submit" class="btn btn-custom-pink w-100 fw-800 search-btn-main py-3">
                                        <i class="bi bi-search me-2"></i> SEARCH
                                    </button>
                                </div>
                            </div>

                            @if(request()->anyFilled(['location', 'min_price', 'max_price', 'property_type', 'bedrooms', 'bathrooms']))
                                <div class="mt-4 d-flex align-items-center justify-content-between border-top pt-3">
                                    <span class="text-muted small">Showing results for your preferences...</span>
                                    <a href="{{ route('available-properties.index') }}"
                                        class="text-pink text-decoration-none small fw-bold hover-underline">
                                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset Filters
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
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

                                    <!-- Favorite Button Overlay -->
                                    <div class="position-absolute top-0 start-0 p-3">
                                        <form action="{{ route('property.favorite.toggle', $property->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-light btn-sm rounded-circle shadow-sm favorite-btn"
                                                title="{{ $property->isFavoritedBy(auth()->user()) ? 'Remove from Favorites' : 'Add to Favorites' }}">
                                                <i
                                                    class="bi {{ $property->isFavoritedBy(auth()->user()) ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
                                            </button>
                                        </form>
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
                                    <div class="d-grid gap-2 mb-2">
                                        <a href="{{ route('available-properties.show', $property->id) }}"
                                            class="btn btn-outline-blue btn-sm fw-bold">View Details</a>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button type="button"
                                            class="btn btn-light btn-sm flex-grow-1 border fw-bold text-blue action-btn"
                                            data-bs-toggle="modal" data-bs-target="#offerModal"
                                            data-property-id="{{ $property->id }}" data-property-title="{{ $property->headline }}">
                                            <i class="bi bi-tag-fill me-1"></i> Offer
                                        </button>
                                        <button type="button"
                                            class="btn btn-light btn-sm flex-grow-1 border fw-bold text-blue action-btn"
                                            data-bs-toggle="modal" data-bs-target="#messageModal"
                                            data-property-id="{{ $property->id }}" data-property-title="{{ $property->headline }}">
                                            <i class="bi bi-chat-dots-fill me-1"></i> Message
                                        </button>
                                    </div>
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

    <!-- Offer Modal -->
    <div class="modal fade" id="offerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-blue">Make an Offer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted small mb-4" id="offerModalTitle"></p>
                    <form action="{{ route('property.offer.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="property_id" id="offerPropertyId">
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Your Offer Amount (£)</label>
                            <div class="input-group offer-input-group">
                                <span class="input-group-text bg-light border-end-0 px-3 fw-bold">£</span>
                                <input type="number" name="offer_amount" class="form-control border-start-0 py-3"
                                    step="0.01" required placeholder="e.g. 250000">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Notes (Optional)</label>
                            <textarea name="notes" class="form-control" rows="3"
                                placeholder="Any strict conditions or comments..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-custom-pink w-100 py-3 fw-bold text-uppercase">Submit
                            Offer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Message Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-blue">Message Agent</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted small mb-4" id="messageModalTitle"></p>
                    <form action="{{ route('property.message.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="property_id" id="messagePropertyId">
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Your Message</label>
                            <textarea name="message" class="form-control" rows="5" required
                                placeholder="I'm interested in this property. Can you provide more details?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-blue w-100 py-3 fw-bold text-white text-uppercase">Send
                            Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .favorite-btn {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .favorite-btn:hover {
            transform: scale(1.1);
            background-color: #fff;
        }

        .action-btn {
            transition: all 0.2s ease;
            font-size: 0.8rem;
        }

        .action-btn:hover {
            background-color: #f8f9fa;
            border-color: #1E4072 !important;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        .bg-light-faded {
            background-color: #f8f9fa;
        }

        .available-properties-hero {
            background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            min-height: 550px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(30, 64, 114, 0.95) 0%, rgba(30, 64, 114, 0.6) 100%);
        }

        .z-1 {
            z-index: 1;
        }

        .fw-800 {
            font-weight: 800;
        }

        .opacity-90 {
            opacity: 0.9;
        }

        .shadow-2xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
        }

        .rounded-5 {
            border-radius: 2rem !important;
        }

        .filter-label {
            font-size: 0.7rem;
            color: #1E4072;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 800;
            margin-bottom: 12px;
            display: block;
        }

        .premium-input-group {
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            background: white;
            transition: all 0.3s ease;
        }

        .premium-input-group:focus-within {
            border-color: var(--primary-pink);
            box-shadow: 0 0 0 4px rgba(249, 92, 168, 0.1) !important;
        }

        .premium-input-group .input-group-text {
            background-color: transparent;
            border: none;
            color: #64748b;
            padding-left: 20px;
        }

        .premium-input-group .form-control {
            border: none;
            font-weight: 500;
            box-shadow: none !important;
            height: 55px !important;
        }

        .radius-select {
            border: none !important;
            background-color: #ffffff !important;
            max-width: 120px;
            font-weight: 700;
            color: var(--primary-blue);
            border-left: 1px solid #e2e8f0 !important;
        }

        .premium-select {
            height: 55px !important;
            border-radius: 15px !important;
            border: 1px solid #e2e8f0 !important;
            background-color: #ffffff !important;
            font-weight: 600;
            color: var(--primary-blue);
        }

        .search-btn-main {
            background: linear-gradient(135deg, var(--primary-pink) 0%, #ff89c1 100%);
            border: none;
            box-shadow: 0 10px 20px rgba(249, 92, 168, 0.3);
            font-size: 1rem;
            color: white !important;
            border-radius: 15px !important;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            letter-spacing: 1px;
            height: 55px !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-btn-main:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(249, 92, 168, 0.4);
            background: linear-gradient(135deg, #ff89c1 0%, var(--primary-pink) 100%);
        }

        .available-properties-hero .container {
            z-index: 2;
        }

        @media (min-width: 992px) {
            .border-bottom-lg {
                border-bottom: 1px solid #f1f5f9 !important;
            }
        }

        @media (max-width: 991px) {
            .available-properties-hero {
                min-height: auto;
                padding-bottom: 80px !important;
            }

            .filter-container {
                margin-top: 20px;
            }
        }

        .hover-underline:hover {
            text-decoration: underline !important;
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

        .offer-input-group .input-group-text,
        .offer-input-group .form-control {
            height: 55px !important;
            display: flex;
            align-items: center;
        }

        .btn-blue {
            background-color: #1E4072 !important;
            color: white !important;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-blue:hover {
            background-color: #152d50 !important;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 64, 114, 0.3);
        }
    </style>

    @push('scripts')
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtagAWzRL7h2Safzk7EwKK0x6v42RlsdI&libraries=places"></script>
        <script>
            // Modal Handling for List View
            document.addEventListener('DOMContentLoaded', function () {
                const offerModal = document.getElementById('offerModal');
                if (offerModal) {
                    offerModal.addEventListener('show.bs.modal', function (event) {
                        const button = event.relatedTarget;
                        const propertyId = button.getAttribute('data-property-id');
                        const propertyTitle = button.getAttribute('data-property-title');

                        document.getElementById('offerPropertyId').value = propertyId;
                        document.getElementById('offerModalTitle').textContent = 'Property: ' + propertyTitle;
                    });
                }

                const messageModal = document.getElementById('messageModal');
                if (messageModal) {
                    messageModal.addEventListener('show.bs.modal', function (event) {
                        const button = event.relatedTarget;
                        const propertyId = button.getAttribute('data-property-id');
                        const propertyTitle = button.getAttribute('data-property-title');

                        document.getElementById('messagePropertyId').value = propertyId;
                        document.getElementById('messageModalTitle').textContent = 'Property: ' + propertyTitle;
                    });
                }
            });

            function initAutocomplete() {
                const input = document.getElementById('location-search');
                if (!input) return;

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
                    if (!place.geometry || !place.geometry.location) return;

                    document.getElementById('lat').value = place.geometry.location.lat();
                    document.getElementById('lng').value = place.geometry.location.lng();
                });

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