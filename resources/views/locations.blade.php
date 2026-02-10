@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="position-relative bg-blue text-white overflow-hidden">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <span class="d-block text-uppercase mb-2 text-pink fw-bold small">Find the best city for you</span>
                    <h1 class="display-3 fw-bold mb-4">OUR PROPERTY INVESTMENT LOCATIONS</h1>
                    <p class="lead opacity-90 fs-5 mb-0">Interested in finding out more about the opportunities we offer
                        across UK?</p>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <!-- Form could be added here if needed to match design exactly, otherwise kept clean -->
                </div>
            </div>
        </div>
    </section>

    <!-- Content & Form Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <!-- Left Content -->
                <div class="col-lg-8 pe-lg-5">

                    <div class="mb-5">
                        <p class="text-secondary lh-lg mb-4">
                            At Property Sourcing Group, we offer property investment opportunities across the whole of
                            England & Wales. However, we know that typically you will have your favourite locations, so we
                            have collated some helpful information on some of our most popular areas.
                        </p>

                        <h3 class="fw-bold text-blue mb-3">Who are we?</h3>
                        <p class="text-secondary lh-lg mb-4">
                            <strong>We're experts at sourcing outstanding local property.</strong><br>
                            We have years of experience in connecting investors with suitable high-yield property to meet
                            their requirements, and most importantly, at a price you will love!
                        </p>

                        <h3 class="fw-bold text-blue mb-3">Why choose us?</h3>
                        <p class="text-secondary lh-lg mb-4">
                            We're honest and down to earth - simply honest straight forward advice.
                            <br><br>
                            Most investment companies out there take a "one size fits all" approach to investment. We tailor
                            our sourcing to exactly what you need.
                        </p>

                        <h3 class="fw-bold text-blue mb-3">Where in the UK has the highest rental yields?</h3>
                        <p class="text-secondary lh-lg mb-4">
                            We've looked into rental data from across the UK and highlighted the highest yielding areas.
                        </p>
                        <ul class="text-secondary lh-lg mb-5">
                            <li class="mb-2"><strong class="text-dark">North West of England:</strong> 7.00%</li>
                            <li class="mb-2"><strong class="text-dark">North East of England:</strong> 6.10%</li>
                            <li class="mb-2"><strong class="text-dark">Yorkshire & The Humber:</strong> 5.80%</li>
                            <li class="mb-2"><strong class="text-dark">West Midlands:</strong> 5.10%</li>
                            <li class="mb-2"><strong class="text-dark">Scotland:</strong> 5.50%</li>
                        </ul>

                        <h3 class="fw-bold text-blue mb-4">Our locations</h3>
                        <p class="text-secondary mb-4">We have property investment opportunities across the UK, select a
                            region below matching your needs.</p>

                        <!-- Dynamic Locations List -->
                        <div class="row align-items-start">
                            <div class="col-md-5">
                                <div class="list-group list-group-flush border-start border-3 border-secondary ps-3"
                                    id="location-tabs">
                                    @foreach($locations as $index => $location)
                                        <a href="#region-{{ $location->id }}"
                                            class="list-group-item list-group-item-action border-0 fw-bold bg-transparent {{ $index == 0 ? 'text-blue active' : 'text-secondary' }}"
                                            data-bs-toggle="list">
                                            {{ $location->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="tab-content">
                                    @foreach($locations as $index => $location)
                                        <div class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}"
                                            id="region-{{ $location->id }}">
                                            <h4 class="fw-bold text-blue mb-3">{{ $location->name }} Properties</h4>


                                            <div class="d-flex flex-wrap gap-2">
                                                @forelse($location->children as $child)
                                                    <a href="{{ route('location.show', $child->slug) }}"
                                                        class="btn btn-outline-secondary btn-sm rounded-pill px-3">{{ $child->name }}</a>
                                                @empty
                                                    <p class="text-muted small">No specific areas listed for this region yet.</p>
                                                @endforelse
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Removed Old Grid -->
                </div>

                <!-- Right Sidebar Form -->
                <div class="col-lg-4 mt-5 mt-lg-0">
                    <div class="card border-0 shadow-sm p-4 sticky-top"
                        style="top: 100px; background-color: #fafafa; border-top: 5px solid var(--primary-pink);">
                        <h4 class="fw-bold text-blue mb-3">Invest in the UK</h4>
                        <form>
                            <div class="mb-3">
                                <input type="text" class="form-control bg-white" placeholder="Full Name*" required
                                    style="border: 1px solid #ddd; padding: 12px;">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control bg-white" placeholder="Email*" required
                                    style="border: 1px solid #ddd; padding: 12px;">
                            </div>
                            <div class="mb-3">
                                <input type="tel" class="form-control bg-white" placeholder="Phone*" required
                                    style="border: 1px solid #ddd; padding: 12px;">
                            </div>
                            <div class="mb-3">
                                <select class="form-select bg-white" style="border: 1px solid #ddd; padding: 12px;">
                                    <option>When are you ready?</option>
                                    <option>Immediately</option>
                                    <option>1-3 Months</option>
                                    <option>3+ Months</option>
                                </select>
                            </div>
                            <button class="btn btn-success w-100 py-3 fw-bold text-uppercase"
                                style="background-color: #4CAF50; border: none;">Get Started</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Features -->
    <section class="py-5 bg-blue text-white">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-3">
                    <div class="d-flex flex-column align-items-center">
                        <div class="mb-3 p-3 rounded-circle" style="background: rgba(255,255,255,0.1);"><i
                                class="bi bi-house-door fs-3"></i></div>
                        <h6 class="fw-bold">Exclusive Deals</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex flex-column align-items-center">
                        <div class="mb-3 p-3 rounded-circle" style="background: rgba(255,255,255,0.1);"><i
                                class="bi bi-shield-check fs-3"></i></div>
                        <h6 class="fw-bold">Transparent Service</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex flex-column align-items-center">
                        <div class="mb-3 p-3 rounded-circle" style="background: rgba(255,255,255,0.1);"><i
                                class="bi bi-graph-up fs-3"></i></div>
                        <h6 class="fw-bold">High Yields</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex flex-column align-items-center">
                        <div class="mb-3 p-3 rounded-circle" style="background: rgba(255,255,255,0.1);"><i
                                class="bi bi-person-check fs-3"></i></div>
                        <h6 class="fw-bold">Expert Support</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white text-center">
        <div class="container py-5">
            <h2 class="display-5 fw-bold text-blue mb-4">WHY INVEST WITH US?</h2>
            <p class="text-secondary mx-auto mb-5" style="max-width: 700px;">
                We don't just sell you a deal; we sell you a company. Your property sourcing partner. We have sourced
                property for beginners to large developers.
            </p>
            <a href="{{ route('home') }}#contact"
                class="btn btn-success px-5 py-3 rounded-pill fw-bold text-uppercase shadow-lg"
                style="letter-spacing: 1px; background-color: #4CAF50;">Invest Today</a>
        </div>
    </section>
@endsection