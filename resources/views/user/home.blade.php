@extends('layouts.user')

@section('title', 'Nitro Motors USA | Premium Car Marketplace')
@section('meta_description', 'Browse modern, performance-focused inventory at Nitro Motors USA.')

@section('content')
    <section class="relative z-10 min-h-screen">
        <div class="hero-slider relative min-h-screen overflow-hidden bg-neutral-950" data-slider data-slider-interval="5500">
            <div class="absolute inset-0">
                @foreach ($slides as $index => $slide)
                    <div class="hero-slider__bg absolute inset-0 {{ $index === 0 ? 'is-active' : '' }}" data-slide-bg style="background-image: linear-gradient(90deg, rgba(5, 8, 15, 0.92) 0%, rgba(5, 8, 15, 0.74) 42%, rgba(5, 8, 15, 0.24) 100%), url('{{ $slide['background'] }}');"></div>
                @endforeach
            </div>

            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>

            <div class="relative grid min-h-screen lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
                @foreach ($slides as $index => $slide)
                    <div class="hero-slider__content absolute inset-0 grid min-h-screen items-center lg:grid-cols-[0.95fr_1.05fr] {{ $index === 0 ? 'is-active' : '' }}" data-slide-panel>
                        <div class="hero-copy-wrap flex h-full items-center px-4 pb-16 pt-24 sm:px-8 sm:pt-28 lg:px-12 lg:pb-20 lg:pt-28 xl:px-16">
                            <div class="max-w-2xl lg:max-w-[46rem]">
                                <h1 class="hero-title max-w-[14ch] text-white">{{ $slide['title'] }}</h1>

                                <div class="hero-actions mt-8 flex flex-wrap items-center gap-5">
                                    <a href="#inventory" class="hero-actions__primary">
                                        <span>Explore Inventory</span>
                                        <span class="hero-actions__arrow">&#8594;</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="hero-media-wrap flex h-full items-center justify-end px-4 pb-20 pt-24 sm:px-8 sm:pt-28 lg:px-12 lg:pb-24 lg:pt-6 xl:px-16">
                            <div class="hero-slider__media relative w-full max-w-3xl">
                                <div class="absolute inset-x-8 bottom-8 top-10 rounded-full bg-ember/12 blur-3xl"></div>
                                <div class="hero-slider__frame relative ml-auto w-full max-w-2xl overflow-hidden rounded-[28px] border border-white/10 bg-neutral-950/20 shadow-[0_28px_60px_rgba(0,0,0,0.45)]">
                                    <img src="{{ $slide['car_image'] }}" alt="{{ $slide['name'] }}" class="hero-slider__car h-full w-full object-cover">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="absolute bottom-6 right-4 z-20 flex items-center gap-3 sm:right-8 lg:bottom-8 lg:right-12 xl:right-16">
                <div class="flex items-center gap-3">
                    <button type="button" class="hero-slider__nav" data-slide-prev aria-label="Previous slide"><span aria-hidden="true">&#8592;</span></button>
                    <button type="button" class="hero-slider__nav" data-slide-next aria-label="Next slide"><span aria-hidden="true">&#8594;</span></button>
                </div>
            </div>
        </div>
    </section>

    <section id="inventory" class="relative z-10 bg-asphalt pb-16 pt-10" data-reveal-section>
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="search-band reveal-card reveal-card--hero-band rounded-[32px] border border-white/10 px-5 py-6 shadow-[0_20px_70px_rgba(0,0,0,0.35)] sm:px-6 lg:px-8" data-reveal>
                <div class="grid gap-5 xl:grid-cols-[repeat(5,minmax(0,1fr))]">
                    <label class="block">
                        <span class="search-band__label">By Year</span>
                        <select class="search-band__field"><option>Year</option><option>2024</option><option>2023</option><option>2022</option></select>
                    </label>
                    <label class="block">
                        <span class="search-band__label">By Make</span>
                        <select class="search-band__field"><option>Make</option><option>Porsche</option><option>BMW</option><option>Mercedes-Benz</option><option>Ford</option></select>
                    </label>
                    <label class="block">
                        <span class="search-band__label">By Model</span>
                        <select class="search-band__field"><option>Model</option><option>911 Carrera</option><option>X7 M60i</option><option>EQE SUV</option></select>
                    </label>
                    <label class="block">
                        <span class="search-band__label">By Mileage</span>
                        <select class="search-band__field"><option>Mileage</option><option>Under 5,000</option><option>Under 10,000</option><option>Under 20,000</option></select>
                    </label>
                    <label class="block">
                        <span class="search-band__label">By Trim</span>
                        <select class="search-band__field"><option>Trim</option><option>Premium</option><option>Sport</option><option>Luxury</option></select>
                    </label>
                </div>

                <div class="mt-5 grid gap-4 lg:grid-cols-[1.4fr_0.7fr_auto]">
                    <label class="block">
                        <span class="search-band__label">Search By Keyword</span>
                        <input type="text" class="search-band__field" placeholder="Search by keyword">
                    </label>
                    <label class="block">
                        <span class="search-band__label">By Price</span>
                        <select class="search-band__field"><option>Any Price</option><option>$25k - $50k</option><option>$50k - $100k</option><option>$100k+</option></select>
                    </label>
                    <div class="flex items-end">
                        <button class="search-band__button w-full lg:w-auto"><span class="text-2xl leading-none">&#9906;</span><span>Search</span></button>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <div class="mb-6 flex items-end justify-between gap-4 reveal-card" data-reveal>
                    <div>
                        <p class="section-label text-sm sm:text-base">Fresh Inventory</p>
                        <h2 class="mt-3 font-display text-2xl font-semibold text-white sm:text-3xl">Featured vehicles ready to shop now.</h2>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('inventory.all') }}" class="inventory-cta-link">Explore All Inventory</a>
                        <a href="{{ route('contact') }}" class="inventory-cta-link inventory-cta-link--ghost">Ask About Availability</a>
                    </div>
                </div>

                <div class="grid gap-5 xl:grid-cols-3">
                    @foreach ($featuredInventory as $vehicle)
                        <article class="inventory-card-showcase reveal-card" data-reveal data-reveal-delay="{{ $loop->index * 90 }}">
                            <div class="inventory-card-showcase__media">
                                <div class="inventory-card-showcase__topbar">
                                    <button type="button" class="inventory-card-showcase__utility">&#9733; Save</button>
                                    <button type="button" class="inventory-card-showcase__utility">&#9993; Text To Phone</button>
                                </div>

                                <a href="{{ route('inventory.detail', $vehicle['stock']) }}" class="inventory-card-showcase__image-wrap">
                                    <img src="{{ $vehicle['image'] }}" alt="{{ $vehicle['year'] }} {{ $vehicle['make'] }} {{ $vehicle['model'] }}" class="inventory-card-showcase__image">
                                    <div class="inventory-card-showcase__overlay">
                                        <span class="inventory-card-showcase__overlay-button">View Details</span>
                                    </div>
                                </a>
                            </div>

                            <a href="{{ route('inventory.detail', $vehicle['stock']) }}" class="inventory-card-showcase__body">
                                <div class="inventory-card-showcase__heading">
                                    <h3 class="inventory-card-showcase__title">{{ $vehicle['year'] }} {{ $vehicle['make'] }} {{ $vehicle['model'] }}</h3>
                                    <p class="inventory-card-showcase__price">Price: {{ $vehicle['price'] }}</p>
                                </div>

                                <dl class="inventory-card-showcase__fees">
                                    <div class="inventory-card-showcase__fee-row"><dt>Documentation Fee:</dt><dd>{{ $vehicle['doc_fee'] }}</dd></div>
                                    <div class="inventory-card-showcase__fee-row"><dt>Electronic Filing Fee:</dt><dd>{{ $vehicle['filing_fee'] }}</dd></div>
                                    <div class="inventory-card-showcase__fee-row"><dt>Temporary Tag:</dt><dd>{{ $vehicle['tag_fee'] }}</dd></div>
                                </dl>

                                <div class="inventory-card-showcase__total">
                                    <span>Total Price:</span>
                                    <strong>{{ $vehicle['total_price'] }}</strong>
                                </div>
                            </a>

                            <a href="{{ route('inventory.detail', $vehicle['stock']) }}" class="inventory-card-showcase__meta">
                                <span>&#9716; {{ $vehicle['mileage'] }} mi</span>
                                <span>&#35; {{ $vehicle['stock'] }}</span>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="relative z-10 bg-asphalt pb-16" data-reveal-section>
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="section-heading section-heading--compact reveal-card" data-reveal>
                <p class="section-label">Buy Or Sell</p>
                <h2 class="section-title mt-4">Two clear paths for buyers and sellers, designed to feel smooth from the start.</h2>
                <p class="section-copy mx-auto mt-4">Whether you are shopping for the right vehicle or turning your current one into a clean sale, every step should feel guided, premium, and easy to understand.</p>
            </div>

            <div class="grid gap-5 lg:grid-cols-2">
                @foreach ($journeys as $journey)
                    <div class="journey-card journey-card--compact reveal-card rounded-[32px] p-6 sm:p-7" data-reveal data-reveal-delay="{{ $loop->index * 110 }}">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-zinc-500">{{ $journey['kicker'] }}</p>
                                <h3 class="mt-3 font-display text-[2rem] font-semibold text-white">{{ $journey['title'] }}</h3>
                            </div>
                            <div class="journey-badge">0{{ $loop->iteration }}</div>
                        </div>
                        <p class="mt-3 max-w-xl text-sm leading-7 text-zinc-400">{{ $journey['intro'] }}</p>

                        <div class="mt-6 space-y-3">
                            @foreach ($journey['steps'] as $step)
                                <div class="journey-step">
                                    <div class="journey-step__count">{{ $loop->iteration }}</div>
                                    <p class="text-sm leading-7 text-zinc-300">{{ $step }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="relative z-10 bg-asphalt pb-20" data-reveal-section>
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="section-heading reveal-card" data-reveal>
                <p class="section-label">Why Choose Us</p>
                <h2 class="section-title mt-4">A more elegant dealership experience built around clarity, speed, and trust.</h2>
                <p class="section-copy mx-auto mt-4">The design should not only look premium, it should communicate that this team is organized, responsive, and serious about helping customers make good decisions.</p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
                @foreach ($reasons as $reason)
                    <div class="reason-card reveal-card" data-reveal data-reveal-delay="{{ $loop->index * 85 }}">
                        <div class="reason-card__number">0{{ $loop->iteration }}</div>
                        <h3 class="mt-10 font-display text-2xl font-semibold text-white">{{ $reason['title'] }}</h3>
                        <p class="mt-4 text-sm leading-7 text-zinc-400">{{ $reason['copy'] }}</p>
                        <div class="reason-card__line"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="relative z-10 bg-asphalt pb-16" data-reveal-section>
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="section-heading section-heading--compact reveal-card" data-reveal>
                <p class="section-label">Trust Us</p>
                <h2 class="section-title mt-4">Credibility should feel visible across every touchpoint.</h2>
                <p class="section-copy mx-auto mt-4">These trust signals give the page more substance and reassure buyers and sellers that the dealership is active, experienced, and consistent.</p>
            </div>

            <div class="trust-rail reveal-card" data-reveal>
                <div class="trust-rail__intro">
                    <span class="trust-rail__dash"></span>
                    <p class="trust-rail__title">Confidence markers</p>
                </div>

                <div class="trust-rail__track">
                    @foreach ($trustStats as $stat)
                        <div class="trust-rail__item">
                            <p class="trust-rail__value">{{ $stat['value'] }}</p>
                            <p class="trust-rail__label">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="relative z-10 bg-asphalt pb-16" data-reveal-section>
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="section-heading section-heading--compact reveal-card" data-reveal>
                <p class="section-label">Reviews</p>
                <h2 class="section-title mt-4">What customers say after working with Nitro Motors USA.</h2>
                <p class="section-copy mx-auto mt-4">Real confidence comes from repeatable service, clear communication, and a process that feels easy from start to finish.</p>
            </div>

            <div class="testimonial-slider reveal-card" data-carousel data-reveal>
                <div class="testimonial-slider__viewport overflow-hidden">
                    <div class="testimonial-slider__track" data-carousel-track>
                        @foreach ($reviews as $review)
                            <article class="review-card review-card--compact testimonial-slide" data-carousel-slide>
                                <div class="flex items-center gap-1 text-amber-300">
                                    <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
                                </div>
                                <p class="mt-5 text-sm leading-7 text-zinc-300">"{{ $review['quote'] }}"</p>
                                <div class="mt-5 border-t border-white/10 pt-4">
                                    <h3 class="font-display text-lg font-semibold text-white">{{ $review['name'] }}</h3>
                                    <p class="mt-1 text-sm text-zinc-400">{{ $review['location'] }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
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

    <section class="relative z-10 bg-asphalt pb-16" data-reveal-section>
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="section-heading section-heading--compact reveal-card" data-reveal>
                <p class="section-label">Location</p>
                    <h2 class="section-title mt-4">Visit our showroom, connect with the team, and get directions fast.</h2>
                <p class="section-copy mx-auto mt-4">We wanted this section to feel more like a premium dealership info panel than a basic contact box, with space for the showroom image and the key details people actually need.</p>
            </div>

            <div class="location-showcase location-showcase--compact reveal-card" data-reveal>
                <div class="location-showcase__media">
                    <div class="location-showcase__image" style="background-image: linear-gradient(90deg, rgba(10,10,10,0.34), rgba(10,10,10,0.1)), url('https://images.unsplash.com/photo-1489824904134-891ab64532f1?auto=format&fit=crop&w=1600&q=80');"></div>
                    <div class="location-showcase__button-wrap">
                        <a href="{{ route('directions') }}" class="location-showcase__button">Get Directions</a>
                    </div>
                </div>

                <div class="location-showcase__content">
                    <div>
                        <div class="location-row">
                            <div class="location-row__icon">&#9679;</div>
                            <div>
                                <p class="location-row__title">Nitro Motors USA Showroom</p>
                                <p class="location-row__copy">Our indoor showroom is located at<br>1450 NW 79th Avenue<br>Miami, FL 33126</p>
                                <p class="location-row__copy">Nationwide buyers can schedule a virtual walkaround before purchase.</p>
                            </div>
                        </div>

                        <div class="location-row mt-6">
                            <div class="location-row__icon">&#9679;</div>
                            <div>
                                <p class="location-row__title">Vehicle Pickup And Delivery</p>
                                <p class="location-row__copy">Trade-ins, shipping coordination, and handoff support are available for customers across the USA.</p>
                            </div>
                        </div>
                    </div>

                    <div class="location-divider"></div>

                    <div class="space-y-4">
                        <div class="location-inline">
                            <span class="location-inline__icon">&#9990;</span>
                            <span>Phone: +1 (305) 555-0147</span>
                        </div>
                        <div class="location-inline">
                            <span class="location-inline__icon">&#9993;</span>
                            <span>Send us a message: sales@nitromotorsusa.com</span>
                        </div>
                        <div class="location-inline">
                            <span class="location-inline__icon">&#10150;</span>
                            <span>Instagram, YouTube, and social showroom updates available daily</span>
                        </div>
                    </div>

                    <div class="location-divider"></div>

                    <div class="location-hours">
                        <div class="location-hours__icon">&#9716;</div>
                        <div class="grid gap-2 sm:grid-cols-2">
                            <div>
                                <p class="text-sm font-semibold text-white">Monday - Friday</p>
                                <p class="mt-1 text-sm text-zinc-400">10:00 AM - 7:00 PM</p>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-white">Saturday - Sunday</p>
                                <p class="mt-1 text-sm text-zinc-400">By Appointment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
