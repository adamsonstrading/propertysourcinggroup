@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="position-relative py-5 bg-blue text-white overflow-hidden" style="min-height: 450px;">
        <div class="position-absolute top-0 start-0 w-100 h-100"
            style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=1920'); background-size: cover; background-position: center; opacity: 0.2;">
        </div>
        <div class="container position-relative z-1 py-5">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="ps-4 border-start border-4 border-pink">
                        <h1 class="display-3 fw-bold mb-4">MEET THE TEAM</h1>
                        <p class="lead opacity-90 fs-4 mb-4">
                            Our mission: to be part of the journey when you start reaching your goals within the Property
                            Sourcing Company.
                        </p>
                        <a href="{{ route('home') }}#contact"
                            class="btn btn-custom-pink px-5 py-3 rounded-pill fw-bold text-uppercase">Invest Today</a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block text-center">
                    <i class="bi bi-people-fill text-white" style="font-size: 10rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5 bg-white">
        <div class="container py-5">

            @if ($leadership->count() > 0)
                <!-- Leadership Team -->
                <div class="mb-5">
                    <h2 class="display-6 fw-bold text-blue mb-2 border-start border-4 border-secondary ps-3">Our Leadership Team
                    </h2>
                    <p class="text-secondary mb-5">Highly experienced professionals leading the company strategy.</p>

                    <div class="row g-4 mb-5">
                        @foreach ($leadership as $member)
                            <div class="col-lg-3 col-md-6">
                                <div class="card border-0 shadow-sm h-100 team-card text-center">
                                    <img src="{{ $member->image_url ? asset('storage/' . $member->image_url) : 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&background=1E4072&color=fff&size=500' }}"
                                        class="card-img-top grayscale" alt="{{ $member->name }}">
                                    <div class="card-body">
                                        <h5 class="fw-bold text-blue mb-1">{{ $member->name }}</h5>
                                        <p class="small text-pink fw-bold text-uppercase mb-3">{{ $member->role }}</p>
                                        @if ($member->bio)
                                            <p class="small text-muted mb-4">{{ $member->bio }}</p>
                                        @endif
                                        @if ($member->linkedin_url)
                                            <a href="{{ $member->linkedin_url }}" target="_blank"
                                                class="btn btn-outline-blue btn-sm rounded-pill px-4">LinkedIn Profile</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($investment->count() > 0)
                <!-- Investment Team -->
                <div class="mb-5 pt-5">
                    <h2 class="display-6 fw-bold text-blue mb-2 border-start border-4 border-secondary ps-3">Our Investment
                        Team
                    </h2>
                    <p class="text-secondary mb-5">The boots on the ground finding and packaging your next big deal.</p>

                    <div class="row g-4 mb-5">
                        @foreach ($investment as $member)
                            <div class="col-lg-3 col-md-6">
                                <div class="card border-0 shadow-sm h-100 team-card text-center">
                                    <img src="{{ $member->image_url ? asset('storage/' . $member->image_url) : 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&background=F95CA8&color=fff&size=500' }}"
                                        class="card-img-top grayscale" alt="{{ $member->name }}">
                                    <div class="card-body">
                                        <h5 class="fw-bold text-blue mb-1">{{ $member->name }}</h5>
                                        <p class="small text-pink fw-bold text-uppercase mb-3">{{ $member->role }}</p>
                                        <a href="{{ route('home') }}#contact"
                                            class="btn btn-success btn-sm rounded-pill px-4">Contact
                                            {{ explode(' ', $member->name)[0] }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($vendor->count() > 0)
                <!-- Vendor Team -->
                <div class="mb-5 pt-5">
                    <h2 class="display-6 fw-bold text-blue mb-2 border-start border-4 border-secondary ps-3">Our Vendor Team
                    </h2>
                    <p class="text-secondary mb-5">Managing relationships with our vast network of property vendors.</p>

                    <div class="row g-4 mb-5">
                        @foreach ($vendor as $member)
                            <div class="col-lg-3 col-md-6">
                                <div class="card border-0 shadow-sm h-100 team-card text-center">
                                    <img src="{{ $member->image_url ? asset('storage/' . $member->image_url) : 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&background=1E4072&color=fff&size=500' }}"
                                        class="card-img-top grayscale" alt="{{ $member->name }}">
                                    <div class="card-body">
                                        <h5 class="fw-bold text-blue mb-1">{{ $member->name }}</h5>
                                        <p class="small text-pink fw-bold text-uppercase mb-3">{{ $member->role }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($marketing->count() > 0)
                <!-- Marketing Team -->
                <div class="mb-5 pt-5">
                    <h2 class="display-6 fw-bold text-blue mb-2 border-start border-4 border-secondary ps-3">Our Marketing
                        Team
                    </h2>
                    <p class="text-secondary mb-5">Spreading the word about our exclusive property opportunities.</p>

                    <div class="row g-4">
                        @foreach ($marketing as $member)
                            <div class="col-lg-3 col-md-6">
                                <div class="card border-0 shadow-sm h-100 team-card text-center">
                                    <img src="{{ $member->image_url ? asset('storage/' . $member->image_url) : 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&background=F95CA8&color=fff&size=500' }}"
                                        class="card-img-top grayscale" alt="{{ $member->name }}">
                                    <div class="card-body">
                                        <h5 class="fw-bold text-blue mb-1">{{ $member->name }}</h5>
                                        <p class="small text-pink fw-bold text-uppercase mb-3">{{ $member->role }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif


        </div>
    </section>

    <!-- Want to find out more -->
    <section class="py-5 bg-light">
        <div class="container py-5 text-center">
            <h2 class="display-5 fw-bold text-blue mb-4">WANT TO FIND OUT MORE?</h2>
            <p class="text-secondary mb-5">Our team is available 24/7 to answer any of your questions about property
                investment.</p>
            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3">
                <a href="tel:02033265420" class="btn btn-outline-blue btn-lg rounded-pill px-5 fw-bold">
                    <i class="bi bi-telephone-fill me-2"></i> 0203 3265 420
                </a>
                <a href="{{ route('home') }}#contact"
                    class="btn btn-custom-pink btn-lg px-5 py-3 rounded-pill fw-bold text-uppercase">Send a Message</a>
            </div>
        </div>
    </section>

    <style>
        .team-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 15px;
            overflow: hidden;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(30, 64, 114, 0.1) !important;
        }

        .grayscale {
            filter: grayscale(100%);
            transition: filter 0.3s;
        }

        .team-card:hover .grayscale {
            filter: grayscale(0%);
        }
    </style>

@endsection