@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="position-relative py-5 bg-blue text-white overflow-hidden"
        style="background-image: url('{{ Str::startsWith($service->hero_image_url, 'http') ? $service->hero_image_url : asset('storage/' . $service->hero_image_url) }}'); background-size: cover; background-position: center;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(30, 64, 114, 0.85);"></div>

        <div class="container position-relative z-10 py-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <span class="badge bg-pink text-white px-3 py-2 rounded-pill mb-3">Professional Service</span>
                    <h1 class="display-3 fw-bold mb-4">{{ $service->title }}</h1>
                    <p class="lead opacity-90 mb-0 fs-4">{{ $service->short_description }}</p>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="bg-white p-4 rounded-4 shadow-lg text-dark">
                        <h4 class="fw-bold text-blue mb-1">Invest Today</h4>
                        <p class="text-muted small mb-3">Fill in the form to get started.</p>
                        <form action="{{ route('inquiry.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="investor">
                            <input type="hidden" name="source_page" value="Service Page - {{ $service->title }}">

                            <div class="mb-2">
                                <input type="text" name="name" class="form-control bg-light" placeholder="Full Name*"
                                    required>
                            </div>
                            <div class="mb-2">
                                <input type="email" name="email" class="form-control bg-light" placeholder="Email Address*"
                                    required>
                            </div>
                            <div class="mb-2">
                                <input type="tel" name="phone" class="form-control bg-light" placeholder="Phone Number*"
                                    required>
                            </div>
                            <div class="mb-3">
                                <select name="ready_to_buy" class="form-select bg-light" required>
                                    <option value="">When are you ready to buy?*</option>
                                    <option value="Immediately">Immediately</option>
                                    <option value="1-3 Months">Within 1-3 Months</option>
                                    <option value="3-6 Months">Within 3-6 Months</option>
                                    <option value="Just Researching">Just Researching</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-custom-pink w-100 fw-bold">Get Information</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Author Section -->
    @if($service->author_name)
        <div class="bg-light py-3 border-bottom">
            <div class="container d-flex align-items-center">
                @if($service->author_image_url)
                    <img src="{{ Str::startsWith($service->author_image_url, 'http') ? $service->author_image_url : asset('storage/' . $service->author_image_url) }}"
                        alt="{{ $service->author_name }}" class="rounded-circle me-3"
                        style="width: 50px; height: 50px; object-fit: cover;">
                @else
                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-3"
                        style="width: 50px; height: 50px;">
                        <i class="bi bi-person-fill fs-4"></i>
                    </div>
                @endif
                <div>
                    <span class="text-muted small text-uppercase d-block">Written By</span>
                    <span class="fw-bold text-blue">{{ $service->author_name }}</span>
                </div>
            </div>
        </div>
    @endif

    <!-- Dynamic Content Sections -->
    <section class="py-5 bg-white">
        <div class="container">

            <!-- Main Description (Intro) -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10">
                    <div class="lead lh-lg text-secondary">
                        {{-- Assuming short_description is the intro context or part of sections --}}
                    </div>
                </div>
            </div>

            @foreach($service->sections as $section)
                <div class="row align-items-center mb-5 gy-4">
                    @if($section->type == 'text_block')
                        <div class="col-12">
                            @if($section->heading)
                            <h2 class="fw-bold text-blue mb-3">{{ $section->heading }}</h2> @endif
                            <div class="text-secondary lh-lg service-dynamic-content">{!! $section->content !!}</div>
                        </div>
                    @elseif($section->type == 'image_left')
                        <div class="col-lg-6">
                            @if($section->image_url)
                                <img src="{{ Str::startsWith($section->image_url, 'http') ? $section->image_url : asset('storage/' . $section->image_url) }}"
                                    class="img-fluid rounded-3 shadow-sm w-100" alt="Image">
                            @endif
                        </div>
                        <div class="col-lg-6">
                            @if($section->heading)
                            <h2 class="fw-bold text-blue mb-3">{{ $section->heading }}</h2> @endif
                            <div class="text-secondary lh-lg service-dynamic-content">{!! $section->content !!}</div>
                        </div>
                    @elseif($section->type == 'image_right')
                        <div class="col-lg-6 order-lg-2">
                            @if($section->image_url)
                                <img src="{{ Str::startsWith($section->image_url, 'http') ? $section->image_url : asset('storage/' . $section->image_url) }}"
                                    class="img-fluid rounded-3 shadow-sm w-100" alt="Image">
                            @endif
                        </div>
                        <div class="col-lg-6 order-lg-1">
                            @if($section->heading)
                            <h2 class="fw-bold text-blue mb-3">{{ $section->heading }}</h2> @endif
                            <div class="text-secondary lh-lg service-dynamic-content">{!! $section->content !!}</div>
                        </div>
                    @elseif($section->type == 'full_width_image')
                        <div class="col-12">
                            @if($section->heading)
                                <h2 class="fw-bold text-blue mb-4 text-center">{{ $section->heading }}</h2>
                            @endif
                            @if($section->image_url)
                                <div class="mb-4">
                                    <img src="{{ Str::startsWith($section->image_url, 'http') ? $section->image_url : asset('storage/' . $section->image_url) }}"
                                        class="img-fluid rounded-4 shadow w-100" alt="Full Image">
                                </div>
                            @endif
                            @if($section->content)
                                <div class="row justify-content-center">
                                    <div class="col-lg-10">
                                        <div class="text-secondary lh-lg service-dynamic-content">
                                            {!! $section->content !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    <!-- Recent Properties Grid -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-blue">RECENT PROPERTIES</h2>
                <div class="mx-auto bg-pink mb-3" style="height: 3px; width: 60px;"></div>
                <p class="text-muted">Explore our current exclusive deals.</p>
            </div>
            <div class="row g-4 justify-content-center">
                @forelse($properties->take(3) as $property)
                    <div class="col-lg-4 col-md-6">
                        <div
                            class="recent-property-card border rounded-4 overflow-hidden h-100 shadow-sm transition-hover bg-white d-flex flex-column">
                            <!-- Top Info Bar -->
                            <div class="bg-pink py-2 px-3 text-center">
                                <span
                                    class="text-white fw-bold small text-uppercase letter-spacing-1">{{ $property->type ?? 'Investment' }}</span>
                            </div>

                            <!-- Image Header -->
                            <div class="position-relative" style="height: 200px;">
                                <img src="{{ $property->image_url ? (Str::startsWith($property->image_url, 'http') ? $property->image_url : asset('storage/' . $property->image_url)) : 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&q=80&w=600' }}"
                                    class="w-100 h-100 object-fit-cover" alt="{{ $property->location }}">

                                <div
                                    class="position-absolute bottom-0 start-0 w-100 py-2 px-3 bg-blue bg-opacity-90 text-white fw-bold text-center">
                                    {{ $property->location }}
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="p-4 flex-grow-1 d-flex flex-column">
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

                                <div class="mt-auto">
                                    <a href="{{ route('become-investor') }}"
                                        class="btn btn-custom-blue w-100 py-2 fw-bold text-uppercase">Start your property
                                        journey</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted py-4">No properties found.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- FAQs Section -->
    @if($service->faqs->count() > 0)
        <section class="py-5 bg-white">
            <div class="container py-4">
                <h2 class="fw-bold text-blue mb-5 text-center">Frequently Asked Questions</h2>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="accordion accordion-flush" id="faqAccordion">
                            @foreach($service->faqs as $index => $faq)
                                <div class="accordion-item border-bottom">
                                    <h2 class="accordion-header">
                                        <button
                                            class="accordion-button {{ $index != 0 ? 'collapsed' : '' }} fw-bold text-dark bg-transparent"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#faq-{{ $faq->id }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                    <div id="faq-{{ $faq->id }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body text-secondary lh-lg">
                                            {!! $faq->answer !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Final CTA -->
    <section class="py-5 bg-pink text-center text-white">
        <div class="container">
            <h2 class="fw-bold mb-3">Ready to Invest in {{ $service->title }}?</h2>
            <p class="opacity-75 mb-4">Contact our expert team today to get started.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('become-investor') }}" class="btn btn-light text-pink fw-bold rounded-pill px-5">Get
                    Started</a>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        .service-dynamic-content h2,
        .service-dynamic-content h3 {
            color: var(--primary-blue);
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1.25rem;
        }

        .service-dynamic-content p {
            margin-bottom: 1.5rem;
        }

        .service-dynamic-content ul,
        .service-dynamic-content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .service-dynamic-content li {
            margin-bottom: 0.5rem;
        }

        .service-dynamic-content a {
            color: var(--primary-pink);
            text-decoration: underline;
        }

        .service-dynamic-content a:hover {
            color: var(--primary-blue);
        }

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
@endpush