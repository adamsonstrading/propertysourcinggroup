@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="position-relative bg-blue text-white overflow-hidden py-5 d-flex align-items-center"
        style="min-height: 500px; background-image: url('https://images.unsplash.com/photo-1590602847861-f357a9332bbc?auto=format&fit=crop&q=80&w=1920'); background-size: cover; background-position: center;">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
        <div class="container position-relative z-1 text-center py-5">
            <h1 class="display-3 fw-extrabold mb-2 text-uppercase tracking-wider">Invest In Success</h1>
            <p class="fs-4 fst-italic fw-light opacity-90">A Property Podcast</p>
        </div>
    </section>

    <!-- Industry/Knowledge Bar -->
    <section class="bg-blue text-white py-4 border-top border-bottom border-light border-opacity-25">
        <div class="container">
            <div class="row text-center g-0">
                <div class="col-md-4 border-end border-light border-opacity-25">
                    <div class="px-4">
                        <h5 class="fw-bold fs-4 fst-italic mb-1">Industry Leading</h5>
                        <p class="small text-pink fw-bold mb-0">Guests!</p>
                    </div>
                </div>
                <div class="col-md-4 border-end border-light border-opacity-25 mt-4 mt-md-0">
                    <div class="px-4">
                        <h5 class="fw-bold fs-4 fst-italic mb-1">Knowledge</h5>
                        <p class="small text-pink fw-bold mb-0">1,000+ Properties bought and sold</p>
                    </div>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="px-4">
                        <h5 class="fw-bold fs-4 fst-italic mb-1">Expert</h5>
                        <p class="small text-pink fw-bold mb-0">Opinions & advice</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Links -->
    <section class="py-5 bg-white border-bottom border-light">
        <div class="container py-4 text-center">
            <h2 class="display-6 fw-bold text-blue mb-4">Listen & Follow For Free:</h2>
            <div class="d-flex justify-content-center gap-3">
                <a href="#" class="social-icon bg-secondary p-3 rounded-3 text-white transition-all hover-up">
                    <i class="bi bi-apple fs-1"></i>
                </a>
                <a href="#" class="social-icon bg-success p-3 rounded-3 text-white transition-all hover-up">
                    <i class="bi bi-spotify fs-1"></i>
                </a>
                <a href="#" class="social-icon bg-danger p-3 rounded-3 text-white transition-all hover-up">
                    <i class="bi bi-youtube fs-1"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="text-center mb-5 mx-auto" style="max-width: 900px;">
                <h2 class="display-5 fw-bold text-blue mb-1">About The Podcast</h2>
                <p class="text-pink fst-italic fs-5 mb-4">Real experience, from real investors</p>

                <div class="text-secondary lh-lg fs-5">
                    <p class="mb-4">
                        Welcome to <span class="fw-bold">Invest In Success</span>, brought to you by The Property Sourcing
                        Company. Join hosts <span class="text-blue fw-bold">Jonny Christie</span> and <span
                            class="text-blue fw-bold">Jessica Chambers</span> as they dive into the world of property –
                        sharing real deals, real stories, and real success.
                    </p>
                    <p class="mb-4">
                        From insider tips to inspiring journeys, every episode is packed with valuable insights for
                        investors, developers, and property enthusiasts alike.
                    </p>
                    <p class="mb-4">
                        Tune in, get inspired, and take your property game to the next level.
                    </p>
                    <p class="fw-bold text-blue">
                        New episodes every other Wednesday!
                    </p>
                </div>
            </div>

            <!-- Player Placeholder (MATCHING IMAGE) -->
            <div class="mx-auto" style="max-width: 800px;">
                <div class="bg-dark rounded-4 p-5 text-center text-white shadow-lg overflow-hidden position-relative"
                    style="min-height: 250px;">
                    <div class="position-relative z-1 py-4">
                        <h3 class="fw-bold mb-3">Latest Episode Player</h3>
                        <p class="opacity-75 mb-4 small">Something went wrong, please try again later.</p>
                        <a href="{{ route('home') }}"
                            class="btn btn-light rounded-pill px-5 fw-bold text-uppercase">Home</a>
                    </div>
                    <!-- Decorative background nodes -->
                    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10"
                        style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 20px 20px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Icon Features Bar -->
    <section class="py-5 bg-light-custom">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div
                        class="d-flex align-items-start p-4 bg-white rounded shadow-sm h-100 border-bottom border-4 border-pink">
                        <div class="bg-pink-soft p-3 rounded-circle me-3">
                            <i class="bi bi-graph-up-arrow text-pink fs-3"></i>
                        </div>
                        <div>
                            <p class="fw-bold text-blue mb-0">Discounted property with high yields</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div
                        class="d-flex align-items-start p-4 bg-white rounded shadow-sm h-100 border-bottom border-4 border-teal">
                        <div class="bg-blue-soft p-3 rounded-circle me-3">
                            <i class="bi bi-shield-check text-blue fs-3"></i>
                        </div>
                        <div>
                            <p class="fw-bold text-blue mb-0">Transparent & honest throughout the process</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div
                        class="d-flex align-items-start p-4 bg-white rounded shadow-sm h-100 border-bottom border-4 border-success">
                        <div class="bg-success-soft p-3 rounded-circle me-3">
                            <i class="bi bi-people-fill text-success fs-3"></i>
                        </div>
                        <div>
                            <p class="fw-bold text-blue mb-0">We're property experts with years of experience</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div
                        class="d-flex align-items-start p-4 bg-white rounded shadow-sm h-100 border-bottom border-4 border-blue">
                        <div class="bg-teal-soft p-3 rounded-circle me-3">
                            <i class="bi bi-gem text-teal fs-3"></i>
                        </div>
                        <div>
                            <p class="fw-bold text-blue mb-0">Investment opportunities tailored to your requirements</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Invest Layout (Geometric) -->
    <section class="py-5 bg-white overflow-hidden">
        <div class="container py-5 text-center position-relative">
            <!-- Floating shapes like in the image -->
            <div class="position-absolute d-none d-lg-block"
                style="top: 0; left: 10%; transform: rotate(-15deg); opacity: 0.1;">
                <img src="{{ asset('img/shape-hex.svg') }}"
                    onerror="this.src='https://res.cloudinary.com/dv5h6otue/image/upload/v1700000000/hex-shape.png'"
                    width="300" alt="">
            </div>

            <div class="position-relative z-1 mx-auto" style="max-width: 800px;">
                <!-- Geometric Cube-like decoration background -->
                <div class="mb-4">
                    <div class="bg-pink-soft mx-auto rounded-circle d-flex align-items-center justify-content-center"
                        style="width: 120px; height: 120px;">
                        <i class="bi bi-building text-pink display-4"></i>
                    </div>
                </div>

                <h2 class="display-4 fw-black text-blue mb-4 text-uppercase">Why Invest With Us?</h2>

                <div class="text-secondary lh-lg mb-5 px-lg-5">
                    <p class="mb-4">
                        Simply put, we'll get you the best possible deal. Our sister company, The Property Sourcing Company,
                        have been in the property buying industry for years & we have access to all their stock which is at
                        a price point that is ready for investors to buy and make a great return on.
                    </p>
                    <p class="fw-bold text-pink">
                        No middlemen, no stress & no hassle. We make investing in property and growing your portfolio as
                        easy as it possibly can be.
                    </p>
                </div>

                <a href="#" class="btn btn-custom-pink px-5 py-3 rounded-pill fw-bold text-uppercase fs-5">Invest today</a>
            </div>
        </div>
    </section>

    <style>
        .fw-extrabold {
            font-weight: 800;
        }

        .fw-black {
            font-weight: 900;
        }

        .tracking-wider {
            letter-spacing: 0.1em;
        }

        .hover-up {
            transition: all 0.3s ease;
        }

        .hover-up:hover {
            transform: translateY(-10px);
        }

        .bg-pink-soft {
            background-color: rgba(249, 92, 168, 0.1);
        }

        .bg-blue-soft {
            background-color: rgba(30, 64, 114, 0.1);
        }

        .bg-success-soft {
            background-color: rgba(25, 135, 84, 0.1);
        }

        .bg-teal-soft {
            background-color: rgba(13, 202, 240, 0.1);
        }

        .border-teal {
            border-color: #0dcaf0 !important;
        }

        .text-teal {
            color: #0dcaf0 !important;
        }
    </style>

@endsection