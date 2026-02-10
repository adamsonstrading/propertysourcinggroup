@extends('layouts.app')

@section('content')
    <section class="py-5 bg-blue text-white">
        <div class="container py-5 text-center">
            <h1 class="display-3 fw-bold mb-4">Frequently Asked Questions</h1>
            <p class="fs-5 opacity-75 mx-auto" style="max-width: 800px;">Everything you need to know about property sourcing
                and investing with PSG.</p>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="accordion accordion-flush shadow-sm rounded-4 overflow-hidden border" id="faqAccordion">

                        @forelse($faqs as $index => $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }} fw-bold py-4 fs-5"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="faq{{ $faq->id }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body py-4 text-secondary lh-lg">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <p class="text-muted">No FAQs available at the moment.</p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .accordion-button:not(.collapsed) {
            background-color: var(--primary-pink);
            color: white;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0, 0, 0, .125);
        }

        .accordion-button::after {
            filter: grayscale(1) invert(0);
        }

        .accordion-button:not(.collapsed)::after {
            filter: grayscale(1) invert(1);
        }
    </style>
@endsection