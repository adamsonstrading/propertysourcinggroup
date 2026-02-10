@extends('layouts.app')

@section('content')
    <!-- Blog Hero -->
    <section class="py-5 bg-blue text-white">
        <div class="container py-4 text-center">
            <h1 class="display-3 fw-bold mb-3">Property News & Insights</h1>
            <p class="fs-5 opacity-75 mx-auto" style="max-width: 700px;">
                Stay updated with the latest trends, investment tips, and market analysis from the UK's property experts.
            </p>
        </div>
    </section>

    <!-- Blog Grid -->
    <section class="py-5 bg-white">
        <div class="container py-4">
            <div class="row g-4">
                @forelse($articles as $post)
                    <div class="col-lg-4 col-md-6">
                        <article class="card h-100 border-0 shadow-sm hover-up transition-all">
                            <div class="position-relative overflow-hidden" style="height: 240px;">
                                <img src="{{ $post->image_url ? asset('storage/' . $post->image_url) : 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&q=80&w=800' }}"
                                    class="card-img-top h-100 w-100 object-fit-cover" alt="{{ $post->title }}">
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-pink px-3 py-2 rounded-pill fw-bold shadow-sm">News</span>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <span class="small text-muted"><i
                                            class="bi bi-calendar3 me-2"></i>{{ \Carbon\Carbon::parse($post->published_at ?? $post->created_at)->format('M d, Y') }}</span>
                                    <span class="mx-2 text-muted opacity-25">|</span>
                                    <span class="small text-muted"><i
                                            class="bi bi-person me-2"></i>{{ $post->author_name ?? 'Admin' }}</span>
                                </div>
                                <h4 class="fw-bold text-blue mb-3 lh-sm">
                                    <a href="{{ route('news.show', $post->slug) }}"
                                        class="text-decoration-none text-blue hover-pink">{{ Str::limit($post->title, 60) }}</a>
                                </h4>
                                <p class="text-secondary small mb-4">
                                    {{ Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}
                                </p>
                                <a href="{{ route('news.show', $post->slug) }}"
                                    class="btn btn-link text-pink fw-bold p-0 text-decoration-none text-uppercase small tracking-wider">
                                    Read Full Article <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="opacity-25 mb-4">
                            <i class="bi bi-journal-x display-1"></i>
                        </div>
                        <h3 class="text-muted">No news articles published yet.</h3>
                        <p class="text-secondary">Please check back later for exciting property updates!</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $articles->links() }}
            </div>
        </div>
    </section>

    <!-- Newsletter CTA -->
    <section class="py-5 bg-light-custom text-center border-top">
        <div class="container py-4">
            <div class="mx-auto" style="max-width: 600px;">
                <h2 class="fw-bold text-blue mb-3">Don't miss a beat!</h2>
                <p class="text-secondary mb-4">Subscribe to our newsletter and get the latest property deals and news
                    delivered straight to your inbox.</p>
                <form class="d-flex gap-2 justify-content-center">
                    <input type="email" class="form-control form-control-lg rounded-pill px-4 shadow-sm"
                        placeholder="Your Email Address" style="max-width: 350px;">
                    <button type="button" class="btn btn-custom-pink px-5 rounded-pill shadow-sm">Subscribe</button>
                </form>
            </div>
        </div>
    </section>

    <style>
        .hover-up:hover {
            transform: translateY(-10px);
        }

        .hover-pink:hover {
            color: var(--primary-pink) !important;
        }

        .tracking-wider {
            letter-spacing: 1px;
        }

        .bg-light-custom {
            background-color: #f8fbff;
        }
    </style>

@endsection