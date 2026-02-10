@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="position-relative bg-blue text-white overflow-hidden py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <div class="ps-4 border-start border-4 border-pink">
                        <h1 class="display-3 fw-bold mb-4">HOW DO WE WORK?</h1>
                        <p class="lead opacity-90 fs-5 mb-4">
                            Everything we do is built around our investors. Our objective is simple: to make investors feel
                            as comfortable as possible about the investment opportunities we source and pack for them.
                        </p>
                        <a href="{{ route('home') }}#contact"
                            class="btn btn-custom-pink px-5 py-3 rounded-pill fw-bold text-uppercase">Invest Today</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <div class="position-relative d-inline-block">
                        <!-- Replace with a placeholder or themed image -->
                        <div class="rounded-circle overflow-hidden border border-5 border-white shadow-lg mx-auto"
                            style="width: 400px; height: 400px;">
                            <img src="{{asset('img.jpg')}}" class="w-100 h-100 object-fit-cover" alt="Team working">
                        </div>
                        <!-- Decorative shapes to match design -->
                        <div class="position-absolute top-0 end-0 bg-pink p-4 rounded-3 shadow"
                            style="transform: translate(20%, -20%) rotate(15deg);">
                            <i class="bi bi-graph-up text-white fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Grid -->
    <section class="py-5 bg-light-custom">
        <div class="container text-center">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <i class="bi bi-search text-pink fs-1 mb-3"></i>
                        <h5 class="fw-bold">Large discounts on property</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <i class="bi bi-eye text-pink fs-1 mb-3"></i>
                        <h5 class="fw-bold">Completely transparent</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <i class="bi bi-gear text-pink fs-1 mb-3"></i>
                        <h5 class="fw-bold">Tailored investment opportunities</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <i class="bi bi-person-check text-pink fs-1 mb-3"></i>
                        <h5 class="fw-bold">We'll handle everything for you</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Comparison -->
    <section class="py-5 bg-white">
        <div class="container py-4 text-center">
            <h2 class="display-5 fw-bold text-blue mb-5">WHAT SERVICES DO WE OFFER?</h2>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="bg-blue text-white">
                        <tr>
                            <th class="py-4 fs-4" style="width: 40%;">Standard vs Premium</th>
                            <th class="py-4 fs-4">STANDARD</th>
                            <th class="py-4 fs-4 text-pink">PREMIUM</th>
                        </tr>
                    </thead>
                    <tbody class="fs-5">
                        <tr>
                            <td class="text-start ps-4">Sourcing Fee</td>
                            <td>£2,000 + VAT</td>
                            <td class="fw-bold">£5,000 + VAT</td>
                        </tr>
                        <tr>
                            <td class="text-start ps-4">BMV Percentage</td>
                            <td>10% - 20%</td>
                            <td class="fw-bold">25% - 40%</td>
                        </tr>
                        <tr>
                            <td class="text-start ps-4">Property Handing</td>
                            <td><i class="bi bi-check-circle-fill text-success"></i></td>
                            <td><i class="bi bi-check-circle-fill text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="text-start ps-4">Dedicated Account Manager</td>
                            <td><i class="bi bi-x-circle-fill text-danger"></i></td>
                            <td><i class="bi bi-check-circle-fill text-success"></i></td>
                        </tr>
                        <tr>
                            <td class="text-start ps-4">Off-Market Opportunities</td>
                            <td>Standard</td>
                            <td class="fw-bold">Exclusive First Look</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="py-5 bg-light">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-6 order-2 order-lg-1">
                    <h2 class="display-5 fw-bold text-blue mb-4 text-uppercase">WHICH SERVICE SHOULD YOU CHOOSE?</h2>
                    <p class="text-secondary lh-lg mb-4">
                        Our standard service is ideal for first time property investors who are looking to get their foot on
                        the property ladder and require clear, step by step guidance throughout the process.
                    </p>
                    <p class="text-secondary lh-lg mb-4">
                        Our premium service is for more experienced investors who require a more bespoke, tailored approach.
                        This service is designed to take everything off your hands, from sourcing through to management if
                        required.
                    </p>
                    <a href="{{ route('home') }}#contact" class="btn btn-custom-blue px-5">Learn More</a>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 mb-5 mb-lg-0 text-center">
                    <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&q=80&w=800"
                        class="img-fluid rounded-4 shadow-lg" alt="Choosing service">
                </div>
            </div>
        </div>
    </section>

    <!-- Sourcing Process Accordion -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center mb-5 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&q=80&w=800"
                        class="img-fluid rounded-4 shadow-lg" alt="Sourcing process">
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <h2 class="display-6 fw-bold text-blue mb-4">HOW DOES THE SOURCING PROCESS WORK?</h2>
                    <div class="accordion" id="processAccordion">
                        <div class="accordion-item mb-3 border-0 shadow-sm rounded">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold py-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#step1">
                                    1. Initial Consultation
                                </button>
                            </h2>
                            <div id="step1" class="accordion-collapse collapse show" data-bs-parent="#processAccordion">
                                <div class="accordion-body text-secondary">
                                    We start with a deep dive into your investment goals, budget, and preferred locations to
                                    build a custom profile.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3 border-0 shadow-sm rounded">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold py-3" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#step2">
                                    2. Property Search
                                </button>
                            </h2>
                            <div id="step2" class="accordion-collapse collapse" data-bs-parent="#processAccordion">
                                <div class="accordion-body text-secondary">
                                    Our team scours the market and our off-market networks to find deals that match your
                                    criteria.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3 border-0 shadow-sm rounded">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold py-3" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#step3">
                                    3. Due Diligence
                                </button>
                            </h2>
                            <div id="step3" class="accordion-collapse collapse" data-bs-parent="#processAccordion">
                                <div class="accordion-body text-secondary">
                                    We perform rigorous checks on the property, including valuation, rental yield analysis,
                                    and structural assessment.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-5 bg-blue text-white text-center">
        <div class="container py-5">
            <h2 class="display-4 fw-bold mb-4">READY TO START YOUR PROPERTY PORTFOLIO?</h2>
            <p class="lead opacity-75 mb-5 mx-auto" style="max-width: 800px;">
                Schedule a call with one of our expert advisors today and let's discuss how we can help you achieve your
                financial goals through property.
            </p>
            <a href="{{ route('home') }}#contact"
                class="btn btn-custom-pink px-5 py-3 rounded-pill fw-bold text-uppercase">Start Now</a>
        </div>
    </section>

@endsection