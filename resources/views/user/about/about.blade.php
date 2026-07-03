@extends('layouts.user')

@section('title', 'About Us | Nitro Motors USA')
@section('meta_description', 'Learn more about Nitro Motors USA, our mission, values, and the team behind our premium automotive experience.')

@section('content')
    @include('user.partials.page-hero', [
        'eyebrow' => 'About Us',
        'title' => 'A premium dealership experience shaped for modern buyers.',
        'copy' => 'Nitro Motors USA combines elevated vehicle presentation, responsive support, and a cleaner buying process for customers who expect more than a basic listing page.',
        'media' => "linear-gradient(135deg, rgba(10,10,10,0.24), rgba(10,10,10,0.68)), url('https://images.unsplash.com/photo-1503736334956-4c8f8e92946d?auto=format&fit=crop&w=1400&q=80')",
    ])

    <section class="relative z-10 bg-asphalt pb-16" data-reveal-section>
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="section-heading section-heading--left page-section-heading reveal-card" data-reveal>
                <p class="section-label">Who We Are</p>
                <h2 class="section-title mt-4">Built for customers who want clarity, speed, and a sharper standard.</h2>
            </div>

            <div class="page-story">
                <div class="page-story__lead reveal-card" data-reveal data-reveal-delay="70">
                    <p class="page-story__copy">Nitro Motors USA was built around one simple idea: premium vehicles deserve premium presentation. From the first listing impression to final delivery coordination, our goal is to create a dealership experience that feels cleaner, more transparent, and easier to trust.</p>
                    <p class="page-story__copy">We focus on standout inventory, organized communication, and a polished digital showroom that helps serious buyers move forward with confidence.</p>
                </div>

                <div class="page-highlight-grid">
                    @foreach ($highlights as $highlight)
                        <article class="page-highlight-card reveal-card" data-reveal data-reveal-delay="{{ 120 + ($loop->index * 90) }}">
                            <h3 class="page-highlight-card__title">{{ $highlight['title'] }}</h3>
                            <p class="page-highlight-card__copy">{{ $highlight['copy'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="relative z-10 bg-asphalt pb-16" data-reveal-section>
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="grid gap-5 lg:grid-cols-2">
                @foreach ($pillars as $pillar)
                    <article class="mission-card reveal-card" data-reveal data-reveal-delay="{{ $loop->index * 110 }}">
                        <p class="mission-card__eyebrow">{{ $pillar['label'] }}</p>
                        <h2 class="mission-card__title">{{ $pillar['title'] }}</h2>
                        <p class="mission-card__copy">{{ $pillar['copy'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="relative z-10 bg-asphalt pb-16" data-reveal-section>
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="section-heading section-heading--compact reveal-card" data-reveal>
                <p class="section-label">Why Choose Us</p>
                <h2 class="section-title mt-4">What makes the Nitro Motors USA approach feel different.</h2>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
                @foreach ($reasons as $reason)
                    <article class="reason-card reveal-card" data-reveal data-reveal-delay="{{ $loop->index * 85 }}">
                        <div class="reason-card__number">0{{ $loop->iteration }}</div>
                        <h3 class="mt-8 font-display text-2xl font-semibold text-white">{{ $reason['title'] }}</h3>
                        <p class="mt-4 text-sm leading-7 text-zinc-400">{{ $reason['copy'] }}</p>
                        <div class="reason-card__line"></div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="relative z-10 bg-asphalt pb-16" data-reveal-section>
        <div class="mx-auto w-full max-w-[1600px] px-4 sm:px-8 lg:px-12 xl:px-16">
            <div class="trust-rail reveal-card" data-reveal>
                <div class="trust-rail__intro">
                    <span class="trust-rail__dash"></span>
                    <p class="trust-rail__title">Proof of consistency</p>
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
                <p class="section-label">Experts</p>
                <h2 class="section-title mt-4">A team focused on presentation, guidance, and follow-through.</h2>
            </div>

            <div class="grid gap-5 md:grid-cols-3">
                @foreach ($experts as $expert)
                    <article class="expert-card reveal-card" data-reveal data-reveal-delay="{{ $loop->index * 100 }}">
                        <div class="expert-card__avatar">{{ strtoupper(substr($expert['name'], 0, 1)) }}</div>
                        <h3 class="expert-card__name">{{ $expert['name'] }}</h3>
                        <p class="expert-card__role">{{ $expert['role'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    @include('user.partials.page-cta', [
        'eyebrow' => 'Start The Conversation',
        'title' => 'Work with a dealership team that values premium presentation and straightforward support.',
        'copy' => 'Whether you are buying, selling, or comparing your next move, we make the process easier to trust.',
        'primaryLabel' => 'View Testimonials',
        'primaryUrl' => route('testimonials'),
        'secondaryLabel' => 'Get Directions',
        'secondaryUrl' => route('directions'),
    ])
@endsection
