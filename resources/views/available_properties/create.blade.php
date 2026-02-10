@extends('layouts.admin')

@section('title', 'Add New Property')

@push('css')
    <style>
        .ck-editor__editable {
            min-height: 300px;
        }
        .form-label {
            color: #333;
            font-size: 0.9rem;
        }
        .card-header {
            border-bottom: 1px solid rgba(0,0,0,.05);
        }
        .text-blue {
            color: #0d6efd;
        }
        .upload-container {
            cursor: pointer;
            transition: all 0.3s;
        }
        .upload-container:hover {
            background-color: #f1f1f1 !important;
            border-color: #0d6efd !important;
        }
        .custom-checkbox .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2>Add New Property</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('available-properties.index') }}">Available
                                Properties</a></li>
                        <li class="breadcrumb-item active">Add New</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="content-card">
                <div class="card-header">
                    <h5 class="mb-0 fw-bold text-blue">Property Details</h5>
                </div>
                <div class="card-body p-4">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.available-properties.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <!-- Left Column: Property Details -->
                            <div class="col-lg-8">
                                <div class="card shadow-sm mb-4 border-0">
                                    <div class="card-header bg-white py-3">
                                        <h5 class="mb-0 fw-bold text-blue"><i class="fas fa-info-circle me-2"></i>Basic
                                            Information</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="mb-4">
                                            <label class="form-label fw-bold">Property Headline</label>
                                            <input type="text" name="headline" class="form-control form-control-lg"
                                                placeholder="e.g. Luxury 5 Bedroom Villa in London"
                                                value="{{ old('headline') }}" required>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label fw-bold">Property Location (UK Only)</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i
                                                        class="fas fa-map-marker-alt text-danger"></i></span>
                                                <input type="text" id="location-input" name="location"
                                                    class="form-control border-start-0 ps-0"
                                                    placeholder="Search UK address..." value="{{ old('location') }}"
                                                    required>
                                            </div>
                                            <input type="hidden" id="latitude" name="latitude">
                                            <input type="hidden" id="longitude" name="longitude">
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">Marketing Purpose</label>
                                                <select name="marketing_purpose_id" class="form-select" required>
                                                    <option value="">Select Purpose</option>
                                                    @foreach($marketingPurposes as $purpose)
                                                        <option value="{{ $purpose->id }}">{{ $purpose->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">Price/Rent (£)</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">£</span>
                                                    <input type="number" step="0.01" name="price" class="form-control"
                                                        placeholder="0.00" value="{{ old('price') }}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-0">
                                            <label class="form-label fw-bold text-blue"><i
                                                    class="fas fa-align-left me-2"></i>Full Description</label>
                                            <textarea name="full_description" id="editor" class="form-control"
                                                rows="10">{{ old('full_description') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card shadow-sm mb-4 border-0">
                                    <div class="card-header bg-white py-3">
                                        <h5 class="mb-0 fw-bold text-blue"><i class="fas fa-tools me-2"></i>Property
                                            Specifications</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">Property Type</label>
                                                <select name="property_type_id" id="property_type_id" class="form-select"
                                                    required>
                                                    <option value="">Select Type</option>
                                                    @foreach($propertyTypes as $type)
                                                        <option value="{{ $type->id }}"
                                                            data-name="{{ strtolower($type->name) }}">
                                                            {{ $type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">Unit Type</label>
                                                <select name="unit_type_id" id="unit_type_id" class="form-select">
                                                    <option value="">Choose Category (Optional)</option>
                                                    @foreach($unitTypes as $type)
                                                        <option value="{{ $type->id }}"
                                                            data-property-type="{{ $type->property_type_id }}">{{ $type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row align-items-end">
                                            <div class="col-md-4">
                                                <label class="form-label fw-bold">Area (Sq Ft)</label>
                                                <div class="input-group">
                                                    <input type="number" name="area_sq_ft" class="form-control"
                                                        placeholder="e.g. 1500" value="{{ old('area_sq_ft') }}">
                                                    <span class="input-group-text">sq ft</span>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row" id="bed-bath-section">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Bedrooms</label>
                                                        <select name="bedrooms" class="form-select">
                                                            <option value="">Select Bedrooms</option>
                                                            <option value="Studio" {{ old('bedrooms') == 'Studio' ? 'selected' : '' }}>Studio</option>
                                                            @for($i = 1; $i <= 9; $i++)
                                                                <option value="{{ $i }}" {{ old('bedrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                            <option value="10+" {{ old('bedrooms') == '10+' ? 'selected' : '' }}>10+</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-bold">Bathrooms</label>
                                                        <select name="bathrooms" class="form-select">
                                                            <option value="">Select Bathrooms</option>
                                                            @for($i = 1; $i <= 9; $i++)
                                                                <option value="{{ $i }}" {{ old('bathrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                            @endfor
                                                            <option value="10+" {{ old('bathrooms') == '10+' ? 'selected' : '' }}>10+</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: Media & Features -->
                            <div class="col-lg-4">
                                <div class="card shadow-sm mb-4 border-0">
                                    <div class="card-header bg-white py-3">
                                        <h5 class="mb-0 fw-bold text-blue"><i class="fas fa-images me-2"></i>Media & Gallery
                                        </h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="mb-4">
                                            <label class="form-label fw-bold text-dark">Thumbnail Image</label>
                                            <div class="upload-container text-center border p-3 rounded bg-light">
                                                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-2"></i>
                                                <input type="file" name="thumbnail" class="form-control" accept="image/*">
                                                <small class="text-muted d-block mt-1">Main image for the property
                                                    listing</small>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label fw-bold text-dark">Gallery Images</label>
                                            <input type="file" name="gallery_images[]" class="form-control" accept="image/*"
                                                multiple>
                                            <small class="text-muted">You can select multiple images</small>
                                        </div>

                                        <div class="mb-0">
                                            <label class="form-label fw-bold text-dark">Property Video</label>
                                            <input type="file" name="video" class="form-control" accept="video/*">
                                            <small class="text-muted">Upload property walkthrough (MP4, Max 20MB)</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="card shadow-sm mb-4 border-0">
                                    <div class="card-header bg-white py-3">
                                        <h5 class="mb-0 fw-bold text-blue"><i class="fas fa-list-ul me-2"></i>Features</h5>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row">
                                            @foreach($features as $feature)
                                                <div class="col-6 mb-2">
                                                    <div class="form-check custom-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="features[]"
                                                            value="{{ $feature->id }}" id="feature_{{ $feature->id }}">
                                                        <label class="form-check-label small" for="feature_{{ $feature->id }}">
                                                            {{ $feature->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="card shadow-sm border-0 bg-light">
                                    <div class="card-body p-4 text-center">
                                        <div class="mb-4 text-start">
                                            <label class="form-label fw-bold">Listing Status</label>
                                            <select name="status" class="form-select fw-600 text-dark">
                                                @if(auth()->user()->role === 'admin')
                                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                                    <option value="disapproved" {{ old('status') == 'disapproved' ? 'selected' : '' }}>Disapproved</option>
                                                    <option value="sold out" {{ old('status') == 'sold out' ? 'selected' : '' }}>Sold Out</option>
                                                @else
                                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="sold out" {{ old('status') == 'sold out' ? 'selected' : '' }}>Sold Out</option>
                                                @endif
                                            </select>
                                            <small class="text-muted">Only 'Approved' properties are shown on the website.</small>
                                        </div>

                                        <div class="form-check mb-4 d-inline-block text-start">
                                            <input class="form-check-input" type="checkbox" name="discount_available"
                                                id="discountCheck" {{ old('discount_available') ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="discountCheck">
                                                Mark as Discounted Property
                                            </label>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <button type="submit"
                                                class="btn btn-primary btn-lg fw-bold shadow-sm py-3 mb-2">
                                                <i class="fas fa-paper-plane me-2"></i>Publish Property
                                            </button>
                                            <a href="{{ route('available-properties.index') }}"
                                                class="btn btn-light btn-lg small text-muted border">
                                                Save as Draft
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    @push('scripts')
        <!-- CKEditor 5 -->
        <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
        <!-- Google Maps Places API -->
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtagAWzRL7h2Safzk7EwKK0x6v42RlsdI&libraries=places"></script>
        <script>
            // Initialize CKEditor
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'],
                })
                .catch(error => {
                    console.error(error);
                });

            function initAutocomplete() {
                const input = document.getElementById("location-input");
                const options = {
                    componentRestrictions: { country: "gb" },
                    fields: ["address_components", "geometry", "icon", "name"],
                    strictBounds: false,
                };

                const autocomplete = new google.maps.places.Autocomplete(input, options);

                autocomplete.addListener("place_changed", () => {
                    const place = autocomplete.getPlace();

                    if (!place.geometry || !place.geometry.location) {
                        // User entered the name of a Place that was not suggested and
                        // pressed the Enter key, or the Place Details request failed.
                        window.alert("No details available for input: '" + place.name + "'");
                        return;
                    }

                    // Fill hidden fields
                    document.getElementById("latitude").value = place.geometry.location.lat();
                    document.getElementById("longitude").value = place.geometry.location.lng();
                });
            }

            // Dynamic Unit Type Filtering & Bed/Bath Visibility
            const propertyTypeSelect = document.getElementById('property_type_id');
            const unitTypeSelect = document.getElementById('unit_type_id');
            const bedBathSection = document.getElementById('bed-bath-section');
            const unitTypeOptions = Array.from(unitTypeSelect.options);

            function filterUnitTypes() {
                const selectedTypeId = propertyTypeSelect.value;
                const selectedTypeName = propertyTypeSelect.options[propertyTypeSelect.selectedIndex]?.dataset.name || '';

                // Show/Hide Bed Bath section for Commercial
                if (selectedTypeName.includes('commercial')) {
                    bedBathSection.style.display = 'none';
                } else {
                    bedBathSection.style.display = 'flex';
                }

                // Filter Unit Types
                unitTypeSelect.innerHTML = '<option value="">Choose Category (Optional)</option>';

                if (selectedTypeId) {
                    const filteredOptions = unitTypeOptions.filter(opt =>
                        opt.dataset.propertyType === selectedTypeId || opt.value === ""
                    );

                    filteredOptions.forEach(opt => {
                        if (opt.value !== "") {
                            unitTypeSelect.appendChild(opt.cloneNode(true));
                        }
                    });
                }
            }

            propertyTypeSelect.addEventListener('change', filterUnitTypes);

            // Initial call if editing or validation failed
            if (propertyTypeSelect.value) {
                filterUnitTypes();
            }

            // Initialize if Google script is loaded
            if (typeof google === 'object' && typeof google.maps === 'object') {
                initAutocomplete();
            }
        </script>
    @endpush

@endsection