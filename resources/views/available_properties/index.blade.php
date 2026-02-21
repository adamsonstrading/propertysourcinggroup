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
            <div class="filter-container mx-auto" style="max-width: 1200px;">
                <!-- Mobile Toggle Button -->
                <div class="d-lg-none mb-3">
                    <button
                        class="btn btn-primary w-100 d-flex justify-content-between align-items-center py-3 px-4 rounded-4 fw-bold shadow-lg border-0"
                        style="background: linear-gradient(135deg, #1E4072 0%, #2a5298 100%);" type="button"
                        data-bs-toggle="collapse" data-bs-target="#propertyFilters">
                        <span><i class="bi bi-sliders2 me-2"></i>Filter Your Search</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                </div>

                <!-- Filter Content -->
                <div class="collapse d-lg-block" id="propertyFilters">
                    <div class="filter-wrapper p-4 p-lg-5 rounded-5 bg-white shadow-2xl border border-light-subtle">
                        <form action="{{ route('available-properties.index') }}" method="GET" id="filter-form">
                            <div class="row g-3 align-items-end">
                                <!-- Location Search -->
                                <div class="col-lg-4">
                                    <div class="filter-group">
                                        <label class="filter-label"><i class="bi bi-geo-alt-fill text-pink me-1"></i>
                                            Location</label>
                                        <div class="premium-field-group">
                                            <input type="text" id="location-search" class="premium-input w-100"
                                                placeholder="City, Area or Postcode..." value="{{ request('location') }}"
                                                name="location">
                                            <select name="radius" class="radius-select-floating">
                                                <option value="">No Radius</option>
                                                <option value="5" {{ request('radius') == 5 ? 'selected' : '' }}>5m</option>
                                                <option value="10" {{ request('radius') == 10 ? 'selected' : '' }}>10m
                                                </option>
                                                <option value="20" {{ request('radius') == 20 ? 'selected' : '' }}>20m
                                                </option>
                                                <option value="50" {{ request('radius') == 50 ? 'selected' : '' }}>50m
                                                </option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="lat" id="lat" value="{{ request('lat') }}">
                                        <input type="hidden" name="lng" id="lng" value="{{ request('lng') }}">
                                    </div>
                                </div>

                                <!-- Property Type -->
                                <div class="col-lg-2">
                                    <div class="filter-group">
                                        <label class="filter-label"><i class="bi bi-house-door-fill text-blue me-1"></i>
                                            Type</label>
                                        <select name="property_type" class="premium-select-v2 w-100">
                                            <option value="">All Types</option>
                                            @foreach($propertyTypes as $type)
                                                <option value="{{ $type->id }}" {{ request('property_type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Bedrooms -->
                                <div class="col-lg-2">
                                    <div class="filter-group">
                                        <label class="filter-label"><i class="bi bi-door-open-fill text-blue me-1"></i>
                                            Beds</label>
                                        <select name="bedrooms" class="premium-select-v2 w-100">
                                            <option value="">Any</option>
                                            @for($i = 1; $i <= 6; $i++)
                                                <option value="{{ $i }}" {{ request('bedrooms') == $i ? 'selected' : '' }}>
                                                    {{ $i }}+
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <!-- Price Range -->
                                <div class="col-lg-3">
                                    <div class="filter-group">
                                        <label class="filter-label"><i class="bi bi-currency-pound text-pink me-1"></i>
                                            Price Range</label>
                                        <div class="d-flex align-items-center gap-2">
                                            <input type="number" name="min_price" class="premium-input-small flex-grow-1"
                                                placeholder="Min" value="{{ request('min_price') }}">
                                            <span class="text-muted small">-</span>
                                            <input type="number" name="max_price" class="premium-input-small flex-grow-1"
                                                placeholder="Max" value="{{ request('max_price') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Search Button -->
                                <div class="col-lg-1">
                                    <button type="submit" class="premium-search-btn" title="Search Properties">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>

                            @if(request()->anyFilled(['location', 'min_price', 'max_price', 'property_type', 'bedrooms', 'bathrooms']))
                                <div
                                    class="mt-4 pt-4 border-top d-flex flex-wrap align-items-center justify-content-between gap-3">
                                    <div class="applied-filters d-flex flex-wrap gap-2">
                                        @if(request('location')) <span class="badge-premium">{{ request('location') }}</span>
                                        @endif
                                        @if(request('property_type')) <span class="badge-premium">Type:
                                        {{ $propertyTypes->find(request('property_type'))->name ?? '' }}</span> @endif
                                        @if(request('bedrooms')) <span class="badge-premium">{{ request('bedrooms') }}+
                                        Beds</span> @endif
                                    </div>
                                    <a href="{{ route('available-properties.index') }}" class="reset-link">
                                        <i class="bi bi-trash3 me-1"></i> Clear Filters
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

        /* Redesigned Filter Styles */
        .filter-wrapper {
            transition: all 0.4s ease;
            backdrop-filter: blur(10px);
        }

        .filter-label {
            font-size: 0.65rem;
            color: #64748b;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 10px;
            display: block;
        }

        .premium-field-group {
            position: relative;
            display: flex;
            align-items: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 2px;
            transition: all 0.3s ease;
        }

        .premium-field-group:focus-within {
            border-color: #F95CA8;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(249, 92, 168, 0.1);
        }

        .premium-input {
            border: none;
            background: transparent;
            padding: 12px 15px;
            font-weight: 600;
            color: #1E4072;
            font-size: 0.95rem;
            outline: none;
        }

        .premium-input-small {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 15px;
            font-weight: 600;
            color: #1E4072;
            width: 100%;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .premium-input-small:focus {
            border-color: #F95CA8;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(249, 92, 168, 0.1);
        }

        .radius-select-floating {
            border: none;
            background: #fff;
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 700;
            color: #1E4072;
            cursor: pointer;
            margin-right: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .premium-select-v2 {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 15px;
            font-weight: 600;
            color: #1E4072;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            outline: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%231E4072' class='bi bi-chevron-down' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
        }

        .premium-select-v2:focus {
            border-color: #F95CA8;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(249, 92, 168, 0.1);
        }

        .premium-search-btn {
            background: #F95CA8;
            color: white !important;
            border: none;
            border-radius: 12px;
            width: 100%;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 15px -3px rgba(249, 92, 168, 0.4);
        }

        .premium-search-btn:hover {
            background: #e04a92;
            transform: scale(1.05);
            box-shadow: 0 15px 20px -5px rgba(249, 92, 168, 0.5);
        }

        .badge-premium {
            background: rgba(30, 64, 114, 0.05);
            color: #1E4072;
            padding: 6px 14px;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 700;
            border: 1px solid rgba(30, 64, 114, 0.1);
        }

        .reset-link {
            color: #64748b;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .reset-link:hover {
            color: #F95CA8;
        }

        @media (max-width: 991px) {
            .premium-search-btn {
                margin-top: 10px;
            }
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