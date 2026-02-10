@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 position-relative text-white"
        style="background: linear-gradient(rgba(30, 64, 114, 0.95), rgba(30, 64, 114, 0.95)), url('https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=2000&q=80'); background-size: cover; background-position: center; min-height: 500px;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="badge bg-pink px-4 py-2 rounded-pill mb-3 text-uppercase fw-bold">Free Event</span>
                    <h1 class="display-2 fw-bold mb-4">THE PROPERTY INVESTOR SEMINAR</h1>
                    <h3 class="mb-4 opacity-90">OUR PROPERTY INVESTMENT SEMINAR UK 2025</h3>
                    <p class="lead mb-4 opacity-75">Next event to be announced shortly, register your interest today so you
                        don't miss out!</p>
                    <a href="#register" class="btn btn-custom-pink btn-lg px-5 py-3 rounded-pill fw-bold">Register Your
                        Interest</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Introduction -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <p class="lead text-secondary lh-lg mb-4">
                        Are you ready to take your property investment journey to the next level? The Property Sourcing
                        Company's intensive two-day seminar will equip you with the proven strategies and insider knowledge
                        to achieve financial freedom.
                    </p>
                    <p class="text-secondary lh-lg mb-4">
                        Our team, backed by a century of combined experience, and a network of leading UK property
                        companies, will share the real-world tactics we've used to transform investments into thriving
                        multi-million pound portfolios. We'll address the common challenges investors face, making your path
                        to success smoother and faster.
                    </p>
                    <p class="text-secondary lh-lg mb-4">
                        Join our Investment Consultants, Founder Jonathan Christie, and expert guest speakers to explore
                        three powerful strategies designed to propel you towards financial freedom.
                    </p>
                    <div class="alert alert-info border-0 bg-light-blue text-blue">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>All-Inclusive Experience:</strong> Enjoy a luxurious stay at Rudding Park Hotel (subject to
                        a £250 deposit, fully refundable upon attendance) and delicious meals throughout the Seminar.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Attend -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-blue mb-3">WHY ATTEND OUR PROPERTY INVESTMENT SEMINAR?</h2>
                <div class="mx-auto bg-pink mb-4" style="height: 3px; width: 60px;"></div>
                <p class="lead text-secondary mx-auto" style="max-width: 800px;">
                    Transform your financial future with The Property Sourcing Company's Property Investment Seminar – your
                    proven path to turning £100,000 into £1 Million.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="bi bi-people-fill text-pink fs-1"></i>
                            </div>
                            <h5 class="fw-bold text-blue mb-3">Build Your Network</h5>
                            <p class="text-secondary mb-0">Connect with seasoned investors, mortgage experts, solicitors and
                                tax specialists vital to your success.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="bi bi-graph-up-arrow text-pink fs-1"></i>
                            </div>
                            <h5 class="fw-bold text-blue mb-3">Sharpen Your Investment Strategies</h5>
                            <p class="text-secondary mb-0">Learn proven tactics for Buy to Let, BRRR, property flipping and
                                building a multi-million pound portfolio.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="bi bi-key-fill text-pink fs-1"></i>
                            </div>
                            <h5 class="fw-bold text-blue mb-3">Uncover Hidden Deals</h5>
                            <p class="text-secondary mb-0">Gain exclusive access to off-market properties unavailable to the
                                wider public.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="bi bi-cash-stack text-pink fs-1"></i>
                            </div>
                            <h5 class="fw-bold text-blue mb-3">Unlock Tailored Financing</h5>
                            <p class="text-secondary mb-0">Discover financing options from bridging loans to specialised
                                mortgages, making your dream deals a reality.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="bi bi-lightbulb-fill text-pink fs-1"></i>
                            </div>
                            <h5 class="fw-bold text-blue mb-3">Get Expert Guidance</h5>
                            <p class="text-secondary mb-0">Receive personalised advice on tax strategies, legal matters and
                                mortgage solutions to maximise returns.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 hover-lift">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="bi bi-trophy-fill text-pink fs-1"></i>
                            </div>
                            <h5 class="fw-bold text-blue mb-3">Gain Insider Insights</h5>
                            <p class="text-secondary mb-0">Stay ahead with the latest market trends and analysis for
                                informed investment decisions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Cover -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-blue mb-3">WHAT DO WE COVER?</h2>
                <div class="mx-auto bg-pink mb-4" style="height: 3px; width: 60px;"></div>
                <p class="lead text-secondary mx-auto" style="max-width: 800px;">
                    Unlock your property investment potential at our Property Investment Seminar. Our comprehensive
                    programme covers the essential things you need to know.
                </p>
            </div>

            <div class="row g-4 align-items-center mb-5">
                <div class="col-lg-6">
                    <div class="pe-lg-4">
                        <h4 class="fw-bold text-blue mb-3"><i class="bi bi-bank2 text-pink me-2"></i> Smart Financing</h4>
                        <p class="text-secondary lh-lg">
                            Discover the diverse world of property financing. We'll delve into bridging finance, commercial
                            lending, specialised mortgages and how to leverage them to secure your ideal deals.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=800&q=80"
                        class="img-fluid rounded-4 shadow" alt="Financing">
                </div>
            </div>

            <div class="row g-4 align-items-center mb-5">
                <div class="col-lg-6 order-lg-2">
                    <div class="ps-lg-4">
                        <h4 class="fw-bold text-blue mb-3"><i class="bi bi-building text-pink me-2"></i> Strategic Portfolio
                            Growth</h4>
                        <p class="text-secondary lh-lg">
                            Learn how to build a wealth-generating property portfolio, with a specific focus on achieving
                            the £1 million milestone. Get proven techniques to make your investment capital work harder.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=800&q=80"
                        class="img-fluid rounded-4 shadow" alt="Portfolio">
                </div>
            </div>

            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="pe-lg-4">
                        <h4 class="fw-bold text-blue mb-3"><i class="bi bi-gem text-pink me-2"></i> The Power of Off-Market
                            Deals</h4>
                        <p class="text-secondary lh-lg">
                            Uncover the secrets of sourcing lucrative off-market properties directly from vendors. These
                            often below-market-value opportunities are hidden gems for savvy investors.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1582407947304-fd86f028f716?auto=format&fit=crop&w=800&q=80"
                        class="img-fluid rounded-4 shadow" alt="Off Market">
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Form -->
    <section id="register" class="py-5 bg-blue text-white">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-5">
                        <h2 class="fw-bold mb-3">REGISTER YOUR INTEREST</h2>
                        <p class="lead opacity-90">Complete the form below to secure your spot at our next Property
                            Investment Seminar.</p>
                    </div>

                    <div class="bg-white rounded-4 p-5 shadow-lg">
                        <form action="{{ route('inquiry.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="event">
                            <input type="hidden" name="source_page" value="Investor Event Registration">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-bold">Full Name*</label>
                                    <input type="text" name="name" class="form-control form-control-lg"
                                        placeholder="Enter your full name" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-bold">Email Address*</label>
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        placeholder="Enter your email" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-bold">Phone Number*</label>
                                    <input type="tel" name="phone" class="form-control form-control-lg"
                                        placeholder="Enter your phone number" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-dark fw-bold">Investment Experience*</label>
                                    <select name="experience_level" class="form-select form-select-lg" required>
                                        <option value="">Select your experience level</option>
                                        <option value="beginner">Beginner</option>
                                        <option value="intermediate">Intermediate</option>
                                        <option value="advanced">Advanced</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label text-dark fw-bold">Additional Comments (Optional)</label>
                                    <textarea name="comments" class="form-control" rows="3"
                                        placeholder="Any questions or special requirements?"></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" required>
                                        <label class="form-check-label text-dark small" for="terms">
                                            I agree to receive updates about the Property Investment Seminar and understand
                                            that investment strategies discussed typically require a cash liquidity of
                                            £100,000+.
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <button type="submit"
                                        class="btn btn-custom-pink btn-lg px-5 py-3 rounded-pill fw-bold">SUBMIT
                                        REGISTRATION</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-5 bg-pink text-white text-center">
        <div class="container py-4">
            <h3 class="fw-bold mb-3">Don't Miss This Opportunity!</h3>
            <p class="lead mb-4 opacity-90">Join hundreds of successful investors who have transformed their portfolios
                through our seminars.</p>
            <a href="#register" class="btn btn-light btn-lg text-pink fw-bold px-5 py-3 rounded-pill">Register Now</a>
        </div>
    </section>

    <style>
        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15) !important;
        }

        .bg-light-blue {
            background-color: #e8f4f8 !important;
        }
    </style>
@endsection