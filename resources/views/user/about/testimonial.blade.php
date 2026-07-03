@extends('layouts.user')

@section('title', 'Testimonials | Nitro Motors USA')
@section('meta_description', 'Read customer testimonials and see how Nitro Motors USA delivers a cleaner, more premium dealership experience.')

@section('content')
    @include('user.partials.page-hero', [
        'eyebrow' => 'Testimonials',
        'title' => 'Real buyer confidence is built through repeatable service.',
        'copy' => 'See how customers describe the Nitro Motors USA experience after buying, selling, financing, and coordinating delivery.',
        'media' => "linear-gradient(135deg, rgba(10,10,10,0.24), rgba(10,10,10,0.68)), url('https://images.unsplash.com/photo-1485291571150-772bcfc10da5?auto=format&fit=crop&w=1400&q=80')",
    ])

    <section class="relative z-10 bg-asphalt pb-16">
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="grid gap-5 lg:grid-cols-2">
                @foreach ($featuredReviews as $review)
                    <article class="featured-quote">
                        <div class="flex items-center gap-1 text-amber-300">
                            <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
                        </div>
                        <p class="featured-quote__copy">"{{ $review['quote'] }}"</p>
                        <div class="featured-quote__author">
                            <div class="featured-quote__avatar">{{ strtoupper(substr($review['name'], 0, 1)) }}</div>
                            <div>
                                <h3 class="featured-quote__name">{{ $review['name'] }}</h3>
                                <p class="featured-quote__location">{{ $review['location'] }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="relative z-10 bg-asphalt pb-16">
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="section-heading section-heading--compact">
                <p class="section-label">Client Voices</p>
                <h2 class="section-title mt-4">A wider look at what customers say after working with us.</h2>
            </div>

            <div class="testimonial-slider" data-carousel>
                <div class="testimonial-slider__viewport overflow-hidden">
                    <div class="testimonial-slider__track" data-carousel-track>
                        @foreach ($reviews as $review)
                            <article class="review-card testimonial-slide" data-carousel-slide>
                                <div class="flex items-center gap-1 text-amber-300">
                                    <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
                                </div>
                                <p class="mt-6 text-sm leading-8 text-zinc-300">"{{ $review['quote'] }}"</p>
                                <div class="mt-6 border-t border-white/10 pt-5">
                                    <div class="flex items-center gap-4">
                                        <div class="featured-quote__avatar">{{ strtoupper(substr($review['name'], 0, 1)) }}</div>
                                        <div>
                                            <h3 class="font-display text-xl font-semibold text-white">{{ $review['name'] }}</h3>
                                            <p class="mt-1 text-sm text-zinc-400">{{ $review['location'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-3">
                        @foreach ($reviews as $review)
                            <button type="button" class="testimonial-slider__dot {{ $loop->first ? 'is-active' : '' }}" data-carousel-dot="{{ $loop->index }}" aria-label="Go to review {{ $loop->iteration }}"></button>
                        @endforeach
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="button" class="hero-slider__nav" data-carousel-prev aria-label="Previous review"><span aria-hidden="true">&#8592;</span></button>
                        <button type="button" class="hero-slider__nav" data-carousel-next aria-label="Next review"><span aria-hidden="true">&#8594;</span></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('user.partials.page-cta', [
        'eyebrow' => 'Join Our Clients',
        'title' => 'Experience the same responsive support our customers keep talking about.',
        'copy' => 'Reach out for inventory guidance, a trade-in discussion, or a better way to buy remotely.',
        'primaryLabel' => 'Get Directions',
        'primaryUrl' => route('directions'),
        'secondaryLabel' => 'About Us',
        'secondaryUrl' => route('about'),
    ])
@endsection
